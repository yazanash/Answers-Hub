# AnswersHub

## Project Overview
AnswersHub is a web application developed using Laravel. It aims to provide a platform for university students and faculty members to ask questions, share articles, and engage in discussions. The platform enhances communication and knowledge exchange within the university community.

## Features
- **Ask and Answer Questions**: Users can post questions and provide answers.
- **Article Sharing**: Authorized users can share articles.
- **User Management**: Admins can manage user roles and permissions.
- **Profile Management**: Users can update their personal information.
- **Voting System**: Users can vote on answers to highlight the most useful ones.
- **Search Functionality**: Users can search for questions and articles.

## Requirements
- PHP 8.3 or higher
- Composer
- Laravel 11.x
- MySQL

## Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/answershub.git
    cd answershub
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```bash
    cp .env.example .env
    ```

4. Generate an application key:
    ```bash
    php artisan key:generate
    ```

5. Run the database migrations:
    ```bash
    php artisan migrate
    ```

6. Seed the database (optional):
    ```bash
    php artisan db:seed
    ```

7. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage
- Access the application at `http://localhost:8000`.
- Register a new account or log in with existing credentials.
- Explore the features by asking questions, sharing articles, and participating in discussions.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For any inquiries or support, please contact [your email address].

