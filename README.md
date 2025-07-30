# Instant Dress Tracker - A Location-Based Fashion Discovery Web App

[![Status](https://img.shields.io/badge/status-in_development-blue)](https://github.com/your-username/instant-dress-tracker)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

A web-based platform that provides real-time visibility into the dress inventory of nearby clothing shops, bridging the gap between online browsing and offline shopping.

---

## Table of Contents

- [About The Project](#about-the-project)
  - [Problem Statement](#problem-statement)
  - [Our Solution](#our-solution)
- [Key Features](#key-features)
- [System Architecture](#system-architecture)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Project Scope](#project-scope)
- [The Team](#the-team)
- [License](#license)
- [Acknowledgements](#acknowledgements)

---

## About The Project

### Problem Statement

In the current retail environment, customers face significant challenges when searching for specific clothing items in physical stores. This process is often time-consuming and inefficient due to a lack of visibility into shop inventories. Shoppers waste time visiting multiple locations only to find that a desired dress is out of stock or unavailable in their size or preferred color.

### Our Solution

**Instant Dress Tracker** is an innovative web platform designed to eliminate this friction. It offers customers real-time visibility into the live inventory of local clothing shops. Our system allows users to search for specific dresses or browse the collections of nearby stores from the comfort of their homes, ensuring they only visit a store when they know their desired item is available.

By bridging the information gap between retailers and consumers, our solution streamlines the shopping experience, saves valuable time, and enhances decision-making for fashion-conscious buyers.

---

## Key Features

- **Real-Time Stock Visibility:** Browse the current inventory of local clothing stores in real-time.
- **Advanced Search & Filtering:** Search for dresses by name or shop, and filter results by style, size, color, and availability.
- **Location-Based Discovery:** Integrates with mapping services to help users find nearby shops that carry their desired items.
- **Detailed Product Information:** View comprehensive details for each dress, including photos, prices, sizes, and styles.
- **Shop Owner Dashboard:** A dedicated and secure portal for retailers to easily manage their inventory—add new arrivals, update stock counts, and remove sold-out items.

---

## System Architecture

The system is designed with a clear separation between the customer-facing interface, the shop owner's management portal, and a robust backend that handles all business logic and database interactions.

*You can add your architecture diagram image here. Upload the `Architecture.png` to your repo and use the following line:*
`![System Architecture](./path/to/your/Architecture.png)`

---

## Tech Stack

This project is built using the following technologies:

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Development Environment:** XAMPP / WAMP / LAMP Stack
- **API Testing:** Postman

---

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

You need to have a local server environment installed on your machine.
- [XAMPP](https://www.apachefriends.org/index.html) or any equivalent (WAMP, LAMP).

### Installation

1.  **Clone the repo**
    ```sh
    git clone [https://github.com/your-username/instant-dress-tracker.git](https://github.com/your-username/instant-dress-tracker.git)
    ```
2.  **Move to your server directory**
    - Move the cloned project folder to the `htdocs` directory of your XAMPP installation.
3.  **Set up the database**
    - Open `phpMyAdmin` from your XAMPP control panel.
    - Create a new database.
    - Import the provided `.sql` file to set up the necessary tables.
4.  **Configure the connection**
    - Update the database connection file (`db_config.php` or similar) with your database name, username, and password.
5.  **Run the application**
    - Start the Apache and MySQL modules from your XAMPP control panel.
    - Open your web browser and navigate to `http://localhost/instant-dress-tracker`.

---

## Usage

The platform has two main user roles:

1.  **For Customers:**
    - Visit the homepage to start searching.
    - Use the search bar to find a specific dress or shop.
    - Apply filters to narrow down the results.
    - Click on a dress to view its details and the shop's location.

2.  **For Shop Owners:**
    - Register for an account and log in to the dashboard.
    - Add new dresses to your inventory using the "Add New Stock" form.
    - Update details for existing items using the "Edit" button.
    - Remove items that are sold out using the "Delete" button.

---

## Project Scope

- **In Scope:** Real-time inventory tracking, search by item or store, automated stock updates, and a hybrid (browse-online, buy-offline) shopping experience.
- **Out of Scope:** The platform does not support online payments, order processing, or delivery/pickup services. User accounts for customers and AI-based recommendations are not included in the initial version.

---

---

## License

Distributed under the MIT License. See `LICENSE` for more information.

---
