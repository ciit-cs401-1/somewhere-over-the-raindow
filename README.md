# Laravel Blog Site

A dynamic blog website built with Laravel featuring posts, categories, and tags.

## Prerequisites

Before setting up this project, make sure you have the following installed:

### Required Software:
- **PHP 8.1 or higher** - [Download PHP](https://windows.php.net/download/)
- **Composer** - [Download Composer](https://getcomposer.org/download/)
- **Git** - [Download Git](https://git-scm.com/downloads)
- **Web Server** (Apache/Nginx) or use Laravel's built-in server

### Database:
- **SQLite** (included with PHP) - Recommended for development
- **MySQL** - [Download MySQL](https://dev.mysql.com/downloads/)
- **PostgreSQL** - [Download PostgreSQL](https://www.postgresql.org/download/)

### Optional (for better development experience):
- **Node.js & NPM** - [Download Node.js](https://nodejs.org/) (for frontend assets)
- **VS Code** - [Download VS Code](https://code.visualstudio.com/) (recommended editor)

## Project Setup

This project has been set up with the following database structure and backend functionality:

### Database Tables Created:
- **categories** - Blog categories with name, slug, and description
- **posts** - Blog posts with title, slug, content, excerpt, featured image, status, and relationships
- **tags** - Blog tags with name and slug
- **post_tag** - Pivot table for many-to-many relationship between posts and tags

### Completed Tasks:
✅ Laravel project setup  
✅ Database migrations created and run  
✅ Database structure with proper relationships  
✅ **Eloquent Models** - Category, Post, and Tag models with relationships  
✅ **Controllers** - PostController, CategoryController, and TagController with full CRUD operations  
✅ **Routes** - Resource routes for posts, categories, and tags  
✅ **Database Seeders** - Sample data for testing  
✅ **Validation** - Form validation for all inputs  
✅ **Error Handling** - Proper error handling and success messages  

### Tasks for Teammate:

#### 1. Views/Blade Templates (Priority)
- Create layout template (`resources/views/layouts/app.blade.php`)
- Create post listing page (`resources/views/posts/index.blade.php`)
- Create individual post view (`resources/views/posts/show.blade.php`)
- Create post forms (`resources/views/posts/create.blade.php`, `resources/views/posts/edit.blade.php`)
- Create category pages (`resources/views/categories/index.blade.php`, `resources/views/categories/show.blade.php`)
- Create tag pages (`resources/views/tags/index.blade.php`, `resources/views/tags/show.blade.php`)

#### 2. Styling & UI/UX
- Add CSS/styling to make the blog look professional
- Consider using Tailwind CSS or Bootstrap
- Make it responsive for mobile devices
- Add navigation menu
- Create beautiful post cards and layouts

#### 3. Advanced Features
- User authentication for admin features
- Search functionality
- Pagination styling
- Image upload for featured images
- Rich text editor for post content
- Comment system (optional)
- Social sharing buttons

#### 4. Testing & Polish
- Test all CRUD operations
- Add error pages (404, 500)
- Optimize for performance
- Add meta tags for SEO

## Getting Started

1. **Clone the repository**
   ```bash
   git clone https://github.com/ciit-cs401-1/somewhere-over-the-raindow.git
   cd somewhere-over-the-raindow
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Set up environment file**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Configure database** (edit `.env` file)
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database with sample data**
   ```bash
   php artisan db:seed
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Visit the application**
   Open [http://localhost:8000](http://localhost:8000) in your browser

## Available Routes

- `GET /` - Home page (shows blog posts)
- `GET /posts` - List all posts
- `GET /posts/create` - Create new post form
- `GET /posts/{post}` - Show individual post
- `GET /posts/{post}/edit` - Edit post form
- `GET /categories` - List all categories
- `GET /categories/{category}` - Show category with posts
- `GET /tags` - List all tags
- `GET /tags/{tag}` - Show tag with posts

## Database Schema

```
categories:
- id (primary key)
- name (string)
- slug (string, unique)
- description (text, nullable)
- timestamps

posts:
- id (primary key)
- title (string)
- slug (string, unique)
- content (text)
- excerpt (text, nullable)
- featured_image (string, nullable)
- status (enum: draft/published)
- category_id (foreign key)
- user_id (foreign key)
- timestamps

tags:
- id (primary key)
- name (string)
- slug (string, unique)
- timestamps

post_tag (pivot table):
- id (primary key)
- post_id (foreign key)
- tag_id (foreign key)
- timestamps
```

## Sample Data

The database has been seeded with:
- 5 categories (Technology, Travel, Food, Lifestyle, Business)
- 20 tags (Laravel, PHP, JavaScript, etc.)
- 4 sample blog posts with proper relationships

## Backend Features Completed

- **Models**: All models with proper relationships and slug generation
- **Controllers**: Full CRUD operations with validation
- **Routes**: Resource routes for all entities
- **Validation**: Comprehensive form validation
- **Relationships**: Proper Eloquent relationships between all entities
- **Scopes**: Published posts scope for filtering

## Troubleshooting

### Common Issues:

1. **"No application encryption key has been specified"**
   - Run: `php artisan key:generate`

2. **"Class 'PDO' not found"**
   - Install PHP PDO extension: `sudo apt-get install php-pdo` (Linux) or enable in php.ini (Windows)

3. **"SQLite database does not exist"**
   - The migration will create it automatically, just run: `php artisan migrate`

4. **"Permission denied"**
   - Make sure storage and bootstrap/cache directories are writable

Your teammate can focus on the frontend and user experience! 🚀
