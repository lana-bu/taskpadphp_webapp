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
        echo $this->id;
        echo $this->title;
        echo $this->description;
        echo $this->priority;
        echo $this->due;
        echo $this->completed;
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

    public function convertToArray() {
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
        // change to save initial empty json once adding method exists
             
        if (file_exists($this->path)) {
            $json = file_get_contents($this->path);
            $taskData = json_decode($json, true);

            if ($taskData != null) {
                foreach($taskData as $task) {
                    $taskObject = new Task($task); // create new task object
                    $this->tasks[] = $taskObject; // append new task
                }
            }
        } else {
            $this->saveJson();
        }
    }

    private function saveJson() {
        $data = array();

        foreach($this->tasks as $task) {
            $data[] = $task->convertToArray();
        }

        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->path, $json);
    }

    public function isEmpty() {
        if (count($this->tasks) < 1) {
            return true;
        }
        return false;
    }

    public function all() : array {
        return $this->tasks;
    }

    public function add(Task $task) {
        $this->tasks[] = $task; // append new task
        $this->saveJson();
    }

    public function update(Task $task) {
        $id = $task->getId();

        foreach($this->tasks as $taskObject) {
            if ($taskObject->getID === $id) { // tasks match
                $taskObject = $task; // update existing tasks
                break; // stop looking
            }
        }

        $this->saveJson();
    }

    public function delete(string $id) {
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
