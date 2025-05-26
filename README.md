# Laravel eCommerce Project – Final Year Project

Thank you for visiting my Final Year Project repository. This project is a fully functional **eCommerce web application** developed using the Laravel framework.

---

## Project Overview

This application enables users to browse products, manage their shopping cart, place orders, and includes an admin panel to manage products, categories, and orders efficiently. It is designed with user-friendliness and security in mind.

---

## Key Features

* User registration, login, and profile management
* Product catalog with categories and search options
* Shopping cart and seamless checkout process
* Order management accessible by both users and administrators
* Admin panel for managing products, categories, and orders
* Secure authentication and authorization
* Responsive design suitable for both desktop and mobile devices

---

## Technologies Used

* Laravel (PHP Framework)
* MySQL (Database)
* Blade Templating Engine
* Bootstrap (Frontend CSS Framework)
* Git and GitHub for version control

---

## Installation Instructions

To set up and run this project locally, please follow these steps:

1. **Clone the repository**

   ```
   git clone https://github.com/abasit179/ecommerce-project.git
   ```

2. **Navigate to the project directory**

   ```
   cd ecommerce-project
   ```

3. **Install PHP dependencies**

   ```
   composer install
   ```

4. **Copy the environment file and configure your settings**

   ```
   cp .env.example .env
   ```

   Update the `.env` file with your database and other environment-specific details.

5. **Generate the application key**

   ```
   php artisan key:generate
   ```

6. **Run the database migrations**

   ```
   php artisan migrate
   ```

7. *(Optional)* **Seed the database with sample data**

   ```
   php artisan db:seed
   ```

8. **Start the development server**

   ```
   php artisan serve
   ```

9. Open your browser and visit `http://localhost:8000` to access the application.

---

## Contributions

I welcome contributions and improvements. Please feel free to fork the repository and submit pull requests. Your suggestions and help are appreciated.

---

## License

This project is licensed under the MIT License.

---

Thank you for your interest in my project!
