# Restful E-commerce API

<p align="center">
  <a href="https://laravel.com/" alt="Built with: Laravel v8.1.0">
    <img src="https://badgen.net/badge/Built%20with/Laravel%20v8.1.0/FF2D20" />
  </a>
  <a href="https://www.php.net/downloads.php" alt="Powered by: PHP v7.4.5">
    <img src="https://badgen.net/badge/Powered%20by/PHP%20v7.4.5/8892BF" />
  </a>
    <a href="https://laravel.com/" alt="Built with: tailwindcss">
    <img src="https://badgen.net/badge/Built%20with/TailWindCSS/1AB2BA" />
  </a>
</p>

## Features

-   Laravel Jetstream is used as an authentication mechanism, since it includes login, registration, email verification, two-factor authentication, and session management.
-   All the registered **users** are stored in the **'users'** table.
-   Registered users can **view** and **purchase** **products**.
-   Guest users can only view and cannot **purchase** **products**.
-   All **products** are stored in the **'products'** table.
-   All the user **orders** are stored in the **'orders'** table.
-   The **shipping** information is stored in the **'shipping_details'** table.

## Installation and Requirements

1. Install [Composer](https://getcomposer.org/download/)
2. Install [Xampp](https://www.apachefriends.org/download.html)
3. Clone the repository.
4. Use [Composer](https://getcomposer.org/download/) to install the required dependencies by navigating to the root directory of the cloned repository and run the following command inside the Terminal:

```bash
composer install
```

6. Rename the **".env.example"** file in the root directory to **".env"** and change you DB configurations.
7. Generate the application key by running the following command:

```bash
php artisan key:generate
```

## Running the application

1. Navigate to the root directory and run the following command inside the Terminal:

```bash
php artisan serve
```

2. Open Xampp and verify PhpMyAdmin is running.
3. Create a new database with name **_"ecommerce"_** using PhpMyAdmin.
4. Add the fake data by running the following commands inside the Terminal:

```bash
php artisan migrate
php artisan db:seed
```

-   ### NOTE: The directory **public/img** contains a few **image** files that are the part of fake data added by the migrations.

## LARAVEL / PHP / Other features used

-   **Laravel Jetstream**
-   **tailwindcss**
-   **Unit Testing**
