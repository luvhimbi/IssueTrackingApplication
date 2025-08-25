# Issue Tracking System

## Overview
A web-based **Issue Tracking System** built with **Laravel**, **Bootstrap (Bootswatch Lux)**,**sortable js for the drag and drop functionality**, and **SweetAlert2**.  
Designed for individuals to be able manage  issues efficiently, featuring a **Jira-like Kanban board**.

---

## Features

- User Authentication (Register, Login, Logout)
- Profile Management (Update Details & Password)
- CRUD operations for Issues
- Kanban-style drag-and-drop board
- Filters by Status and Priority
- SweetAlert2 and boostrap alerts interactive notifications
- Responsive design using Bootstrap and Poppins font

---

## Technologies Used

- **Backend:** Laravel 12  
- **Frontend:** Bootstrap 5 (Bootswatch Lux), Poppins Font, SweetAlert2, SortableJS  
- **Database:** PostgreSQL  
- **Icons:** Bootstrap Icons  

---
## Screenshots
- **Register page :**
<img width="1919" height="935" alt="image" src="https://github.com/user-attachments/assets/351542d8-5254-40b1-bdce-699b9134395f" />

-**Login page :**
<img width="1905" height="947" alt="image" src="https://github.com/user-attachments/assets/b086fc13-7570-4fd5-934c-b8ac479bd973" />

-**dashboard page has the kanboard like drag and drop board:**
<img width="1916" height="946" alt="image" src="https://github.com/user-attachments/assets/4d77a1e3-37e6-4673-833a-1ac6cb7a621f" />
-**profile page :**
<img width="1914" height="965" alt="image" src="https://github.com/user-attachments/assets/1e3016cf-0649-484a-a846-454a7a471d64" />






Installation

Follow these steps to set up the Issue Tracking Application on your local machine.

1. Clone the Repository

Clone the repository from GitHub and navigate to the project directory:

git clone https://github.com/luvhimbi/IssueTrackingApplication
cd IssueTrackingApplication

2. Install Composer Dependencies

Install the required PHP dependencies using Composer:

composer install

3. Configure Environment Variables

Create a .env file by copying .env.example and configure your database credentials:

APP_NAME=IssueTrackingSystem
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=issuetrackerapplication
DB_USERNAME=root
DB_PASSWORD=

4. Generate Laravel Application Key

Generate a unique application key for your Laravel application:

php artisan key:generate

5. Run Database Migrations

Create a database named issuetrackerapplication in pgAdmin or your PostgreSQL client. Then, run the migrations to set up the database schema:

php artisan migrate

6. Start the Application

Launch the Laravel development server:

php artisan serve

Visit the application in your browser at:

http://127.0.0.1:8000/

Requirements
PHP >= 8.0
Composer
PostgreSQL
Node.js and NPM (for frontend assets, if applicable)







