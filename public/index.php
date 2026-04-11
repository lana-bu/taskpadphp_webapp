<?php
// for token check
require_once("../src/csrf.php");
session_start();

// flash message functions
require_once("../src/flash.php");

// site header
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <div class="flash"><?php display_flash_message('action'); ?></div>
    <form class='search' method='get' action='index.php'>
        <div class='form-input-group search-bar'>
            <svg class='search-svg' xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                <path class="search-icon" d="M796-121 533-384q-30 26-70 40.5T378-329q-108 0-183-75t-75-181q0-106 75-181t182-75q106 0 180.5 75T632-585q0 43-14 83t-42 75l264 262-44 44ZM377-389q81 0 138-57.5T572-585q0-81-57-138.5T377-781q-82 0-139.5 57.5T180-585q0 81 57.5 138.5T377-389Z"/>
            </svg>
            <input type="text" name='q' class="search-input" placeholder='Search for tasks...' value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" />
        </div>
        <div class='form-input-group filter-box'>
            <label for="priority" class="form-label filter-label">Priority:</label>
            <select name="priority" class="form-input filter-input">
                <option value="">Any</option>
                <option <?php
                    if (($_GET['priority'] ?? '') === 'Low') {
                        echo 'selected';
                    }
                ?> value="Low">Low</option>
                <option <?php
                    if (($_GET['priority'] ?? '') === 'Medium') {
                        echo 'selected';
                    }
                ?> value="Medium">Medium</option>
                <option <?php
                    if (($_GET['priority'] ?? '') === 'High') {
                        echo 'selected';
                    }
                ?> value="High">High</option>
            </select>
        </div>
        <div class='form-input-group filter-box'>
            <label for="status" class="form-label filter-label">Completion Status:</label>
            <select name="status" class="form-input filter-input">
                <option value="">Any</option>
                <option <?php
                    if (($_GET['status'] ?? '') === 'Complete') {
                        echo 'selected';
                    }
                ?> value="Complete">Complete</option>
                <option <?php
                    if (($_GET['status'] ?? '') === 'Incomplete') {
                        echo 'selected';
                    }
                ?> value="Incomplete">Incomplete</option>
            </select>
        </div>
        <button type="submit" class="btn">Filter</button>               
    </form>
    <div class="list">
        <?php
            require_once("../src/storage.php");

            $taskRepo = new TaskRepository();

            if ($taskRepo->isEmpty()) {
                echo "<span>No tasks yet. Add one below!</span>";
            } else {
                $taskList = $taskRepo->all();

                // filter by text query
                $q = trim($_GET['q'] ?? '');
                if ($q !== '') {
                    $taskList = array_filter($taskList, function($task) use ($q) {
                        return stripos($task->getTitle(), $q) !== false || stripos($task->getDescription(), $q) !== false; // query match found in title or description
                    });
                }

                // filter by priority
                $priority = $_GET['priority'] ?? '';
                if ($priority !== '') {
                    $taskList = array_filter($taskList, function($task) use ($priority) {
                        return $task->getPriority() === $priority;
                    });
                }

                //filter by status
                $status = $_GET['status'] ?? '';
                if ($status !== '') {
                    if ($status === "Complete") {
                        $taskList = array_filter($taskList, function($task) {
                            return $task->getCompleted() === true;
                        });
                    } else if ($status === "Incomplete") {
                        $taskList = array_filter($taskList, function($task) {
                            return $task->getCompleted() === false;
                        });
                    }
                }

                if (empty($taskList)) {
                    echo "<span>No tasks match your filters.</span>";
                } else {
                    foreach($taskList as $task) {
                        // convert string to date object
                        $dueDate = new DateTime($task->getDue());

                        // convert to Monthname day, year format
                        $formattedDate = $dueDate->format("F d, Y");
                        echo "<div class='list-item'>
                            <span class='task-element task-title'>{$task->getTitle()}</span>
                            <span class='task-element task-description'>{$task->getDescription()}</span>
                            <span class='task-element task-due'>Due by: {$formattedDate}</span>";
                        if ($task->getPriority() === 'Low') {
                            echo "<span class='task-element task-priority' title='Low priority'>!</span>";
                        } else if ($task->getPriority() === 'Medium') {
                            echo "<span class='task-element task-priority' title='Medium priority'>!!</span>";
                        } else { // high priority
                            echo "<span class='task-element task-priority' title='High priority'>!!!</span>";
                        }

                        if ($task->getCompleted()) {
                            echo "<svg class='task-element task-status' xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960' role='img' aria-label='Task complete'>
                                <title>Task complete</title>
                                <path class='complete-icon' title='Task complete' d='M400-318 247-471l42-42 111 111 271-271 42 42-313 313Z'/>
                            </svg>";
                        } else {
                            echo "<svg class='task-element task-status' xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960' role='img' aria-label='Task incomplete'>
                                <title>Task incomplete</title>
                                <path class='incomplete-icon' d='M240-450v-60h480v60H240Z'/>
                            </svg>";
                        }
                        
                        echo "<form class='actions' method='post' action='actions.php'>
                                <input type='hidden' name='csrf_token' value='" . csrf_token() . "'>
                                <input type='hidden' name='task-id' value='{$task->getId()}'>";
                        
                        if (!$task->getCompleted()) {
                            echo "<button class='btn action-btn complete-btn' type='submit' name='action' value='complete'>Mark as Complete</button>";
                        }

                        echo "<button class='btn action-btn delete-btn' type='submit' title='Delete task' aria-label='Delete task' name='action' value='delete'>
                                <svg class='delete-svg' xmlns='http://www.w3.org/2000/svg' viewBox='0 -960 960 960' >
                                    <path class='delete-icon' d='M261-120q-24.75 0-42.37-17.63Q201-155.25 201-180v-570h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438v-570ZM367-266h60v-399h-60v399Zm166 0h60v-399h-60v399ZM261-750v570-570Z'/>
                                </svg>
                            </button>
                            </form>
                        </div>";
                    }
                }
            }
        ?>
    <a href="create.php"><button class="btn redirect-btn">Add Task</button></a>
    </div>
</main>

<?php
    include "../src/templates/footer.php"; 
?>