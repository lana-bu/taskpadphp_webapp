<!-- complete/delete handlers (POST) -->
<?php
// for token check
require_once("../src/csrf.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // token check
    $token = $_POST['csrf_token'] ?? ''; // empty string means not set

    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) { // token does not match or is not set
        die('Invalid CSRF token');
    }

    // include necessary classes
    require_once("../src/storage.php");
    $taskList = new TaskRepository();

    // grab selected task's ID
    $taskId = $_POST['task-id'];

    // handlers
    if (isset($_POST['complete'])) { // complete handler
        $taskList->completeTask($taskId);
    } else if (isset($_POST['delete'])) { // delete handler
        $taskList->deleteTask($taskId);
    }

    header('Location: index.php');

    // // validate input
    // $formInput = array("title" => $_POST['title'], "description" => $_POST['description'], "priority" => $_POST['priority'], "due" => $_POST['due']);
    // $validation = validateCreate($formInput);

    // // save input to task repository and redirect to index.php (if valid)
    // if ($validation["isValid"]) {
    //     $sanitized = $validation["sanitized"];
    //     $data = array("id" => $sanitized['id'],"title" => $sanitized['title'], "description" => $sanitized['description'], "priority" => $sanitized['priority'], "due" => $sanitized['due'], "completed" => false);
    //     $taskRepo = new TaskRepository();
    //     $task = new Task($data); // sanitized input
    //     $taskRepo->addTask($task);
    //     header('Location: index.php');
    // }
}