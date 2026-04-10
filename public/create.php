<!-- form (GET) and handler (POST) -->

<?php 
// for token check
require_once("../src/csrf.php");
session_start();

// form submission handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // token check
    $token = $_POST['csrf_token'] ?? ''; // empty string means not set

    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) { // token does not match or is not set
        die('Invalid CSRF token');
    }

    // validate, save, redirect to index.php (PRG pattern)
    require_once("../src/validation.php");
    require_once("../src/storage.php");

    $formInput = array("title" => $_POST['title'], "description" => $_POST['description'], "priority" => $_POST['priority'], "due" => $_POST['due']);
    $validation = validateCreate($formInput);

    if ($validation["isValid"]) {
        $sanitizedInput = $validation["sanitized"];
        $data = array("id" => $sanitizedInput['id'],"title" => $sanitizedInput['title'], "description" => $sanitizedInput['description'], "priority" => $sanitizedInput['priority'], "due" => $sanitizedInput['due'], "completed" => false);
        $taskRepo = new TaskRepository();
        $task = new Task($data); // sanitized input
        $taskRepo->addTask($task);
        header('Location: index.php');
    }
}

// site header
$title = "Task Creation | TaskPadPHP";
$description = "Create a new task.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <button class="btn redirect-btn back-btn" onclick="location.href='index.php'">Back to List</button>
    <form action="create.php" method="post" class="create-form">
        <fieldset>
            <legend>Task Information</legend>
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <div class="form-input-group">
                <label for="title" class="form-label">Title*:</label>
                <div class='input-box'>
                    <input type="text" name="title" id="title" class="form-input" placeholder="Enter title..." value="" />
                    <?php
                        if (isset($validation["errors"]["title"])) {
                            echo $validation["errors"]["title"];
                        }
                    ?>
                    <!-- <span aria-live='polite' class='info-msg invalid-msg'>Please provide a name.</span> -->
                </div>
            </div>
            <div class="form-input-group">
                <div class='input-box'>
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" id="description" class="form-input" placeholder="Enter description..." value="" />
                    <?php
                        if (isset($validation["errors"]["description"])) {
                            echo $validation["errors"]["description"];
                        }
                    ?>    
                </div>
            </div>
            <div class="form-input-group">
                <div class='input-box'>
                    <label for="priority" class="form-label">Priority*:</label>
                    <select name="priority" id="priority" class="form-input">
                        <option selected="true" value="Low" class="form-option">Low</option>
                        <option value="Medium" class="form-option">Medium</option>
                        <option value="High" class="form-option">High</option>
                    </select>
                    <?php
                        if (isset($validation["errors"]["priority"])) {
                            echo $validation["errors"]["priority"];
                        }
                    ?>
                </div>
            </div>
            <div class="form-input-group">
                <label for="due" class="form-label">Due date:</label>
                <input type="date" name="due" id="due" class="form-input" value="" />
                <?php
                    if (isset($validation["errors"]["due"])) {
                        echo $validation["errors"]["due"];
                    }
                ?>                      
            </div>
            <span class="info-msg">*Required field</span>
        </fieldset>
        <button type="submit" class="btn submit-btn">Create New Task</button>
    </form>
</main>

<?php // site footer
    include "../src/templates/footer.php"; 
?>