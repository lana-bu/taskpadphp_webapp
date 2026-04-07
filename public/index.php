<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <?php
        require_once("../src/Storage.php");

        $storage = new Storage("../data/tasks.json");
        $taskList = $storage->getTasks();

        if ($taskList === null) {
            echo "No tasks yet. Add one below!";
        } else {
            foreach($taskList as $task) {
                $id = $task["id"];
                $title = $task["title"];
                $description = $task["description"];
                $priority = $task["priority"];
                $due = $task["due"];
                $completed = $task["completed"];
                echo $id;
                echo $title;
                echo $description;
                echo $priority;
                echo $due;
                echo $completed;
            }
        }
    ?>
    <button class="btn redirect-btn" onclick="location.href='create.php'">Add Task</button>
</main>

<?php
    include "../src/templates/footer.php"; 
?>