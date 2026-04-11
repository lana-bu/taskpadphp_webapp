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
- On the homepage (index.php), click the "Add Task" button.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014342" src="https://github.com/user-attachments/assets/5354ac19-7012-421e-844d-893f233fdc3c" />
- At least enter a title and select a desired priority. Optionally, you can provide a description and date as well. Click the "Create New Task" button when you're ready to submit your info.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014511" src="https://github.com/user-attachments/assets/5849c0e2-16d7-4b08-b2ed-14aa9f08cdcb" />
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014555" src="https://github.com/user-attachments/assets/3ff3edb6-742a-4a76-8e57-ccc7f53088fd" />
- View your new task displayed on the homepage at the bottom of the task list.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014629" src="https://github.com/user-attachments/assets/b7ab16f6-09ad-4ee3-b213-9a7b77c57028" />
3. Search and filter tasks
- Filter for tasks of a specific priority.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014823" src="https://github.com/user-attachments/assets/134de894-b35b-4c06-b49c-315e84e62a63" />
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 014915" src="https://github.com/user-attachments/assets/45aa4d4b-fb0f-47f2-a27e-5e9799d51f50" />
- Search for phrases in the title or description of tasks. You can pair this with one or both of the other filters (paired with completion status filter here).
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 020158" src="https://github.com/user-attachments/assets/18298e26-274b-46c1-8101-2341ed121888" />
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 015107" src="https://github.com/user-attachments/assets/90464654-9973-4bad-a41f-607864492106" />
4. Complete a task
- Click the "Mark as Completed" button on any uncompleted task. This will change the dash into a checkmark.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 015209" src="https://github.com/user-attachments/assets/c58e78f7-3ff0-4600-a3fd-e59e14d19bbd" />
- A flash message stating "Task completed" will appear on the screen temporarily to indicate that the task has been marked as completed.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 015124" src="https://github.com/user-attachments/assets/7b0dda73-a53b-4e88-bbb2-adb70fd3f3b8" />
5. Delete a task
- Click the delete button (with a trash can icon) on any task. This will remove the task from the list.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 015246" src="https://github.com/user-attachments/assets/14fcb445-2087-4b00-ab0c-d4abbe818eb2" />
- A flash message stating "Task deleted" will appear on the screen temporarily to indicate that the task has been deleted.
  - <img width="2240" height="1328" alt="Screenshot 2026-04-11 015227" src="https://github.com/user-attachments/assets/de7bc887-6923-4980-ab17-76152ac20ef2" />
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
