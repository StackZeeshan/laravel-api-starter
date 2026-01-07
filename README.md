# Laravel API Starter

A simple RESTful API built with Laravel 12 featuring authentication and CRUD operations for task management.
This project was created as a **demo backend** to showcase my skills for hiring purposes. Suggested by ChatGPT as a proof of backend competency.

---

## Tech Stack

* **Framework:** Laravel 12
* **Authentication:** Laravel Sanctum (Token-based API Auth)
* **Database:** SQLite / MySQL (configured in `.env`)
* **API Style:** REST
* **Testing Tools:** Postman or any REST client

---

## Features

### 1. Authentication (Mandatory)

* **Register a new user**: `POST /api/register`
* **Login**: `POST /api/login`
* **Logout**: `POST /api/logout`
* **Get current user**: `GET /api/user`

**Rules & Notes:**

* Token-based authentication via Sanctum.
* Passwords are hashed securely.
* Validation via Form Requests.
* JSON responses only.
* Proper HTTP status codes:

  * `201 Created` for new resources
  * `401 Unauthorized`
  * `422 Validation Error`

---

### 2. Task Management (One Real Resource)

* **Endpoints:**

  * `GET /api/tasks` → List authenticated user's tasks
  * `POST /api/tasks` → Create a new task
  * `GET /api/tasks/{task}` → View a task
  * `PUT/PATCH /api/tasks/{task}` → Update a task
  * `DELETE /api/tasks/{task}` → Delete a task

**Rules & Notes:**

* Only authenticated users can access tasks.
* Users can only access their own tasks (policy enforced).
* Validation & errors handled via Form Requests.
* Proper HTTP codes for CRUD operations.

**Task Model Fields:**

* `id` (auto increment)
* `user_id` → FK to users table
* `title` → string, required
* `description` → text, optional
* `status` → enum (`pending`, `in_progress`, `completed`)
* `due_date` → date, optional
* `timestamps`

---

### 3. Validation & Error Handling

* **Form Requests:**

  * `RegisterRequest` → handles registration validation
  * `LoginRequest` → handles login validation
  * `TaskRequest` → handles task creation & update validation

* **Error Response Format:**

```json
{
  "message": "Validation failed",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

* HTTP status codes:

  * `401 Unauthorized` → invalid token or unauthenticated access
  * `403 Forbidden` → trying to access others’ tasks
  * `404 Not Found` → resource not found
  * `422 Unprocessable Entity` → validation errors

---

### 4. Database Setup

* Uses migrations for clean schema.

* Relationships defined:

  * **User hasMany Tasks**
  * **Task belongsTo User**

* Migrations included for:

  * Users table (default Laravel)
  * Tasks table with relationships and indexes

* Database connection configured in `.env` (SQLite by default).

---

### 5. Security Basics

* Sanctum middleware applied to all protected routes.
* Mass assignment protected (`$fillable`).
* Sensitive fields hidden in User model (`password`, `remember_token`).
* `.env` file excluded from git.

---

### 6. Optional Features (I'll add Later, If Time Allows)

* Pagination can be added (`?page=1`)
* Soft deletes can be enabled on tasks
* API rate limiting via Laravel throttling
* Task filtering via query params (e.g., `?status=completed`)

---

## Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/StackZeeshan/laravel-api-starter.git
cd laravel-api-starter
```

2. **Install dependencies**

```bash
composer install
```

3. **Copy `.env.example`**

```bash
cp .env.example .env
```

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Run migrations**

```bash
php artisan migrate
```

6. **Serve the application**

```bash
php artisan serve
```

7. **Test APIs using Postman** (collection included in repo)

---

## API Endpoints (Summary)

| Method    | Endpoint        | Description           |
| --------- | --------------- | --------------------- |
| POST      | /api/register   | Register new user     |
| POST      | /api/login      | Login                 |
| POST      | /api/logout     | Logout (token-based)  |
| GET       | /api/user       | Get current user info |
| GET       | /api/tasks      | List tasks for user   |
| POST      | /api/tasks      | Create new task       |
| GET       | /api/tasks/{id} | View task             |
| PUT/PATCH | /api/tasks/{id} | Update task           |
| DELETE    | /api/tasks/{id} | Delete task           |

---

## Testing Checklist

* [x] `/api/register` → validation, password hashing, JSON response
* [x] `/api/login` → returns access token
* [x] `/api/logout` → invalidates token
* [x] `/api/user` → returns authenticated user
* [x] Task CRUD → all endpoints work, policies enforced
* [x] Error handling → 401, 403, 404, 422 responses
* [x] Postman collection tested

---

## Deployment Notes

* Local: use `php artisan serve`
* Optional cloud deployment: Railway / Render
* `.env` must be configured in production
* SQLite works for quick demos, MySQL recommended for production

---

**Purpose:** This project is a **backend demo** to showcase **Laravel API skills** to potential employers. It’s intentionally simple, secure, and focused on core backend principles (auth, validation, CRUD).
