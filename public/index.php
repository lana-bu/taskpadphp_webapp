<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <?php
        require_once("../src/Storage.php");

        $taskRepo = TaskRepository::getInstance("../data/tasks.json");

        if ($taskRepo->isEmpty()) {
            echo "No tasks yet. Add one below!";
        } else {
            $taskList = $taskRepo->all();
            foreach($taskList as $task) {
                $task->getInfo();
            }
        }
    ?>
    <button class="btn redirect-btn" onclick="location.href='create.php'">Add Task</button>
</main>

<?php
    include "../src/templates/footer.php"; 
?>