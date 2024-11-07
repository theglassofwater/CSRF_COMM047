In this example, we simulate a scenario where an attacker can change a user's password on a vulnerable banking website. The site allows logged-in users to change their password, but it lacks CSRF protection, making it vulnerable to an attack.

## Setup

1. Clone this repository or download the files.
2. Install PHP and SQLite if they’re not already installed.
3. Set up the SQLite database by running `db_setup.php` to create a sample user.

    ```bash
    php db_setup.php
    ```

4. Start a local PHP server:

    ```bash
    php -S localhost:8000
    ```

5. Access the website at `http://localhost:8000`.

## Files

- **db_setup.php**: Initializes the SQLite database with a sample user (username: `user`, password: `password123`).
- **login.php**: Allows users to log in and start a session.
- **change_password.php**: Allows logged-in users to change their password (vulnerable to CSRF).
- **malicious_page.html**: Simulates an attacker’s page that performs a CSRF attack to change the user's password to `hacked_password`.

## Usage

1. **Initialize the Database**: Run `db_setup.php` to create the SQLite database with a sample user.

2. **Log In**: Go to `http://localhost:8000/login.php` and log in with the following credentials:
   - **Username**: `user`
   - **Password**: `password123`

3. **CSRF Attack Simulation**: Open `malicious_page.html` in your browser (simulating the user visiting a malicious site). The page will automatically submit a request to change the user's password to `hacked_password`.

4. **Verify the Attack**: Go back to `http://localhost:8000/login.php`, try logging in with the new password `hacked_password` to confirm the attack was successful.

## How CSRF Works

In this example:
- **CSRF Attack Vector**: The attacker creates a page (`malicious_page.html`) that auto-submits a form to `change_password.php`, changing the user's password.
- **Vulnerability**: The server does not check if the request originated from a trusted source, allowing the malicious request to go through.
- **Session Cookie**: Since the user is logged in, the browser includes the session cookie, which authenticates the user on the backend and allows the password change.

## Preventing CSRF

To secure this application from CSRF, you can add **CSRF tokens** to forms on sensitive pages (like `change_password.php`). A CSRF token ensures that only requests from the same origin are processed, preventing external sites from making unauthorized changes.

For example:
- Generate a unique CSRF token for each session.
- Include the CSRF token as a hidden field in the form.
- Validate the token on the server before processing the request.

## License

This project is for educational purposes only.
