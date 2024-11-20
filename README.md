The site allows users to log in, then to change their password.
On the change password page, there is also an advert that gives you free money!
When the advert is clicked, it sends a post request on behalf of the user, changing the password to 'hacked_password'.
You can check if the password has changed by trying to login again using the original password, which is 'password'.

To prevent the CSRF attack, there is a tick box below the login input boxes that activates CSRF protection, stopping the CSRF attack from affecting the account. 
This CSRF pretection works by generating a unique CSRF token for each user session and embedding it as a hidden field and checking for it in forms, like when user requests a password change. 
<!-- The token is also stored on the server in the user's session. -->


## Setup

(I have a Linux Unbuntu machine, so i hope this works on your machine aswell)

1. Clone this repository, and have installed PHP and SQLite, and have enabled SQLite3 for PHP.
2. cd into CSRF_COMM047 or CSRF_COMM047-main directory.
3. Run this PHP script that sets up the database and adds 3 sample users, using the following command:

    ```bash
    php database/db_setup.php
    ```

4. Start a local PHP server, using the following command:

    ```bash
    php -S localhost:3000
    ```

5. Go to `http://localhost:3000`.


## How to use

1. Log In: log in with the following credentials:
   Username = `user1`
   Password = `password`

2. Change password to whatever you want.

3. Verify password change by going back to `http://localhost:3000` and trying to log in with the same username.

4. To be the victim of the CSRF attack: Log in, then click the advert which changes your password to  `hacked_password`

## How to prevent CSRF

To prevent the CSRF attack, just tick the CSRF prevention box on the log in page. Then test trying to click the advert.
