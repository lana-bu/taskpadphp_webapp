<!-- form (GET) and handler (POST) -->
<?php
$title = "Task Creation | TaskPadPHP";
$description = "Create a new task.";

include "../src/templates/header.php";
?>

<main class="content-container">
    <button class="btn redirect-btn back-btn" onclick="location.href='index.php'">Back to List</button>
    <form action="GET" class="create-form">
        <fieldset>
            <legend>Task Information</legend>
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
                <label for="due-date" class="form-label">Due date:</label>
                <input type="date" name="due-date" id="due-date" class="form-input" value="" />                        
            </div>
            <span class="info-msg">*Required field</span>
        </fieldset>
        <button type="submit" class="btn submit-btn">Create New Task</button>
    </form>
</main>

<?php
    include "../src/templates/footer.php"; 
?>