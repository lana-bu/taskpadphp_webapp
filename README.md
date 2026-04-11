# taskpadphp_webapp
This is my Project #2 assignment for my CIS 435 (Web Technology) course at UM-Dearborn. This web app keeps track of your tasks by allowing you to search for, complete, delete, and add any tasks as needed. It uses PHP server-side processing to dynamically access and update the task list.
## Run Instructions
Before beginning, make sure PHP is installed on your system and added as a PATH variable. You can download PHP with the free XAMPP package. If using XAMPP, add C:\xampp\php to the PATH in your system's environment variables.
### Running the Website
1. Run the server
- In the terminal, go to the root folder of the project (taskpadphp_webapp).
- Enter the command php -S localhost:8080 -t public to start the server.
- Go to http://localhost:8080 to view the website.
2. Create a task
3. Search and filter tasks
4. Complete a task
5. Delete a task
### Running the Test Cases
1. Add test cases (optional)
- In test_cases.json, follow the format of the existing test cases to create your own.
- Make sure to set actualValid and passed to null so that the automated test runner will update the values according to the test case results.
2. Run automated tests
- In the terminal, go to the root folder of the project (taskpadphp_webapp).
- Enter the command php tests/run_tests.php to execute the automated test runner.
- View the results of each test outputted in the terminal.

## Sources
### Code Help
- Serving PHP files outside of htdocs directory: https://tonyfrenzy.medium.com/xampp-serving-from-any-directory-outside-of-htdocs-22a93f1b8815
- Parsing JSON file in PHP: https://www.geeksforgeeks.org/php/how-to-parse-a-json-file-in-php/
- Grabbing array values from keys: https://stackoverflow.com/questions/29308898/how-to-extract-and-access-data-from-json-with-php
- Dynamically adding header and footer: https://t4tutorials.com/how-to-create-the-same-header-and-footer-on-separate-web-pages-in-php/
- Redirect button: https://stackoverflow.com/questions/2906582/how-do-i-create-an-html-button-that-acts-like-a-link
- Saving array to JSON file: https://stackoverflow.com/questions/7895335/append-data-to-a-json-file-with-php
- Encoding array as JSON with pretty print format: https://www.delftstack.com/howto/php/how-to-generate-json-file-in-php/
- Flash messages: https://www.phptutorial.net/php-tutorial/php-flash-messages/
- Using SVG element in HTML and styling with CSS: https://stackoverflow.com/a/18968794/31760302
- Generating a unique ID: https://www.w3schools.com/PHP/func_misc_uniqid.asp
- Setting value of input with PHP: https://stackoverflow.com/questions/5102487/html-input-value-change
- Adding mouseover/hover text: https://www.w3docs.com/snippets/html/how-to-add-a-mouseover-text-with-html.html
- SVG image accessibility: https://stackoverflow.com/questions/4697100/accessibility-recommended-alt-text-convention-for-svg-and-mathml
- Case-insensitive string search function: https://www.w3schools.com/PHP/func_string_stripos.asp
- Extending footer to bottom of page: https://stackoverflow.com/questions/9741701/how-can-i-extend-a-footer-to-bottom-of-page
- Fade animation for flash message: https://www.html-code-generator.com/css/animations/fade
### Images
- Logo: https://fonts.google.com/icons?icon.size=64&icon.color=%23FFFFFF&icon.query=note&selected=Material+Symbols+Outlined:event_note:FILL@0;wght@400;GRAD@0;opsz@48
- Search icon: https://fonts.google.com/icons?icon.size=64&icon.color=%23FFFFFF&icon.query=search&selected=Material+Symbols+Outlined:search:FILL@0;wght@400;GRAD@0;opsz@48
- Complete icon: https://fonts.google.com/icons?icon.size=64&icon.color=%23FFFFFF&icon.query=complete&selected=Material+Symbols+Outlined:check_small:FILL@0;wght@400;GRAD@0;opsz@48
- Incomplete icon: https://fonts.google.com/icons?icon.size=64&icon.color=%23FFFFFF&icon.query=incomplete&selected=Material+Symbols+Outlined:check_indeterminate_small:FILL@0;wght@400;GRAD@0;opsz@48
- Delete icon: https://fonts.google.com/icons?icon.size=64&icon.color=%23FFFFFF&icon.query=trash&selected=Material+Symbols+Outlined:delete:FILL@0;wght@400;GRAD@0;opsz@48