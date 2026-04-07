<!-- list and filter (GET), flash messages -->
<?php
$title = "Task List | TaskPadPHP";
$description = "View and filter your list of tasks.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <?php
        $json = file_get_contents('../data/tasks.json');

        if ($json === false) {
            die('Error reading the JSON file');
        }

        $tasks = json_decode($json, true);

        if ($tasks === null) {
            echo "No tasks yet. Add one below!";
        } else {
            foreach($tasks as $task) {
                $id = $task["id"];
                $title = $task["title"];
                $description = $task["description"];
                $priority = $task["priority"];
                $due = $task["due"];
                $completed = $task["completed"];
                echo $id;
                echo $title;
                echo $description;
                echo $priority;
                echo $due;
                echo $completed;
            }
        }
    ?>
    <button class="btn popup-trigger-btn">Add Task</button>
</main>

<?php
    include "../src/templates/footer.php"; 
?>