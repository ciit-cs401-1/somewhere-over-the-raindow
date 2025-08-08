# Dynamic Blog Platform - Teacher's Setup Guide

This guide will help you set up the blog platform project for demonstration purposes. The setup is designed to be as straightforward as possible, even if you're not familiar with web development.

## What You'll Need

1. A computer (Windows, Mac, or Linux)
2. An internet connection
3. About 15-20 minutes of setup time

## Step 1: Install Dependencies

### 1.1 Install Composer Dependencies
1. Open a terminal or command prompt
2. Navigate to the project directory
3. Run the following command to install PHP dependencies:
   ```
   composer install
   ```
   This will download all required PHP packages for the project.

### 1.2 Install Required Software

### 1.2.1 Install XAMPP (Easiest Way)
XAMPP includes everything you need to run the project:
1. Go to [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
2. Download the version for your operating system
3. Run the installer and follow the on-screen instructions
   - On Windows: Keep all default options checked
   - On Mac: Just drag XAMPP to your Applications folder

### 1.2 Install Composer
1. Go to [https://getcomposer.org/download/](https://getcomposer.org/download/)
2. Download and run the installer
3. **Important:** When prompted, make sure to check the box that says "Add to PATH"
4. Complete the installation with all default settings

## Step 2: Get the Project Files

### 2.1 Download the Project
1. Open this link in your browser: [https://github.com/ciit-cs401-1/somewhere-over-the-raindow/archive/refs/heads/ash.zip](https://github.com/ciit-cs401-1/somewhere-over-the-raindow/archive/refs/heads/ash.zip)
2. This will download a ZIP file
3. Extract the ZIP file to your Desktop (right-click → Extract All)
4. You should now have a folder named `somewhere-over-the-raindow-ash` on your Desktop

## Step 3: Set Up the Project

### 3.1 Open Command Prompt (Windows) or Terminal (Mac)
- **Windows:** Press `Windows + R`, type `cmd`, and press Enter
- **Mac:** Open Spotlight (`Command + Space`), type `Terminal`, and press Enter

### 3.2 Navigate to the Project
Type these commands one by one and press Enter after each:

```bash
cd Desktop
cd somewhere-over-the-raindow-ash
```

### 3.3 Install Dependencies
```bash
composer install
```

### 3.4 Create Environment File
```bash
copy .env.example .env
```
(On Mac/Linux, use: `cp .env.example .env`)

### 3.5 Generate Application Key
```bash
php artisan key:generate
```

## Step 4: Set Up the Database

### 4.1 Start XAMPP
1. Open XAMPP Control Panel
2. Click "Start" next to "Apache" and "MySQL"
3. Leave this window open while using the application

### 4.2 Create Database
1. Open your web browser
2. Go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
3. Click "New" in the left sidebar
4. Under "Create database", type: `blog_db`
5. Click "Create"

### 4.3 Configure Database Connection
1. Open the `.env` file in the project folder (on your Desktop)
2. Find these lines and make sure they look exactly like this:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=blog_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

## Step 5: Run Database Setup

### 5.1 Run Migrations
In your command prompt/terminal (still in the project folder), run:
```bash
php artisan migrate --seed
```

This will create all the necessary database tables and add some sample data.

## Step 6: Start the Application

### 6.1 Run the Development Server
In the command prompt/terminal, run:
```bash
php artisan serve
```

### 6.2 Open in Browser
1. Open your web browser
2. Go to: [http://127.0.0.1:8000](http://127.0.0.1:8000)

You should now see the blog platform running!

## Logging In

Use these test accounts to log in:

**Admin Account:**
- Email: admin@example.com
- Password: password

**Regular User:**
- Email: user@example.com
- Password: password

## Troubleshooting

If something doesn't work:

1. **Port 8000 is in use?**
   - Press `Ctrl + C` to stop the server
   - Then run: `php artisan serve --port=8080`
   - Use: [http://127.0.0.1:8080](http://127.0.0.1:8080)

2. **Database connection error?**
   - Make sure XAMPP's Apache and MySQL are running (green in XAMPP Control Panel)
   - Double-check the `.env` file settings
   - Try running `php artisan config:clear`

3. **Still having issues?**
   - Contact [Your Email] for immediate assistance
   - Or visit: [Your Project's GitHub Issues Page]

## Project Features to Showcase

1. **Dynamic Content**
   - Posts, categories, and tags are loaded from the database
   - The "Hot Topics" section shows popular posts

2. **User Permissions**
   - Try logging in with both admin and regular user accounts
   - Notice how edit/delete options only appear for content you created

3. **Responsive Design**
   - The site works on both desktop and mobile devices

## How to Stop the Application

1. In the command prompt/terminal where `php artisan serve` is running
2. Press `Ctrl + C`
3. Type `Y` and press Enter to confirm

## How to Restart the Application

1. Open command prompt/terminal
2. Type:
   ```bash
   cd Desktop/somewhere-over-the-raindow-ash
   php artisan serve
   ```
