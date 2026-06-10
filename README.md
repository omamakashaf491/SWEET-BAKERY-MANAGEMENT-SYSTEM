# 🎂 Online Custom Cake Ordering & Management System

## Overview

The Online Custom Cake Ordering & Management System is a database-driven application designed to streamline bakery operations and provide customers with a convenient platform for ordering customized cakes online.

The system manages customers, cakes, categories, orders, payments, deliveries, reviews, and customization requests through a structured relational database.

---

## Features

### User Management

* User Registration
* User Login
* Profile Management

### Cake Management

* Browse Cake Categories
* View Available Cakes
* View Cake Details

### Order Management

* Place Orders
* Track Order History
* Store Order Information

### Customization Management

* Add Custom Messages
* Select Theme Colors
* Provide Special Instructions

### Payment Management

* Record Payment Methods
* Track Payment Status

### Delivery Management

* Manage Delivery Information
* Track Delivery Status

### Review Management

* Submit Ratings
* Write Customer Reviews

---

## Database Design

The system is built using a relational database and follows Third Normal Form (3NF) to minimize redundancy and maintain data consistency.

### Main Entities

* User
* Category
* Cake
* Order
* OrderDetail
* Customization
* Payment
* Delivery
* Review

### Relationships

* One User can place multiple Orders.
* One Category can contain multiple Cakes.
* One Order can contain multiple Order Details.
* One Cake can appear in multiple Order Details.
* One Order has one Payment record.
* One Order has one Delivery record.
* One User can write multiple Reviews.
* One Cake can receive multiple Reviews.
* One Order Detail can have one Customization.

---

## Technologies Used

* MySQL
* SQL (DDL & DML)
* ER Modeling
* Relational Database Design

---

## Project Objectives

* Improve bakery order management.
* Reduce data redundancy.
* Ensure data integrity and consistency.
* Simplify customer order processing.
* Demonstrate practical implementation of database concepts.

---

## Future Enhancements

* Online Payment Gateway Integration
* Real-Time Order Tracking
* Mobile Application Support
* Email & SMS Notifications
* Discount & Coupon Management
* Inventory Management
* Admin Analytics Dashboard
* AI-Based Cake Recommendations

---

## Team Members

* Bushra Batool (250901006)
* Misbah Tariq (250901047)
* Kashaf Azmat (250901009)

---


