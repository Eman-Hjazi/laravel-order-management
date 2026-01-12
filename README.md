# Laravel Order Management (MVC → DDD Example)

![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red)
![PHP Version](https://img.shields.io/badge/PHP-8.x-blue)
![License](https://img.shields.io/badge/License-MIT-green)

A clean and professional **Order Management feature** in Laravel 12, following **clean code principles**, ready for future transformation to **Domain-Driven Design (DDD)**.

---

## 🌟 Purpose

This repository demonstrates a **step-by-step approach**:

1. **Stage 1 (Current) – MVC Implementation**:
   - Clean separation of business logic using **DTOs, Actions, Resources, and Events/Listeners**  
   - Fully functional **API endpoints** for Orders  
   - JSON responses formatted professionally  
   - Email notifications tested with **MailDev** or log-based mail  

2. **Stage 2 (Future) – DDD Transformation**:
   - Organize code by **Domain** (`Domains/Order`)  
   - Use **Entities, Repositories, Actions**  
   - Isolate business rules from framework/technical code  
   - Maintain consistent API responses  

---

## Project Structure (MVC)

```

app/
├── Actions/
│   └── CreateOrderAction.php
├── DTOs/
│   └── OrderData.php
├── Events/
│   └── OrderPlaced.php
├── Listeners/
│   └── SendOrderConfirmation.php
├── Http/
│   ├── Controllers/
│   │   └── OrderController.php
│   ├── Requests/
│   │   └── CreateOrderRequest.php
│   └── Resources/
│       └── OrderResource.php
├── Models/
│   ├── Order.php
│   └── Product.php
database/
├── migrations/
├── seeders/
└── factories/
routes/
└── api.php

````

---

## 🔹 Features

- **Create Order** via API (POST `/api/orders`)  
- **List Orders** (GET `/api/orders`)  
- **Show Single Order** (GET `/api/orders/{id}`)  
- **Delete Order** (DELETE `/api/orders/{id}`)  
- Business logic separated using **DTOs and Actions**  
- Sends order confirmation emails via **Events/Listeners**  
- API responses follow a professional structure:
```json
{
  "success": true,
  "code": 201,
  "message": "Order created successfully",
  "data": { ... }
}
````

* Email notifications are tested using **MailDev** for development.

---

## 💻 Next Steps (DDD)

* Reorganize code under `Domains/Order`
* Isolate **Entities, Repositories, Actions**
* Keep API consistent
* Fully separate business rules from framework/technical code

---

## 📝 Commit MVC

```
git add .
git commit -m "Initial MVC implementation for Order Management feature: clean code, DTOs, Actions, Resources, Events/Listeners"
git push origin main
```

> This commit represents the **fully working MVC version** before any DDD transformation.



