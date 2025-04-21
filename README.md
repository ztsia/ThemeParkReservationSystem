# 🎢 HyperHeaven – Theme Park Ticket Reservation System

Welcome to **HyperHeaven**, a Laravel-based web application that allows users to browse and reserve theme park tickets online. This project was developed as part of the UECS3294 Advanced Web Application Development assignment.

---

## 📌 Project Overview

HyperHeaven is a web-based ticket reservation system for a fictional theme park. Users can:

- Register and log in
- Browse available tickets and upcoming events
- Add tickets to their cart
- Choose a payment method (Cash, Credit Card, Online Banking)
- View order history
- Update user profiles

Admins can:

- Create, edit, or delete tickets and events
- View statistics and manage records

The application uses:
- **Laravel** (backend)
- **Blade templates** (frontend rendering)
- **MySQL** (database)
- **Laravel UI + Vue.js** (authentication scaffolding)

---

## 📦 Installation Instructions

> ⚠️ **Important:** To reduce file size for submission, the `vendor/` and `node_modules/` folders have been removed. Please install the dependencies after unzipping.

### 1. Unzip the project

Extract the ZIP archive to your desired directory.

### 2. Install dependencies

In your terminal or command prompt, navigate to the project folder and run:

composer install
npm install
npm run dev

### 3. Set up environment variables

Copy the .env.example file to .env
Or edit the .env file directly if already available

DB_DATABASE=your_database

DB_USERNAME=your_username

DB_PASSWORD=your_password

### 4. Create database

Create a MySQL database according to the name in the.env file above

### 5. Generate application key

Run "php artisan key:generate" in the terminal or command prompt

### 6. Generate storage link

Run "php artisan storage:link" in the terminal or command prompt

### 7. Create the database tables and populate them

Run "php artisan migrate --seed" in the terminal or command prompt

This step is to create the tables according to the migration files and populate them according to the seeders. 
