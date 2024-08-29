# To-Do List Application

## Description
This is a simple To-Do List application built with PHP and MySQL. It allows users to manage their tasks with functionality for adding, editing, and deleting tasks. 

## Prerequisites
- XAMPP installed on your local machine

## Setup Instructions

1. **Start XAMPP**
   - Open the XAMPP Control Panel.
   - Start the Apache and MySQL services.

2. **Create the Database and Tables**
   - Open your web browser and navigate to `http://localhost/phpmyadmin`.
   - Click on the "SQL" tab to open the SQL console.
   - Run the following commands to create the database and tables:
     ```sql
     CREATE DATABASE todo_app;
     USE todo_app;

     CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );

     CREATE TABLE tasks (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       task VARCHAR(255) NOT NULL,
       completed TINYINT(1) DEFAULT 0,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
     );
     ```

3. **Place the Project Files**
   - Navigate to `C:\xampp\htdocs` on your system.
   - Paste the `todo-app` folder (provided via GitHub or WhatsApp) into the `htdocs` directory.

4. **Open the Project in VS Code**
   - Open Visual Studio Code (VS Code).
   - Open the `todo-app` folder located in `C:\xampp\htdocs` in VS Code.

5. **Verify Server Status**
   - Ensure that Apache and MySQL are running in the XAMPP Control Panel.

6. **Access the Application**
   - Open your web browser (e.g., Chrome).
   - Type `http://localhost/todo-app` in the address bar and press Enter to access the application.

