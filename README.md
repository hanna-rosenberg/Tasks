<img src="https://media.giphy.com/media/L46ihZAH8bZR9ZXzpR/giphy.gif">

# To Do!

This site will help you organize your chaos.

Link to Github: https://github.com/hanna-rosenberg/Tasks

# Installation

1. Clone the repository to your computer.
2. Add a folder named "uploads" to the root of the project.
3. Start a local server in the command line.
4. Open the index.html file in your browser.

# Code Review

Code review written by [Emma Ramstedt](https://github.com/deliciaes).

1. `lists.php:272` - There is a quotation mark missing at the end of alt="Cross for delete>
2. `app/tasks/update.php:36` - You have two redirects here. The latter will never be executed, so you can remove one of them.
3. Tip - I noticed that the file upload have spaces in their names. Could be worth considering avoiding spaces in file names.
4. Tip - Try to use htmlspecialchars() function where the users data is being printed, to avoid any shenanigans.
5. Tip - Files that should only be accessed when logged in can be accessed if you know the URL. Consider adding a function at the top of these pages that redirect the user somewhere else if they are not logged in.
6. `app/asstes/styles/app.css` - It can be worth to split the css in to smaller files for easier readability.
7. Tip - The files app/users/tasks.php and app/users/lists.php might belong better under app/lists and app/posts for a better file structure.
8. Tip - Currently the user gets an error 500 when trying to register with an email that already exists. Consider checking the email against the database first and redirect the user along with an error message if the email already exists.
9. Tip - Consider having your comments in English in case the reader doesn't understand Swedish.
10. `app/users/edit.php:104` - The tags <!-- --> does not work with php. Use // to comment out the row!

# Testers

Tested by the following people:

1. Jennifer Andersson
2. Johanna Jönsson

# Wunderlist+

2 additional features by [Marcus Hägerstrand](https://github.com/marcusxyz)

- As a user I'm able to delete my account along with all tasks and lists.
- As a user I'm able to mark all tasks in a list as completed with one click.
