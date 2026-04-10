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
    require_once("../src/flash.php");

    require_once("../src/storage.php");
    $taskList = new TaskRepository();

    // grab selected task's ID
    $taskId = $_POST['task-id'];

    // handlers
    if ($_POST['action'] === 'complete') { // complete handler
        $taskList->completeTask($taskId);
        
        create_flash_message('action', 'Task completed.', FLASH_SUCCESS);
    } else if ($_POST['action'] === 'delete') { // delete handler
        $taskList->deleteTask($taskId);

        create_flash_message('action', 'Task deleted.', FLASH_SUCCESS);
    }

    header('Location: index.php');
    exit;
}