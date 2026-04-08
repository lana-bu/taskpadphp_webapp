<!-- load/save JSON helpers -->
<?php

class Task {
    private string $id;
    private string $title;
    private string $description;
    private string $priority;
    private string $due;
    private bool $completed;

    public function __construct(array $task) {
        $this->id = $task["id"];
        $this->title = $task["title"];
        $this->description = $task["description"];
        $this->priority = $task["priority"];
        $this->due = $task["due"];
        $this->completed = $task["completed"];
    }

    public function printInfo() {
        echo htmlspecialchars($this->id);
        echo htmlspecialchars($this->title);
        echo htmlspecialchars($this->description);
        echo htmlspecialchars($this->priority);
        echo htmlspecialchars($this->due);
        echo htmlspecialchars($this->completed);
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getDue() {
        return $this->due;
    }
    
    public function getCompleted() {
        return $this->completed;
    }

    public function markAsComplete() {
        if (!$this->completed) {
            $this->completed = true;
        }
    }

    public function convertToArray() { // for encoding JSON
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "priority" => $this->priority,
            "due" => $this->due,
            "completed" => $this->completed
        ];                           
    }
}

class TaskRepository {
    private static TaskRepository $instance;
    private string $path = "../data/tasks.json";
    private array $tasks = array(); // initialize empty array so objects can be added to it

    public function __construct() {             
        if (file_exists($this->path)) { // get tasks from file
            $json = file_get_contents($this->path);
            $taskData = json_decode($json, true);

            if ($taskData != null) { // tasks exist
                foreach($taskData as $task) {
                    $taskObject = new Task($task); // create new task object
                    $this->tasks[] = $taskObject; // append new task
                }
            }
        } else { // create tasks.json file with empty array
            $this->saveJson();
        }
    }

    private function saveJson() {
        $taskData = array(); // to hold task arrays

        foreach($this->tasks as $task) {
            $taskData[] = $task->convertToArray(); // append task as array
        }

        $json = json_encode($taskData, JSON_PRETTY_PRINT); // encode array of task arrays as JSON string with pretty print
        file_put_contents($this->path, $json); // overwrite contents of tasks.json
    }

    public function isEmpty() {
        if (count($this->tasks) < 1) {
            return true; // array is empty
        }

        return false; // array is not empty
    }

    public function all() : array {
        return $this->tasks; // array of all Task objects
    }

    public function addTask(Task $task) {
        $this->tasks[] = $task; // append new task
        $this->saveJson();
    }

    public function completeTask(Task $task) { // maybe pass ID isntead
        $task->markAsComplete(); // should hopefully mark task object already in list as complete
        // $id = $task->getId();

        // foreach($this->tasks as $taskObject) {
        //     if ($taskObject->getID === $id) { // tasks match
        //         $taskObject = $task; // update existing tasks
        //         break; // stop looking
        //     }
        // }

        $this->saveJson();
    }

    public function deleteTask(string $id) {
        foreach($this->tasks as $task) {
            if ($task->getID === $id) { // tasks match
                $this->tasks = array_filter($this->tasks, function($taskObject) use ($task) {
                    return $taskObject !== $task; // filter for non-matching tasks
                });
                break; // stop looking
            }
        }

        $this->saveJson();
    }
}
