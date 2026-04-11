<?php
require_once __DIR__ . '/../src/validation.php';


$json = file_get_contents(__DIR__ . '/test_cases.json');
$tests = json_decode($json, true);

if ($tests != null) { // tests exist
    $passed = 0;
    $total = count($tests);

    foreach ($tests as &$test) { // pass by reference so that updated actualValid and passed get saved in JSON
        $result = validateCreate($test['input']);
        $isValid = $result['isValid'];

        $test['actualValid'] = $isValid; // to save report results in JSON

        $ok = ($isValid === $test['expectedValid']);
        $test['passed'] = $ok; // to save report results in JSON

        if ($ok) {
            echo "[PASS] {$test['id']} - {$test['desc']}\n";
            $passed++;
        } else {
            echo "[FAIL] {$test['id']} - {$test['desc']}\n";
            echo "  Expected valid = " . ($test['expectedValid'] ? 'true' : 'false') . "\n";
            echo "  Actual valid   = " . ($isValid ? 'true' : 'false') . "\n";
        }
    }

    echo "\nPassed $passed out of $total tests.\n";

    $json = json_encode($tests, JSON_PRETTY_PRINT); // encode array of test cases as JSON string with pretty print
    file_put_contents(__DIR__ . '/test_cases.json', $json); // overwrite contents of test_cases.json
} else {
    echo 'No test cases exist.';
}