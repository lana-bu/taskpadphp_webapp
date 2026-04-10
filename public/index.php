<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <div class='search-bar'>
        <img class="search-icon" src="./assets/images/search.png"/>
        <input type="text" class="search-input" placeholder='Search for tasks...' value="" />                        
    </div>
    <?php
        require_once("../src/storage.php");

        $taskRepo = new TaskRepository();

        if ($taskRepo->isEmpty()) {
            echo "No tasks yet. Add one below!";
        } else {
            $taskList = $taskRepo->all();
            foreach($taskList as $task) {
                echo "<div class='list-item'>
                    <span class='task-title'>{$task->getTitle()}</span>
                    <div class='task-info'>
                        <span class='task-element task-description'>Description: {$task->getDescription()}</span>
                        <span class='task-element task-priority'>Priority: {$task->getPriority()}</span>
                        <span class='task-element task-due'>Due by: {$task->getDue()}</span>
                    </div>";

                if ($task->getCompleted()) {
                    echo "<img class='task-status' src='./assets/images/complete.svg'/>";
                } else {
                    echo "<img class='task-status' src='./assets/images/incomplete.svg'/>";
                }
                
                echo "<button class='btn delete-btn'>delete</button>
                </div>";
            }
        }
    ?>
    <button class="btn redirect-btn" onclick="location.href='create.php'">Add Task</button>
</main>

<?php
    include "../src/templates/footer.php"; 
?>