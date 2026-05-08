# Gradient Builder

A Laravel web application that allows users to create and manage CSS gradients.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

## Setup

1. **Clone the repository**
    ```bash
    git clone <https://github.com/aadilpopat/base8-gradient-builder.git>
    ```

2. **Install PHP dependencies**
    ```bash
    composer install
    ```

3. **Install Node dependencies**
    ```bash
    npm install
    ```

4. **Environment setup**

    Copy the example env file and update it with your database credentials:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Update these values in your `.env` file:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gradient_builder
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Create the database**

    Create a MySQL database named `gradient_builder` using your preferred database tool.

6. **Run migrations**
    ```bash
    php artisan migrate
    ```

7. **Build frontend assets**
    ```bash
    npm run dev
    ```

8. **Serve the application**
    ```bash
    php artisan serve
    ```

    Visit `http://localhost:8000` in your browser.

## Features

- User registration and authentication via Laravel Breeze
- Create gradients with a live preview
- Supports linear and radial gradient types
- Angle control for linear gradients
- Dashboard listing all saved gradients with visual previews
- Edit and delete existing gradients
- Ownership protection — users can only access their own gradients

## Assumptions & Decisions

- **SQLite vs MySQL** — The project uses MySQL as it better reflects a real production environment.
- **Two colour stops** — Gradients are stored with two colour values (`color_1`, `color_2`) directly on the gradients table. A separate `gradient_stops` table would be more flexible and would be the first refactor with more time.
- **Laravel Breeze** — Used for authentication scaffolding as it is the standard recommended approach and keeps the auth code clean and maintainable.
- **Manual authorisation** — Rather than using Laravel Policies, ownership checks are handled directly in the controller with a simple `user_id` comparison. This is explicit, readable, and easy to reason about for a project of this scope.
- **Vanilla JS** — The live gradient preview uses no JavaScript libraries. The functionality is straightforward enough that a framework would add unnecessary complexity.

## What I'd Improve With More Time

- **Multiple colour stops** — Refactor to a separate `gradient_stops` table allowing users to add as many colours as they want, with draggable position control
- **Improved UI** — Polish the design further, add animations, and improve the mobile experience
- **CSS copy button** — Allow users to copy the generated CSS string directly from their dashboard
- **Validation error messages** — Display inline form errors when validation fails
- **Gradient sharing** — Allow users to optionally make gradients public and shareable via a unique URL

## AI Usage

Claude (claude.ai) was used as a guided assistant throughout this project. As someone coming from a WordPress background with minimal Laravel experience, I used it to understand Laravel concepts (routing, controllers, models, migrations, blade templating) and to help structure the application correctly.

All code was reviewed and understood before being added to the project. The AI guided the approach and explained the reasoning behind each decision rather than simply generating the solution. I am able to explain every part of the codebase.
