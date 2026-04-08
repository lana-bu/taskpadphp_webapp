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

    $formInput = array("id" => uniqid(), "title" => $_POST['title'], "description" => $_POST['description'], "priority" => $_POST['priority'], "due" => $_POST['due'], "completed" => false );
    $info = validateCreate($formInput);
    $taskRepo = new TaskRepository();
    $task = new Task($info); // sanitized input
    $taskRepo->addTask($task);
    header('Location: index.php');
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
                    <input type="text" name="title" id="title" required="required" class="form-input" placeholder="Enter title..." value="" />
                    <!-- <span aria-live='polite' class='info-msg invalid-msg'>Please provide a name.</span> -->
                </div>
            </div>
            <div class="form-input-group">
                <label for="description" class="form-label">Description:</label>
                <div class='input-box'>
                    <input type="text" name="description" id="description" class="form-input" placeholder="Enter description..." value="" />        
                </div>
            </div>
            <div class="form-input-group">
                <label for="priority" class="form-label">Priority*:</label>
                <div class='input-box'>
                    <select name="priority" id="priority" required="required" class="form-input">
                        <option selected="true" value="Low" class="form-option">Low</option>
                        <option value="Medium" class="form-option">Medium</option>
                        <option value="High" class="form-option">High</option>
                    </select>
                </div>
            </div>
            <div class="form-input-group">
                <label for="due" class="form-label">Due date:</label>
                <input type="date" name="due" id="due" class="form-input" value="" />                        
            </div>
            <span class="info-msg">*Required field</span>
        </fieldset>
        <button type="submit" class="btn submit-btn">Create New Task</button>
    </form>
</main>

<?php // site footer
    include "../src/templates/footer.php"; 
?>