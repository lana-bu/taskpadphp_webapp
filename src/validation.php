<?php
function validateCreate(array $input) : array {
    $errors = [];

    // Sanitize inputs 
    $title = trim($input['title'] ?? ''); // if input value was not provided, set to default of empty string
    $description = trim($input['description'] ?? '');
    $priority = $input['priority'] ?? 'Low'; // if input value was not provided, set to default of Low
    $due = trim($input['due'] ?? '');

    // Title validation
    if ($title === '') {
        $errors['title'] = 'Title is required.';
    } elseif (strlen($title) > 100) {
        $errors['title'] = 'Title must be 100 characters or less.';
    }

    // Description validation
    if (strlen($description) > 500) {
        $errors['description'] = 'Description must be 500 characters or less.';
    }

    //  Priority validation (this would basically create a whitelist)
    $validPriorities = ['Low', 'Medium', 'High'];
    if (!in_array($priority, $validPriorities, true)) { // should never be encountered because of select dropdown
        $errors['priority'] = 'Invalid priority selected.';
    }

    // Due date validation
    if ($due !== '') {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $due)) { // should never be encountered because of date selection
            $errors['due'] = 'Date must be in YYYY-MM-DD format.';
        } else {
            // Further check if it's a real date
            [$year, $month, $day] = explode('-', $due);
            if (!checkdate((int)$month, (int)$day, (int)$year)) {
                $errors['due'] = 'Invalid date.';
            }
        }
    }

    // Final result
    $isValid = empty($errors); // true if no errors exist

    // Return the sanitized data (even if it's invalid, this can be useful for re-populating form)
    $sanitized = [
        'id' => uniqid(), // generate unique ID
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
        'due' => $due,
        'completed' => false
    ];

    return ["isValid" => $isValid, "errors" => $errors, "sanitized" => $sanitized];
}