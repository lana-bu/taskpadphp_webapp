<!-- form (GET) and handler (POST) -->
<?php
$title = "Task Creation | TaskPadPHP";
$description = "Create a new task.";

include "../src/templates/header.php";
?>

<main class="content-container">
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

<?php
    include "../src/templates/footer.php"; 
?>