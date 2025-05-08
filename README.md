# 🛍️ Delivery App – Laravel REST API Backend

A RESTful API backend for a delivery application, built using **Laravel**. This API allows users to browse products by category and store, manage their profiles, place and edit orders, maintain a favorites list, and verify their account via OTP email using **Gmail SMTP**. Laravel Sanctum is used for secure token-based authentication.

---

## ✨ Features

- 🔐 **Authentication**
  - User registration and login
  - OTP email verification via **Gmail SMTP**
  - Token-based API security (Laravel Sanctum)

- 👤 **User Profile**
  - View and update profile info
  - Upload or change avatar image

- 🛒 **Product Browsing**
  - Browse product categories
  - View stores under each category
  - Browse products in a store
  - View product details
  - Search by product or store name

- ❤️ **Favorites**
  - Add/remove products to/from favorites
  - View favorites by product category

- 🧺 **Cart & Orders**
  - Add/remove/edit products in the cart
  - Place new orders
  - Edit or cancel orders
  - View past orders

- 📦 **Stock Handling**
  - Product stock is updated when:
    - An order is delivered
    - An order is canceled or removed

---

## 🔧 Tech Stack

- **Laravel 11**
- **MySQL**
- **Laravel Sanctum**
- **Gmail SMTP** (OTP delivery)
- **Postman** (API testing)

---

## 🗂️ Project Structure

```bash
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           ├── Auth/
│   │           │   ├── LoginController.php
│   │           │   └── RegisterController.php
│   │           ├── CartController.php
│   │           ├── CategoryController.php
│   │           ├── FavoriteController.php
│   │           ├── OrderController.php
│   │           ├── OrderItemController.php
│   │           ├── ProductController.php
│   │           ├── ProfileController.php
│   │           ├── SearchController.php
│   │           └── StoreController.php
│
│   ├── Models/
│   │   ├── CartItem.php
│   │   ├── Category.php
│   │   ├── Favorite.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   ├── Profile.php
│   │   ├── Store.php
│   │   ├── User.php
│   │   └── UserPhoto.php
│
├── database/
│   ├── seeders/
│   │   ├── CategorySeeder.php
│   │   ├── ProductSeeder.php
│   │   ├── StoreSeeder.php
│   │   └── UserSeeder.php
├── routes/
│   └── api.php
├── database/
│   └── migrations/
├── tests/
│   └── Feature/
├── .env.example
├── composer.json
└── README.md

---
## 📍 Key API Endpoints

### 🚀 Authentication & User Management

- **POST** `/register`  
  Register a new user.
  
- **POST** `/verify-otp`  
  Verify the OTP sent to the user's email for account activation.

- **POST** `/login`  
  User login with email and password.

- **POST** `/logout`  
  Log out the authenticated user.

---

### 🛍️ Products, Categories & Stores

- **GET** `/categories`  
  Get the list of product categories.

- **GET** `/categories/{categoryId}/stores`  
  Get the list of stores for a specific category.

- **GET** `/stores/{storeId}/products`  
  Get the list of products for a specific store.

- **GET** `/stores/{storeId}/products/{productId}`  
  Get detailed information about a specific product.

- **GET** `/home/products`  
  Get a list of products displayed on the home page (x number of products).

---

### 🛒 Cart Management

- **POST** `/cart`  
  Add a product to the cart.

- **PUT** `/cart/{cartItemId}`  
  Update the quantity of a product in the cart.

- **DELETE** `/cart/{cartItemId}`  
  Remove a product from the cart.

- **GET** `/cart`  
  Get the list of products in the cart.

---

### 🧑‍🤝‍🧑 Orders Management

- **GET** `/orders`  
  Get the list of orders placed by the authenticated user.

- **GET** `/orders/{orderId}`  
  Get details of a specific order.

- **POST** `/orders`  
  Create a new order.

- **DELETE** `/orders/{orderId}`  
  Cancel a specific order.

- **GET** `/orders/{orderId}/items/{itemId}`  
  Get details of a specific item in an order.

- **PUT** `/orders/{orderId}/items/{itemId}`  
  Update a specific item in an order.

- **DELETE** `/orders/{orderId}/items/{itemId}`  
  Remove an item from an order.

---

### 💖 Favorites

- **GET** `/favorites`  
  Get the list of the user's favorite products.

- **POST** `/favorites`  
  Add a product to the user's favorites.

- **DELETE** `/favorites`  
  Remove a product from the user's favorites.

---

### 👤 User Profile Management

- **GET** `/profile`  
  Get the authenticated user's profile data.

- **GET** `/profile/photos`  
  Get the list of available profile photos.

- **PUT** `/profile/photo`  
  Update the user's profile photo.

- **PUT** `/profile/password`  
  Update the user's password.

- **PUT** `/profile/first-name`  
  Update the user's first name.

- **PUT** `/profile/last-name`  
  Update the user's last name.

- **PUT** `/profile/email`  
  Update the user's email address.

- **PUT** `/profile/phone-number`  
  Update the user's phone number.

- **PUT** `/profile/location`  
  Update the user's location.

---

### 📌 Notes:

- All routes under **authentication**, **profile**, **favorites**, **orders**, and **cart** are protected by `auth:sanctum` middleware.  
  This means that to access these routes, the user must be authenticated.
  
- Make sure to use **Sanctum Authentication** for login, registration, and other routes that require the user to be authenticated.

#### Usage
clone the repositoryvia git clone or download the zip file.

##### Install dependencies
###### `composer install`

##### Configure environment variables
###### ```
cp .env.example .env
php artisan key:generate`
```
### In env configure your database and Gmail SMTP credentials
###### ```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
```
##### Run database migrations
###### `php artisan migrate`

##### Seed the database
###### `php artisan db:seed`

##### Serve locally
###### `php artisan serve`
