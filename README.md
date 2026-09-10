# 👥 Employee Management System (EMS)

A role-based **Employee Management System** built with **Laravel 12**, **PHP 8.2+**, **MySQL**, **Laravel Sanctum**, **Blade**, **Tailwind CSS**, **Vite**, and **jQuery**.

EMS provides a web interface and REST APIs for managing employees, users, roles, and departments. Authentication is token-based, while protected API resources are controlled through a custom role-checking middleware.

## ✨ Features

### 🔐 Authentication
- User registration
- User login
- Laravel Sanctum bearer-token authentication
- Logout with token revocation
- Authentication-protected APIs
- Role-aware access control
- Users without an assigned employee record can be identified

### 👨‍💼 Employee Management
- Create employee records
- View employee list
- View individual employee profiles
- Update employee information
- Delete employees
- Employee pagination
- Department assignment
- User-account assignment
- Gender and contact information
- Profile image upload/update
- Automatic cleanup of replaced/deleted profile images
- Validation through Laravel Form Requests

### 🏢 Department Management
- Create departments
- List departments
- View department details with employees
- Update departments
- Delete departments
- Unique department names

### 🛡️ Role & User Management
- Create roles
- List roles
- View roles
- Update roles
- Delete roles
- Assign roles to users
- Update user roles
- User listing with pagination
- Find users who are not linked to an employee
- User deletion and management

### 🖥️ Web Interface
The project includes Blade-based pages for:

- Employees
- Employee profile
- Add employee
- Departments
- Add department
- Users
- Add user
- Roles
- Add role

The frontend uses **jQuery/AJAX** to communicate with the Laravel APIs and stores the Sanctum token in browser `localStorage` for authenticated requests.

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| **PHP 8.2+** | Backend language |
| **Laravel 12** | Web framework & REST API |
| **MySQL** | Relational database |
| **Laravel Sanctum 4** | API authentication |
| **Blade** | Server-rendered views |
| **Tailwind CSS 4** | UI styling |
| **jQuery** | AJAX/API communication |
| **Vite 7** | Frontend asset bundling |
| **Axios** | HTTP client dependency |
| **Composer** | PHP dependency management |
| **Pest** | Testing |
| **Laravel Pint** | Code formatting |

The dependency configuration currently requires PHP `^8.2`, Laravel `^12.0`, and Laravel Sanctum `^4.0`. citeturn58file0

## 🏗️ Architecture

```text
                         Browser
                            │
                            ▼
                  Blade + Tailwind UI
                            │
                       jQuery / AJAX
                            │
                            ▼
                  ┌──────────────────┐
                  │  Laravel REST API│
                  └────────┬─────────┘
                           │
              ┌────────────┼────────────┐
              ▼            ▼            ▼
        Sanctum Auth   RoleCheck     Controllers
              │            │            │
              └────────────┼────────────┘
                           ▼
                    Eloquent Models
                           │
                           ▼
                         MySQL
```

## 📁 Project Structure

```text
ems/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── API/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── DepartmentController.php
│   │   │   │   ├── EmployeeController.php
│   │   │   │   ├── RoleController.php
│   │   │   │   └── UserController.php
│   │   │   └── Controller.php
│   │   ├── Middleware/
│   │   │   └── RoleCheck.php
│   │   └── Requests/
│   │       ├── EmployeeRequest.php
│   │       └── UserRequest.php
│   ├── Models/
│   │   ├── Department.php
│   │   ├── Employee.php
│   │   ├── Role.php
│   │   └── User.php
│   └── Providers/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── layouts/
│       ├── add-department.blade.php
│       ├── add-employee.blade.php
│       ├── add-role.blade.php
│       ├── add-user.blade.php
│       ├── departments.blade.php
│       ├── employee-profile.blade.php
│       ├── employees.blade.php
│       ├── roles.blade.php
│       └── users.blade.php
│
├── routes/
│   ├── api.php
│   ├── console.php
│   └── web.php
│
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

## 🗄️ Database Design

The application uses four core business areas: users, roles, employees, and departments.

```text
                   ┌──────────────┐
                   │     Role     │
                   └──────┬───────┘
                          │
                    many-to-many
                          │
                          ▼
