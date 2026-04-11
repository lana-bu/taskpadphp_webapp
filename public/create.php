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

    // include necessary classes and functions
    require_once("../src/validation.php");
    require_once("../src/storage.php");

    // validate input
    $formInput = array("title" => $_POST['title'], "description" => $_POST['description'], "priority" => $_POST['priority'], "due" => $_POST['due']);
    $validation = validateCreate($formInput);

    // save input to task repository and redirect to index.php (if valid)
    if ($validation["isValid"]) {
        $sanitized = $validation["sanitized"];
        $data = array("id" => $sanitized['id'],"title" => $sanitized['title'], "description" => $sanitized['description'], "priority" => $sanitized['priority'], "due" => $sanitized['due'], "completed" => false);
        $taskRepo = new TaskRepository();
        $task = new Task($data); // sanitized input
        $taskRepo->addTask($task);
        header('Location: index.php');
        exit;
    }
}

// site header
$title = "Task Creation | TaskPadPHP";
$description = "Create a new task.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <a href="index.php"><button class="btn redirect-btn">Back to List</button></a>
    <form action="create.php" method="post" class="create-form">
        <fieldset>
            <legend>Task Information</legend>
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <div class="form-input-group">
                <div class='input-box'>
                    <label for="title" class="form-label">Title*:</label>
                    <input type="text" name="title" id="title" class="form-input" placeholder="Enter title..." value="<?php
                        if (isset($validation["sanitized"])) {
                            echo $validation["sanitized"]["title"];
                        }
                    ?>" />
                    <span class='info-msg invalid-msg'><?php
                        if (isset($validation["errors"]["title"])) {
                            echo $validation["errors"]["title"];
                        }
                    ?></span>
                </div>
            </div>
            <div class="form-input-group">
                <div class='input-box'>
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" id="description" class="form-input" placeholder="Enter description..." value="<?php
                        if (isset($validation["sanitized"])) {
                            echo $validation["sanitized"]["description"];
                        }
                    ?>" />
                    <span class='info-msg invalid-msg'><?php
                        if (isset($validation["errors"]["description"])) {
                            echo $validation["errors"]["description"];
                        }
                    ?></span>
                </div>
            </div>
            <div class="form-input-group">
                <div class='input-box'>
                    <label for="priority" class="form-label">Priority*:</label>
                    <select name="priority" id="priority" class="form-input">
                        <option <?php
                            if (!isset($validation["sanitized"]) || $validation["sanitized"]["priority"] === "Low") {
                                echo "selected";
                            }
                        ?> value="Low" class="form-option">Low</option>
                        <option <?php
                            if (isset($validation["sanitized"]) && $validation["sanitized"]["priority"] === "Medium") {
                                echo "selected";
                            }
                        ?> value="Medium" class="form-option">Medium</option>
                        <option <?php if (isset($validation["sanitized"]) && $validation["sanitized"]["priority"] === "High") { echo "selected"; } ?> value="High" class="form-option">High</option>
                    </select>
                    <span class='info-msg invalid-msg'><?php
                        if (isset($validation["errors"]["priority"])) {
                            echo $validation["errors"]["priority"];
                        }
                    ?></span>
                </div>
            </div>
            <div class="form-input-group">
                <label for="due" class="form-label">Due date:</label>
                <input type="date" name="due" id="due" class="form-input" value="<?php
                    if (isset($validation["sanitized"])) {
                        echo $validation["sanitized"]["due"];
                    }
                ?>" />
                <span class='info-msg invalid-msg'><?php
                    if (isset($validation["errors"]["due"])) {
                        echo $validation["errors"]["due"];
                    }
                ?></span>                
            </div>
            <span class="info-msg">*Required field</span>
        </fieldset>
        <button type="submit" class="btn submit-btn">Create New Task</button>
    </form>
</main>

<?php // site footer
    include "../src/templates/footer.php"; 
?>