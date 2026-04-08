<!-- validation/sanitization helpers -->
<?php

class Validator {
    public function validateCreate(array $input) : array {
        return $input;
        // $info = [$this->isValid, $this->errors, $this->sanitized];
        // return $info;
    }
}