<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <div className='search-bar'>
        <img class="search-icon" src="./assets/images/search.png"/>
        <input type="text" className="search-input" placeholder='Search for tasks...' value="" />                        
    </div>
    <?php
        require_once("../src/storage.php");

        $taskRepo = TaskRepository::getInstance("../data/tasks.json");

        if ($taskRepo->isEmpty()) {
            echo "No tasks yet. Add one below!";
        } else {
            $taskList = $taskRepo->all();
            foreach($taskList as $task) {
                $task->printInfo();
            }
        }
    ?>
    <button class="btn redirect-btn" onclick="location.href='create.php'">Add Task</button>
</main>

<?php
    include "../src/templates/footer.php"; 
?>