┌──────────────┐     ┌──────────────┐
│    User      │────►│  user_roles  │
└──────┬───────┘     └──────────────┘
       │
     1 : 1
       │
       ▼
┌──────────────┐       belongs to       ┌──────────────┐
│   Employee   │────────────────────────►│ Department   │
└──────────────┘                         └──────────────┘
```

### Relationships

- A **User** can have multiple Roles.
- A **Role** can belong to multiple Users.
- A **User** can have one Employee record.
- An **Employee** belongs to one User.
- An **Employee** belongs to a Department.
- A **Department** can contain multiple Employees.

The model layer implements these relationships using Eloquent `belongsTo`, `hasOne`, `hasMany`, and `belongsToMany` relationships. citeturn46file0turn64file0turn65file0

## 🔐 Authentication & Authorization

EMS uses Laravel Sanctum for API authentication.

```text
User Login
    │
    ▼
Validate email + password
    │
    ▼
Check assigned role
    │
    ▼
Create Sanctum bearer token
    │
    ▼
Client stores token
    │
    ▼
Authorization: Bearer <token>
    │
    ▼
Protected API
```

During login, the API verifies credentials and also checks that the user has at least one assigned role before issuing a Sanctum token. citeturn28file0

Protected API routes use:

```text
auth:sanctum
role:admin,employee
```

The custom `RoleCheck` middleware verifies the authenticated user's roles and returns `401` for unauthenticated requests or `403` when the user does not have an allowed role. citeturn27file0

## 🔄 Employee Management Flow

```text
Admin / Authorized User
          │
          ▼
     Create Employee
          │
          ├── Personal Information
          ├── Department
          ├── User Account
          └── Profile Image
          │
          ▼
     Employee Record
          │
     ┌────┼────┐
     ▼    ▼    ▼
   View Update Delete
```

Employee creation uses `EmployeeRequest` validation for required fields, user/department existence, unique employee-user association, and optional image validation. citeturn42file0

The employee API also eager-loads the related user and department and paginates employee listings. citeturn47file0

## 🖼️ Profile Image Handling

Employee profile images are uploaded to Laravel's public filesystem.

```text
Upload Image
     │
     ▼
Laravel Storage
     │
     ▼
public/storage/image/...
     │
     ▼
Employee.profile_image
```

When an employee profile image is replaced or the employee is deleted, the existing image file is removed by the controller. citeturn47file0

## 🔌 REST API

Base URL for local development:

```text
http://127.0.0.1:8000/api
```

### Authentication

| Method | Endpoint | Description | Auth |
|---|---|---|---|
| POST | `/register-user` | Register user and assign role | Public |
| POST | `/login` | Authenticate user and issue Sanctum token | Public |
| POST | `/logout` | Revoke authenticated user's tokens | Protected |

### Users

| Method | Endpoint | Description |
|---|---|---|
| GET | `/users` | List users with pagination |
| GET | `/users/no-emp` | Get users without an employee record |
| GET | `/users/{id}` | Get user details and roles |
| PUT | `/users/{id}` | Update user and role assignment |
| DELETE | `/users/{id}` | Delete user |

### Employees

`/employees` is exposed through Laravel `apiResource`, providing the standard resource operations:

| Method | Endpoint | Description |
|---|---|---|
| GET | `/employees` | List employees |
| POST | `/employees` | Create employee |
| GET | `/employees/{id}` | Get employee profile |
| PUT/PATCH | `/employees/{id}` | Update employee |
| DELETE | `/employees/{id}` | Delete employee |

### Roles

`/roles` is exposed through Laravel `apiResource`:

| Method | Endpoint | Description |
|---|---|---|
| GET | `/roles` | List roles |
| POST | `/roles` | Create role |
| GET | `/roles/{id}` | Get role |
| PUT/PATCH | `/roles/{id}` | Update role |
| DELETE | `/roles/{id}` | Delete role |

### Departments

`/departments` is exposed through Laravel `apiResource`:

| Method | Endpoint | Description |
|---|---|---|
| GET | `/departments` | List departments with employees |
| POST | `/departments` | Create department |
| GET | `/departments/{id}` | Get department with employees |
| PUT/PATCH | `/departments/{id}` | Update department |
| DELETE | `/departments/{id}` | Delete department |

The current API route definitions group users, employees, roles, departments, and logout behind Sanctum authentication and the `admin,employee` role middleware. citeturn67file0

## 🖥️ Web Routes

The application also exposes Blade pages for the management UI:

| Route | Page |
|---|---|
| `/` | Welcome |
| `/employees` | Employee list |
| `/employees/add-employee` | Add employee |
| `/employees/{user}` | Employee profile |
| `/departments` | Department list |
| `/departments/add-department` | Add department |
| `/users` | User list |
| `/users/add-user` | Add user |
| `/roles` | Role list |
| `/roles/add-role` | Add role |

These routes are defined in `routes/web.php`. citeturn40file0

## 🎨 Frontend

The frontend is server-rendered using Blade and styled with Tailwind CSS 4. Vite is used for asset compilation, while JavaScript modules use jQuery/AJAX to communicate with the API. citeturn24file0turn54file0

The employee management UI includes employee tables, pagination, update modals, department/user selectors, profile image uploads, and an employee profile page. citeturn30file0turn51file0

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/Vivek987099/ems.git
cd ems
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Configure environment

```bash
cp .env.example .env
```

On Windows:

```powershell
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 5. Configure MySQL

