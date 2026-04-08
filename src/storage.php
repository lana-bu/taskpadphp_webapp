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

    public function getInfo() {
        echo $this->id;
        echo $this->title;
        echo $this->description;
        echo $this->priority;
        echo $this->due;
        echo $this->completed;
    }
}

class TaskRepository {
    private string $path;
    private array $tasks = array();

    public function __construct(string $path) {
        $this->path = $path;
        
        $json = file_get_contents($this->path);

        if ($json === false) {
            die('Error reading the JSON file');
        }

        $taskData = json_decode($json, true);

        if ($taskData != null) {
            foreach($taskData as $task) {
                $taskObject = new Task($task);
                $this->tasks[] = $taskObject;
            }
        }
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

    public function saveJson(array $tasks) {
        $this->tasks = $tasks;
        $this->json = json_encode($this->tasks);
        file_put_contents($this->path, $json);
    }


}
