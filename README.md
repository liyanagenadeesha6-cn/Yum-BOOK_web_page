# YumBook – Digital Recipe Book

Your Digital Recipe Diary | Create. Cook. Celebrate.

## Student Details
- **Name:** B.L.Chamodi Nadeesha
- **Index No:** ASB/2023/163 (6279)
- **Module:** COM 2303 — Web Design
- **University:** Rajarata University of Sri Lanka

## Project Description
YumBook is a digital recipe management web application built with 
HTML, CSS, Bootstrap, JavaScript, PHP and MySQL.

## Features
- Browse and search recipes
- Filter recipes by category
- Add new recipes with full details
- User registration and login
- Contact form with database storage
- User dashboard to view own recipes

## Technologies Used
- HTML5, CSS3, Bootstrap 5
- JavaScript
- PHP 8
- MySQL (via XAMPP)

## Database Setup
1. Open XAMPP and start Apache and MySQL
2. Open phpMyAdmin → http://localhost/phpmyadmin
3. Create a database named `recipe_book`
4. Import the `database.sql` file

## How to Run
1. Copy the `yumbook` folder to `C:\xampp\htdocs\`
2. Import `database.sql` into phpMyAdmin
3. Open browser and go to:
```
http://localhost/yumbook/index.html
```

## Pages
- `index.html` — Home page
- `recipes.html` — All recipes
- `categories.html` — Recipe categories
- `add-recipe.php` — Add new recipe
- `contact.php` — Contact form
- `auth/register.php` — User registration
- `auth/login.php` — User login
- `dashboard.php` — User dashboard

## Phase 3 — PHP & Database Integration
- MySQL database with users, recipes, messages tables
- User authentication with session handling
- Password hashing with password_hash()
- Contact form data stored in database
- Recipes saved to MySQL by logged-in users