Create a database named `ems` or use your preferred database name, then configure `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ems
DB_USERNAME=root
DB_PASSWORD=
```

The repository's `.env.example` is already configured with MySQL defaults and `ems` as the database name. citeturn29file0

### 6. Run migrations

```bash
php artisan migrate
```

Optional seed command:

```bash
php artisan db:seed
```

### 7. Create storage symlink

Required for serving uploaded employee profile images:

```bash
php artisan storage:link
```

### 8. Start the application

```bash
php artisan serve
```

For frontend asset development:

```bash
npm run dev
```

Or run the repository's complete development workflow:

```bash
composer run dev
```

The configured Composer development script starts Laravel, the queue listener, and Vite concurrently. citeturn58file0

## 🧪 Testing

Run the Laravel test suite:

```bash
php artisan test
```

or:

```bash
composer run test
```

The project is configured with Pest and Laravel's testing infrastructure. citeturn58file0

## 🧹 Code Formatting

Laravel Pint is included in the development dependencies:

```bash
./vendor/bin/pint
```

## 🔒 Security Notes

- Never commit the real `.env` file.
- Never expose production secrets in the repository.
- Use HTTPS in production.
- Protect administrative endpoints with appropriate roles.
- Keep Sanctum tokens private.
- Use strong database credentials in production.
- Set `APP_DEBUG=false` in production.

## 📌 API Request Example

Authenticated requests should include:

```http
Authorization: Bearer YOUR_SANCTUM_TOKEN
Accept: application/json
```

Example login request:

```http
POST /api/login
Content-Type: application/json
Accept: application/json

{
  "email": "user@example.com",
  "password": "your-password"
}
```

Successful authentication returns a bearer token that can be used for protected endpoints. citeturn28file0

## 🚧 Future Improvements

- API documentation with OpenAPI/Swagger
- Automated feature and API tests
- Centralized API response formatting
- More granular permissions beyond role-level access
- Search and filtering for employees
- Dashboard analytics
- Activity/audit logs
- Docker configuration
- CI/CD pipeline
- Production deployment documentation

## 🎯 Project Highlights

This project demonstrates hands-on experience with:

- Laravel REST API development
- MVC architecture
- Laravel Sanctum authentication
- Role-based authorization middleware
- CRUD operations
- Eloquent ORM relationships
- Many-to-many role assignment
- Form Request validation
- Pagination
- File uploads and storage management
- Blade templates
- Tailwind CSS
- jQuery/AJAX API integration
- MySQL relational database design
- Vite asset management

## 👨‍💻 Author

**Vivek Arya**

GitHub: [@Vivek987099](https://github.com/Vivek987099)

## 📄 License

This project is open-sourced under the **MIT License**.
