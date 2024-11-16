In this example, we simulate a scenario where an attacker can change a user's password on a vulnerable banking website. The site allows logged-in users to change their password, but it lacks CSRF protection, making it vulnerable to an attack.

## Setup

1. Clone this repo, and have PHP and SQLite installed.
2. Run this PHP script that sets up the database and adds 3 sample users.

    ```bash
    php database/db_setup.php
    ```

3. Start a local PHP server:

    ```bash
    php -S localhost:8000
    ```

5. Go to `http://localhost:8000`.

## Usage

1. **Log In**: Go to `http://localhost:8000/login.php` and log in with the following credentials:
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
