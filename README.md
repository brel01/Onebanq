--- 1. Introduction

--- Overview
This project serves as a comprehensive example of a Laravel-based API with user authentication, payment integration using the Flutterwave SDK, and transaction history tracking.

--- Technologies Used
- Laravel
- Flutterwave SDK

--- 2. Prerequisites

--- Software and Tools
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/)
- [Flutterwave SDK](https://github.com/flutterwavedev/flutterwave-v3)

--- 3. Installation

--- Steps
1. Clone the repository: `git clone <repository-url>`
2. Install dependencies: `composer install`
3. Copy the environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Configure the database settings in `.env`
6. Migrate the database: `php artisan migrate`
7. Install Flutterwave SDK: `composer require flutterwavedev/flutterwave-v3`

--- 4. Configuration

--- Environment Variables
- Set Flutterwave API key in `.env`: `FLUTTERWAVE_SECRET_KEY=your-secret-key`

--- 5. Database Setup

--- Migration
Run the migration to create necessary tables: `php artisan migrate`

--- 6. User Authentication

--- Routes
- Register: `POST /api/v1/register`
- Login: `POST /api/v1/login`
- Logout: `POST /api/v1/logout`

--- Middleware
- The project uses Laravel's default authentication middleware for user authentication.

--- 7. Payment Integration

--- Flutterwave Integration
- Utilizes the Flutterwave SDK for payment processing.
- Set up the Flutterwave API key in the configuration.

--- 8. Transaction History

--- Model
- `Transaction` model to store transaction details.

--- API Endpoint
- `GET /api/v1/transaction-history`

--- 9. API Routes

--- Overview
- `/api/v1/register`: User registration
- `/api/v1/login`: User login
- `/api/v1/payment`: Payment initiation
- `/api/v1/transaction-history`: Fetch transaction history
- `/api/v1/logout`: User logout

--- 10. Middleware

--- `AuthenticateWithJWT`
- Custom middleware to authenticate users using JWT.
- Adds the authenticated user to the request.

--- 11. Controllers

--- Purpose
- `UserController`: Handles user registration.
- `AuthController`: Manages user authentication and logout.
- `PaymentController`: Initiates payments and redirects to Flutterwave.
- `TransactionController`: Retrieves transaction history.

--- 12. Models

--- Data Models
- `User`: Represents user details.
- `Transaction`: Stores transaction details.


