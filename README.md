In this example, we simulate a scenario where an attacker can change a user's password on a vulnerable banking website. The site allows logged-in users to change their password, but it lacks CSRF protection, making it vulnerable to an attack.

## Setup

1. Clone this repo, and have PHP and SQLite installed.
2. Set up the SQLite database by running `db_setup.php` to create a sample user.

    ```bash
    php db_setup.php
    ```

3. Start a local PHP server:

    ```bash
    php -S localhost:8000
    ```

5. Go to `http://localhost:8000`.

## Files

- **db_setup.php**: Initializes the SQLite database with a sample user (username: `user`, password: `password123`).
- **login.php**: Allows users to log in and start a session.
- **change_password.php**: Allows logged-in users to change their password (vulnerable to CSRF).
- **malicious_page.html**: Simulates an attacker’s page that performs a CSRF attack to change the user's password to `hacked_password`.

## Usage

1. **Initialize the Database**: Run `db_setup.php` to create the SQLite database with a sample user.

2. **Log In**: Go to `http://localhost:8000/login.php` and log in with the following credentials:
   - **Username**: `user`
   - **Password**: `password`

3. **CSRF Attack Simulation**: Open `malicious_page.html` in your browser (simulating the user visiting a malicious site). The page will automatically submit a request to change the user's password to `hacked_password`.

4. **Verify the Attack**: Go back to `http://localhost:8000/login.php`, try logging in with the new password `hacked_password` to confirm the attack was successful.

## Preventing CSRF

To secure this application from CSRF, you can add **CSRF tokens** to forms on sensitive pages (like `change_password.php`). A CSRF token ensures that only requests from the same origin are processed, preventing external sites from making unauthorized changes.

For example:
- Generate a unique CSRF token for each session.
- Include the CSRF token as a hidden field in the form.
- Validate the token on the server before processing the request.
