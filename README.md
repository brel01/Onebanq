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
- `/api/v1/register`: User Registration
  - **Type:** `POST`
  - **Endpoint:** `/api/v1/register`

#### Parameters

| Parameter  | Type     | Description           |
|------------|----------|-----------------------|
| `name`     | String   | User's full name.     |
| `email`    | String   | User's email address. |
| `phone`    | String   | User's phone number.  |
| `password` | String   | User's password.      |

#### Response

```json
{
  "status": "success",
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Obi Sola",
      "email": "obisola@example.com",
      "phone": "090838298949",
      "created_at": "2023-01-01T12:00:00Z",
      "updated_at": "2023-01-01T12:00:00Z"
    },
    "access_token": "your_access_token"
  }
}
```



- `/api/v1/login`: User login
  - **Type:** `POST`
  - **Endpoint:** `/api/v1/register`

#### Parameters

| Parameter  | Type     | Description           |
|------------|----------|-----------------------|
| `email`    | String   | User's email address. |
| `password` | String   | User's password.      |

#### Response

```json
{
  "status": "success",
  "message": "User logged in successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Obi Sola",
      "email": "obisola@example.com",
      "created_at": "2023-01-01T12:00:00Z",
      "updated_at": "2023-01-01T12:00:00Z"
    },
    "access_token": "your_access_token"
  }
}

```

- `/api/v1/payment`: Payment initiation
 - **Type:** `POST`  
  - **Authentication:** Requires a valid JWT token in the request headers.
### Headers
|      Header     |      Value        |   Description          |
|-----------------|-------------------|------------------------|
| `Authorization` | Bearer {JWT Token}| User's access token.   |

#### Parameters

| Parameter  | Type     | Description           |
|------------|----------|-----------------------|
| `amount`   | Number   | Payment amount.       |


```json
{
  "status": "success",
  "message": "Payment initiated successfully",
  "data": {
    "transaction_id": 123,
    "amount": 2000,
    "status": "initiated",
    "created_at": "2023-01-01T12:00:00Z"
  }
}

```


- `/api/v1/transaction-history`: Fetch transaction history
  - **Type:** `POST`  
  - **Authentication:** Requires a valid JWT token in the request headers.

#### Parameters

| Parameter | Type   | Description                       |
|-----------|--------|-----------------------------------|
| None      |        | No additional parameters required for this endpoint. |

#### Request Headers

| Header          | Value                | Description                      |
|-----------------|----------------------|----------------------------------|
| Authorization   | Bearer {JWT Token}   | Required for user authentication.|

#### Response

```json
{
  "transactions": [
    {
      "id": 1,
      "user_id": 1,
      "amount": 2000,
      "status": "completed",
      "created_at": "2023-01-01T12:00:00Z",
      "updated_at": "2023-01-01T12:00:00Z"
    },
    // Additional transactions...
  ]
}
```

- `/api/v1/logout`: User logout
  - **Type:** `POST`  
  - **Authentication:** Requires a valid JWT token in the request headers.

#### Parameters

| Parameter | Type   | Description                       |
|-----------|--------|-----------------------------------|
| None      |        | No additional parameters required for this endpoint. |

#### Request Headers

| Header          | Value                | Description                      |
|-----------------|----------------------|----------------------------------|
| Authorization   | Bearer {JWT Token}   | Required for user authentication.|

#### Response

```json
{
  "message": "Successfully logged out",
}
```


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


