The site allows users to login, then to change their password. 
On the change password page, there is also an advert that gives you free money!
When the advert is clicked, it sends a post request on behalf of the user, changing the password to 'hacked_password'.
You can check if the password has changed by trying to login again.
To prevent the CSRF attack, there is a tick box below the login input boxes that activates CSRF protection, stoping the CSRF attack from affecting the account. This CSRF pretection works by 
, but it lacks CSRF protection, making it vulnerable to an attack.

In this example, we simulate a scenario where an attacker can change a user's password on a vulnerable banking website. 

## Setup

(I have a linux unbuntu machine, so i hope it works on your machine aswell.)

1. Clone this repo, and have PHP and SQLite installed.
2. cd into CSRF_COMM047 directory.
3. Run this PHP script that sets up the database and adds 3 sample users, using the following command:

    ```bash
    php database/db_setup.php
    ```

4. Start a local PHP server, using the following command:

    ```bash
    php -S localhost:8000
    ```

5. Go to `http://localhost:8000`.

## Information

This process is designed to be pretty intuitive.

There are 3 accounts, user1, user2, user3 all with password = 'password'.
When being hacked, it changes the password to "hacked_password".

The tick box below login activates CSRF prevention, blocking the hacker from changing your password.

This demonstration only needs you to to play around with one user. The other ones are not needed.

## Usage

1. Log In: log in with the following credentials:
   Username = `user1`
   Password = `password`

2. **CSRF Attack Simulation**: Open `malicious_page.html` in your browser (simulating the user visiting a malicious site). The page will automatically submit a request to change the user's password to `hacked_password`.

4. **Verify the Attack**: Go back to `http://localhost:8000/login.php`, try logging in with the new password `hacked_password` to confirm the attack was successful.

## Preventing CSRF

To secure this application from CSRF, you can add **CSRF tokens** to forms on sensitive pages (like `change_password.php`). A CSRF token ensures that only requests from the same origin are processed, preventing external sites from making unauthorized changes.

For example:
- Generate a unique CSRF token for each session.
- Include the CSRF token as a hidden field in the form.
- Validate the token on the server before processing the request.
