<!-- list and filter (GET), flash messages -->
<?php
// for token check
require_once("../src/csrf.php");
session_start();

// site header
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
                    echo "<svg class='task-status' xmlns='http://www.w3.org/2000/svg' height='48px' viewBox='0 -960 960 960' width='48xp role='img' aria-label='Task completed'>
                        <title>Task completed</title>
                        <path class='complete-icon' title='Task completed' d='M400-318 247-471l42-42 111 111 271-271 42 42-313 313Z'/>
                    </svg>";
                } else {
                    echo "<svg class='task-status' xmlns='http://www.w3.org/2000/svg' height='48px' viewBox='0 -960 960 960' width='48xp' role='img' aria-label='Task incomplete'>
                        <title>Task incomplete</title>
                        <path class='incomplete-icon' d='M240-450v-60h480v60H240Z'/>
                    </svg>";
                }
                
                echo "<form method='post' action='actions.php'>
                        <input type='hidden' name='csrf_token' value='" . csrf_token() . "'>
                        <input type='hidden' name='task-id' value='{$task->getId()}'>";
                
                if (!$task->getCompleted()) {
                    echo "<button class='btn action-btn complete-btn' type='submit' name='action' value='complete'>Mark as Complete</button>";
                }

                echo "<button class='btn action-btn delete-btn' type='submit' title='Delete task' aria-label='Delete task' name='action' value='delete'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='48px' viewBox='0 -960 960 960' width='48px' >
                            <path class='delete-icon' d='M261-120q-24.75 0-42.37-17.63Q201-155.25 201-180v-570h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438v-570ZM367-266h60v-399h-60v399Zm166 0h60v-399h-60v399ZM261-750v570-570Z'/>
                        </svg>
                    </button>
                    </form>
                </div>";
            }
        }
    ?>
    <a class="btn redirect-btn href-btn" href="create.php" role="button">Add Task</a>
</main>

<?php
    include "../src/templates/footer.php"; 
?>