# 🛒 Shopping Cart (PHP)

## 🧪 Overview

A simple shopping cart application built with **PHP, JavaScript, HTML and CSS**.

This project was created before I started using React and modern frontend frameworks.
It demonstrates how a shopping cart can be implemented using **server-side rendering**, **PHP Session**, and vanilla JavaScript.

Later, I rebuilt the same concept using React to compare frontend-only state management with a backend session approach.

## 🌐 Live Demo

🔗 Demo: https://shopping-cart-csdw.onrender.com/

📦 Source Code: https://github.com/jillchiu/shopping_cart

## 📷 Screenshot

![index](https://i.imgur.com/Kj3xk7K.png)

## ✨ Features

* Product list
* Shopping cart
* Add products
* Increase quantity
* Decrease quantity
* Remove products
* Empty cart
* Automatic total price calculation
* Session-based cart persistence
* Product hover animation
* Responsive layout

## 🛠 Tech Stack

* PHP
* HTML5
* CSS3
* JavaScript (Vanilla)
* PHP Session

## 📁 Project Structure

```
shopping-cart-php/

├── index.php
├── css/
│   └── style.css
├── js/
│   └── script.js
└── img/
```

## 🧩 Architecture

### Server Side

PHP handles:

* Product data
* Cart state
* Quantity updates
* Total price calculation
* Session management
* Rendering HTML

### Client Side

JavaScript handles:

* AJAX requests
* Hover animation
* Cart open/close animation
* Page interaction

Unlike the React version, the shopping cart state is stored inside **PHP Session**, making it survive page refreshes without frontend state management.

## 📚 What I Learned

During this project I learned how to build a complete shopping cart without using any frontend framework.

Topics included:

* PHP Session
* CRUD-like cart operations
* DOM manipulation
* Fetch API
* AJAX communication
* Server-side rendering
* State persistence
* Responsive CSS

## ⚠ Legacy Project

This project represents an earlier stage of my development.

Some implementation choices are intentionally left unchanged to preserve the original work.

Examples include:

* Single-file PHP architecture
* Inline business logic
* Limited separation of concerns
* No routing
* No database
* No authentication
* No dependency management

If I were rebuilding this project today, I would likely:

* Separate controllers, services and views
* Use a database instead of hardcoded data
* Introduce REST APIs
* Improve folder structure
* Apply MVC architecture
* Add validation and error handling
* Write automated tests

## 🔄 Related Project

I also created another Shopping Cart using **React**.

While this version stores cart data in **PHP Session**, the React version stores everything in **Context API** on the client side.

Implementing both projects allowed me to compare:

| PHP Version | React Version |
|-------------|---------------|
| Server-side rendering | Client-side rendering |
| PHP Session | React Context |
| Full page refresh | SPA updates |
| Server-managed state | Client-managed state |
| Vanilla JavaScript | React Components |

This comparison helped me better understand the different responsibilities of backend and frontend architectures.

This project is kept as part of my portfolio to show my progression from traditional PHP development to modern React applications.

Rather than replacing older work, I keep both implementations available to demonstrate how I approached the same problem using different technologies at different stages of my learning.
