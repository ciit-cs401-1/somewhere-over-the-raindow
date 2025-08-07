# Dynamic Blog Platform

This project is a dynamic, multi-user blog platform built with Laravel. It demonstrates key concepts in modern web development, including database-driven content, server-side authorization, and dynamic UI rendering.

## Key Features

- **Full CRUD Functionality:** Create, Read, Update, and Delete posts, categories, and tags.
- **Creator-Only Authorization:** Users can only edit or delete content that they have created, ensuring data integrity and ownership.
- **Dynamic "Hot Topics" Section:** The homepage automatically showcases the most popular posts based on view counts. This section is also context-aware, filtering its results based on the currently viewed category.
- **Database-Driven Content:** All content is managed in a relational database and served dynamically to the user.

## Technologies Used

This project serves as a practical example of the following dynamic web programming concepts:

- **Backend Framework:** [Laravel](https://laravel.com/) - A PHP framework for building robust web applications.
- **Database Interaction:** [Eloquent ORM](https://laravel.com/docs/eloquent) - For abstracting away database queries into clean, object-oriented PHP code.
- **Server-Side Authorization:** [Laravel Policies](https://laravel.com/docs/authorization#policies) - To manage user permissions and control access to resources.
- **Dynamic Views:** [Blade Templating Engine](https://laravel.com/docs/blade) - For conditionally rendering HTML on the server based on application state and user permissions (e.g., using `@can` directives).
- **Form Handling & Validation:** [Laravel Request Validation](https://laravel.com/docs/validation) - To process user input safely and ensure data integrity.
- **Database Management:** [Laravel Migrations](https://laravel.com/docs/migrations) - For version-controlling the database schema.

## Getting Started

### Prerequisites

- PHP 8.1 or higher
- Composer
- Git
- A database server (MySQL, PostgreSQL, or SQLite)

### Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/ciit-cs401-1/somewhere-over-the-raindow.git
    cd somewhere-over-the-raindow
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

3.  **Create your environment file:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure your database:**
    Open the `.env` file and update the `DB_*` variables with your database credentials.

6.  **Run the database migrations:**
    This will create all the necessary tables in your database.
    ```bash
    php artisan migrate
    ```

7.  **(Optional) Seed the database:**
    This will populate your database with sample data.
    ```bash
    php artisan db:seed
    ```

8.  **Start the development server:**
    ```bash
    php artisan serve
    ```

Your application will now be running at [http://localhost:8000](http://localhost:8000).
