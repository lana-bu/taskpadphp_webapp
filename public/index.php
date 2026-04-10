<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <div class='search-bar'>
        <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px">
            <path class="search-icon" d="M796-121 533-384q-30 26-70 40.5T378-329q-108 0-183-75t-75-181q0-106 75-181t182-75q106 0 180.5 75T632-585q0 43-14 83t-42 75l264 262-44 44ZM377-389q81 0 138-57.5T572-585q0-81-57-138.5T377-781q-82 0-139.5 57.5T180-585q0 81 57.5 138.5T377-389Z"/>
        </svg>
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
                    echo "<svg xmlns='http://www.w3.org/2000/svg' height='48px' viewBox='0 -960 960 960' width='48xp'>
                        <path class='task-status complete-icon' d='M400-318 247-471l42-42 111 111 271-271 42 42-313 313Z'/>
                    </svg>";
                } else {
                    echo "<svg xmlns='http://www.w3.org/2000/svg' height='48px' viewBox='0 -960 960 960' width='48xp'>
                        <path class='task-status incomplete-icon' d='M240-450v-60h480v60H240Z'/>
                    </svg>";
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