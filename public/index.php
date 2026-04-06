<!-- list and filter (GET), flash messages -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twinkling Meadows Brochure</title>
    <meta name="description" content="Get information on the Twinkling Meadows stargazing destination and select between travel package options.">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <header class="header-container">
        <h1 class="site-name site-name-large">TaskPadPHP</h1>
        <img class="logo" src="./assets/images/logo.png"/>
    </header>
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
                    echo "<pre>";
                    print_r($task);
                    echo "</pre>";
                }
            }
        ?>
       <button class="btn popup-trigger-btn">Add Task</button>
       <div class="popup">
            <button class='btn close-btn'>X</button>
            <form action="" class="form" noValidate onSubmit={(e) => submitHandler(e, close)}>
                <fieldset>
                    <legend>Contact Information</legend>
                    <div class="form-input-group">
                        <label for="name" class="form-label">Name*:</label>
                        <div class='input-box'>
                            <input type="text" name="name" id="name" required="required" class="form-input" placeholder="Enter name..." value={enteredName} onChange={nameChangedHandler} />
                            <span aria-live='polite' class='info-msg invalid-msg'>Please provide a name.</span>
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="email" class="form-label">Email*:</label>
                        <div class='input-box'>
                            <input type="email" name="email" id="email" required="required" class="form-input" placeholder="Enter email..." value={enteredEmail} onChange={emailChangedHandler} />        
                            <span aria-live='polite' class='info-msg invalid-msg'>Please provide a valid email address.</span>
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="phone" class="form-label">Phone:</label>
                        <div class='input-box'>
                            <input type="tel" name="phone" id="phone" class="form-input" placeholder="Enter phone number..." pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}|[0-9]{3}-[0-9]{4}" value={enteredPhone} onChange={phoneChangedHandler} maxLength={14} />
                            <span aria-live='polite' class='info-msg invalid-msg'>Please provide a valid phone number.</span>
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="birthdate" class="form-label">Birthdate:</label>
                        <input type="date" name="birthdate" id="birthdate" class="form-input" value={enteredBirthdate} onChange={birthdateChangedHandler} />                        
                    </div>
                    <span class="info-msg">*Required field</span>
                </fieldset>
                <button type="submit" class="btn submit-btn">Create New Contact</button>
            </form>
        </div>
    </main>
    <footer class="footer-container">
        <h3 class="site-name">TaskPadPHP</h3>
    </footer>
</body>
</html>