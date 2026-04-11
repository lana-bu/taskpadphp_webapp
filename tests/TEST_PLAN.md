#Test Plan
One test case will provide valid input. The rest of the test cases will produce one error to test for each possible error condition.
##Test Cases
- Valid task input: Provides a valid title, a valid description, a valid priority, and no date.
- Missing title: Provides a valid description and priority, but no title.
- Invalid priority: Provides a valid title, description, and date, but an invalid priority.
- Invalid date format: Provides a valid title and priority, but the date provided does not follow the correct yyyy-mm-dd format.
- Too lengthy title: Provides a valid priority, but the title provided is over 100 characters long.
- Too lengthy description: Provides a valid title, priority, and date, but the description provided is over 500 characters long.
- Fake date: Provides a valid title and priority, but the date provided does not exist.
##Test Results
`[PASS] TC01 - Valid task input
[PASS] TC02 - Missing title
[PASS] TC03 - Invalid priority
[PASS] TC04 - Invalid date format
[PASS] TC05 - Too lengthy title
[PASS] TC06 - Too lengthy description
[PASS] TC07 - Fake date

Passed 7 out of 7 tests.`