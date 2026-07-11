# Alfawzan Driving School Portal

Hey there! This project is an online portal designed to simplify operations for driving schools. It handles everything from signing up new students and processing various types of payments to securely managing and distributing important documents. Think of it as a central hub that makes running a driving school much more efficient and user-friendly for both staff and students.

## Usage

This portal offers different experiences depending on who you are. Here’s a quick guide to how you and your users can interact with it through the web interface:

### For Students (General Users)

- **Registration**: New students can easily sign up for driving school programs through a dedicated registration form.
- **Payments**: Students can make payments online using Paystack or apply pre-generated payment reference IDs. You'll find a clear overview of your payment history.
- **Documents**: Access and download important documents, like training materials or certificates, uploaded by the administration.
- **Receipts**: Automatically generated PDF receipts are available for every successful payment, ready to view or download.
- **Profile Management**: Update your personal information, including email, phone, address, and password.

### For Agents

- **Dashboard Overview**: Agents get a personalized dashboard showing their total revenue generated and the number of active links they manage.
- **Link Management**: View all agent referral links assigned to you, check their status (active/inactive), and see how many payments have been made through each.
- **Copy Links**: Easily copy your unique referral links to share with potential students.

### For Administrators

- **Comprehensive Dashboard**: Get a bird's-eye view of the entire system with statistics on total users, revenue, pending payments, and documents.
- **User Management**: Oversee all registered users, including students and agents. You can view, update, and manage their accounts.
- **Payment Management**: Access a full history of all payments, view detailed transaction information, and filter by status.
- **Payment Reference Management**: Generate and manage unique payment reference IDs that students can use for offline or special payments. You can assign these to specific users or keep them general.
- **Agent Link Management**: Create, edit, and delete agent referral links. Assign them to specific agents and monitor their performance.
- **Document Management**: Upload, update, and manage PDF documents and other files that students can download.
- **School Settings**: Update core school information like names, taglines, contact details, social media links, and even upload a school logo or digital signature for receipts.

## Features

This portal comes packed with features to make managing a driving school a breeze:

- **Multi-User Role System**: Distinct dashboards and access levels for Students, Agents, and Administrators to ensure secure and tailored experiences.
- **Flexible Student Registration**: A user-friendly form for students to enroll, capturing essential personal and driving license information.
- **Integrated Payment Gateway**: Seamless online payment processing via Paystack, making it easy for students to pay for courses.
- **Payment Reference IDs**: Admins can generate unique reference IDs for students to use for payments, offering an alternative to direct online transactions.
- **Automated PDF Receipt Generation**: Every successful payment automatically triggers the creation of a professional, digitally signed PDF receipt for students to download.
- **Centralized Document Repository**: Upload and manage important documents (like handbooks, forms, or certificates) that can be easily accessed and downloaded by students.
- **Agent Referral System**: Allow agents to generate and track unique referral links, promoting courses and enabling performance monitoring.
- **Comprehensive Admin Dashboard**: Visual analytics and detailed reports on users, payments, and system activity to provide full operational oversight.
- **Secure User Authentication**: Robust login, registration, and password reset functionalities to keep user data safe.
- **Customizable School Settings**: Easily update school information, branding (logo), and contact details through an admin panel.

## Technologies Used

This project is built on a solid foundation of modern web technologies:

| Technology             | Description                                     | Version | Badge                                                                                                     |
| :--------------------- | :---------------------------------------------- | :------ | :-------------------------------------------------------------------------------------------------------- |
| **PHP**                | Server-side scripting language                  | ^8.1    | ![PHP](https://img.shields.io/badge/PHP-8.1+-%23777BB4?style=flat-square&logo=php)                        |
| **Laravel**            | The PHP Framework for Web Artisans              | ^10.10  | ![Laravel](https://img.shields.io/badge/Laravel-10.x-%23FF2D20?style=flat-square&logo=laravel)            |
| **Laravel Sanctum**    | API Authentication                              | ^3.2    | ![Sanctum](https://img.shields.io/badge/Sanctum-3.x-red?style=flat-square)                                |
| **Paystack**           | Online Payment Gateway (via Guzzle HTTP Client) | ^7.2    | ![Paystack](https://img.shields.io/badge/Paystack-00C3F8?style=flat-square&logo=paystack&logoColor=white) |
| **DOMPDF**             | PDF Generation                                  | ^2.0    | ![DOMPDF](https://img.shields.io/badge/DomPDF-2.x-lightgrey?style=flat-square)                            |
| **Intervention Image** | Image Handling Library                          | ^2.7    | ![Intervention Image](https://img.shields.io/badge/Intervention%20Image-2.x-orange?style=flat-square)     |
| **Bootstrap**          | Frontend Framework                              | 5.3     | ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-%237952B3?style=flat-square&logo=bootstrap)       |
| **Chart.js**           | JavaScript Charting Library                     | 4.4     | ![Chart.js](https://img.shields.io/badge/Chart.js-4.x-%23FF6384?style=flat-square&logo=chartdotjs)        |
| **Tabler Icons**       | SVG Icon Set                                    | Latest  | ![Tabler Icons](https://img.shields.io/badge/Tabler%20Icons-latest-blue?style=flat-square)                |
| **Composer**           | PHP Dependency Manager                          | ^2.x    | ![Composer](https://img.shields.io/badge/Composer-2.x-%23885630?style=flat-square&logo=composer)          |
| **NPM**                | JavaScript Package Manager                      | ^9.x    | ![npm](https://img.shields.io/badge/npm-9.x-%23CB3837?style=flat-square&logo=npm)                         |

---

## API Documentation

### Base URL

```
http://localhost:8000/api
```

### Authentication

Most endpoints require authentication via **Laravel Sanctum**. Include the token in the `Authorization` header:

```
Authorization: Bearer {token}
```

### Response Format

All responses follow a consistent JSON structure:

**Success Response:**

```json
{
  "data": {...},
  "message": "Success message (optional)",
  "meta": {...} // For paginated responses
}
```

**Error Response:**

```json
{
  "message": "Error message",
  "errors": {...} // Validation errors (if any)
}
```

---

## PUBLIC ENDPOINTS

### 1. User Login

**Endpoint:** `POST /auth/login`

**Description:** Authenticate a user and obtain an API token

**Request Body:**

```json
{
  "email": "user@example.com",
  "password": "password",
  "remember": false
}
```

**Success Response (200):**

```json
{
  "token": "api-token-string",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com",
    "role": "user",
    "phone": "08012345678"
  }
}
```

**Error Response (401):**

```json
{
  "message": "Invalid credentials."
}
```

---

### 2. Forgot Password

**Endpoint:** `POST /auth/forgot-password`

**Description:** Request a password reset link via email

**Request Body:**

```json
{
  "email": "user@example.com"
}
```

**Success Response (200):**

```json
{
  "message": "Password reset link sent."
}
```

**Error Response (422):**

```json
{
  "message": "Unable to send reset link."
}
```

---

### 3. Get Public Settings

**Endpoint:** `GET /public/settings`

**Description:** Fetch public school settings (no authentication required)

**Query Parameters:** None

**Success Response (200):**

```json
{
  "data": {
    "school_name": "Alfawzan Driving School",
    "logo_url": "https://example.com/logo.png",
    "tagline": "Professional Driving Training",
    "address": "123 Main Street",
    "phone": "08012345678",
    "phone2": "08087654321",
    "phone3": null,
    "email": "info@alfawzan.com",
    "website": "https://alfawzan.com",
    "facebook_url": "https://facebook.com/alfawzan",
    "instagram_url": "https://instagram.com/alfawzan",
    "twitter_url": "https://twitter.com/alfawzan",
    "seo_title": "Alfawzan Driving School",
    "seo_description": "Best driving school in the region"
  }
}
```

---

### 4. Driving School Registration

**Endpoint:** `POST /driving-school/register`

**Description:** Register a new student for driving school (public endpoint)

**Request Body:**

```json
{
  "first_name": "John",
  "surname": "Doe",
  "othername": "Michael",
  "mothers_maiden_name": "Smith",
  "email": "john@example.com",
  "phone": "08012345678",
  "date_of_birth": "1990-01-15",
  "address": "123 Main Street",
  "license_type": "Private",
  "gender": "Male",
  "blood_group": "O+",
  "facial_mark": false,
  "height": "5'10",
  "next_of_kin_phone": "08087654321",
  "state_of_origin": "Lagos",
  "local_govt": "Ikoyi",
  "nin_number": "12345678901",
  "marital_status": "Single",
  "requires_glasses": false,
  "has_disability": false,
  "disability_details": null,
  "additional_info": "None"
}
```

**Success Response (201):**

```json
{
  "message": "Registration submitted successfully.",
  "data": {
    "id": 1,
    "first_name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "status": "pending",
    "created_at": "2026-06-13T10:00:00.000000Z"
  }
}
```

**Error Response (422):**

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."],
    "phone": ["The phone field is required."]
  }
}
```

---

### 5. Get Student Registration Details

**Endpoint:** `GET /driving-school/register/{id}`

**Description:** Fetch details of a student registration

**Parameters:**

- `id` (required): Student registration ID

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "first_name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "phone": "08012345678",
    "status": "pending",
    "passport_url": "https://example.com/passports/photo.jpg",
    "created_at": "2026-06-13T10:00:00.000000Z"
  }
}
```

**Error Response (404):**

```json
{
  "message": "Not found."
}
```

---

## AUTHENTICATED ENDPOINTS (ALL USERS)

### 6. Get Current User

**Endpoint:** `GET /auth/user`

**Authentication:** Required (Bearer Token)

**Description:** Fetch the currently authenticated user's details

**Request Body:** None

**Success Response (200):**

```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "role": "user",
  "phone": "08012345678",
  "address": "123 Main Street"
}
```

---

### 7. Logout

**Endpoint:** `POST /auth/logout`

**Authentication:** Required (Bearer Token)

**Description:** Logout the current user and revoke the token

**Request Body:** None

**Success Response (200):**

```json
{
  "message": "Logged out successfully."
}
```

---

## USER ENDPOINTS (Students)

### 8. Get User Dashboard

**Endpoint:** `GET /user/dashboard`

**Authentication:** Required (Bearer Token)

**Description:** Fetch user dashboard with statistics and recent activities

**Success Response (200):**

```json
{
  "stats": {
    "total_payments": 5,
    "total_spent": 50000,
    "total_receipts": 5
  },
  "recent_payments": [
    {
      "id": 1,
      "payment_reference": "PAY-ABCD1234EFGH",
      "amount": 10000,
      "status": "paid",
      "payment_method": "online",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ],
  "recent_receipts": [
    {
      "id": 1,
      "receipt_number": "RCP-001",
      "amount": 10000,
      "generated_at": "2026-06-13T10:30:00.000000Z"
    }
  ]
}
```

---

### 9. Get User Payments

**Endpoint:** `GET /user/payments`

**Authentication:** Required (Bearer Token)

**Query Parameters:**

- `page` (optional): Page number for pagination (default: 1)

**Description:** Fetch paginated list of user's payments

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "payment_reference": "PAY-ABCD1234EFGH",
      "amount": 10000,
      "status": "paid",
      "payment_method": "online",
      "description": "Course Fee",
      "created_at": "2026-06-13T10:00:00.000000Z",
      "receipt": {
        "id": 1,
        "receipt_number": "RCP-001"
      }
    }
  ],
  "meta": {
    "total": 5,
    "per_page": 20,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 10. Create Payment

**Endpoint:** `POST /user/payments`

**Authentication:** Required (Bearer Token)

**Description:** Initiate a new payment (online via Paystack or using a payment reference)

**Request Body:**

```json
{
  "amount": 10000,
  "description": "Course Fee",
  "payment_method": "online",
  "reference_id": null,
  "callback_url": "https://example.com/callback"
}
```

**For Reference-based Payment:**

```json
{
  "amount": 10000,
  "description": "Course Fee",
  "payment_method": "reference",
  "reference_id": "REF-ABCD1234",
  "callback_url": null
}
```

**Success Response (200) - Online Payment:**

```json
{
  "type": "online",
  "authorization_url": "https://checkout.paystack.com/...",
  "payment_reference": "PAY-ABCD1234EFGH"
}
```

**Success Response (200) - Reference Payment:**

```json
{
  "type": "reference",
  "payment": {
    "id": 1,
    "payment_reference": "PAY-ABCD1234EFGH",
    "amount": 10000,
    "status": "paid",
    "payment_method": "reference",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "receipt": {
      "id": 1,
      "receipt_number": "RCP-001"
    }
  }
}
```

**Error Response (422):**

```json
{
  "message": "Amount does not match the reference ID amount."
}
```

---

### 11. Verify Payment

**Endpoint:** `GET /user/payments/verify`

**Authentication:** Required (Bearer Token)

**Query Parameters:**

- `reference` (required): Payment reference ID

**Description:** Verify a payment status with Paystack

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "payment_reference": "PAY-ABCD1234EFGH",
    "amount": 10000,
    "status": "paid",
    "payment_method": "online",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "receipt": {
      "id": 1,
      "receipt_number": "RCP-001"
    }
  }
}
```

**Error Response (404):**

```json
{
  "message": "Payment not found."
}
```

---

### 12. Get Payment Details

**Endpoint:** `GET /user/payments/{id}`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Payment ID

**Description:** Fetch details of a specific payment

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "payment_reference": "PAY-ABCD1234EFGH",
    "amount": 10000,
    "status": "paid",
    "payment_method": "online",
    "description": "Course Fee",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "receipt": {
      "id": 1,
      "receipt_number": "RCP-001"
    }
  }
}
```

---

### 13. Get Documents

**Endpoint:** `GET /user/documents`

**Authentication:** Required (Bearer Token)

**Query Parameters:**

- `page` (optional): Page number for pagination

**Description:** Fetch paginated list of available documents

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "title": "Student Handbook",
      "description": "Complete guide for students",
      "file_name": "handbook.pdf",
      "file_size": 2048000,
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ],
  "meta": {
    "total": 5,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 14. Download Document

**Endpoint:** `GET /user/documents/{id}/download`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Document ID

**Description:** Download a document file

**Success Response (200):** File download

**Error Response (403):**

```json
{
  "message": "Document not available."
}
```

---

### 15. Get Receipts

**Endpoint:** `GET /user/receipts`

**Authentication:** Required (Bearer Token)

**Query Parameters:**

- `page` (optional): Page number for pagination

**Description:** Fetch paginated list of user's receipts

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "receipt_number": "RCP-001",
      "generated_at": "2026-06-13T10:30:00.000000Z",
      "payment": {
        "id": 1,
        "amount": 10000,
        "payment_reference": "PAY-ABCD1234EFGH",
        "payment_method": "online",
        "created_at": "2026-06-13T10:00:00.000000Z"
      }
    }
  ],
  "meta": {
    "total": 5,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 16. Get Receipt Details

**Endpoint:** `GET /user/receipts/{id}`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Receipt ID

**Description:** Fetch details of a specific receipt

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "receipt_number": "RCP-001",
    "generated_at": "2026-06-13T10:30:00.000000Z",
    "payment": {
      "id": 1,
      "amount": 10000,
      "payment_reference": "PAY-ABCD1234EFGH",
      "payment_method": "online",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  }
}
```

---

### 17. Download Receipt

**Endpoint:** `GET /user/receipts/{id}/download`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Receipt ID

**Description:** Download receipt as PDF

**Success Response (200):** PDF file download

---

### 18. Update User Profile

**Endpoint:** `PUT /user/profile`

**Authentication:** Required (Bearer Token)

**Description:** Update user profile information

**Request Body:**

```json
{
  "name": "John Michael Doe",
  "email": "john.doe@example.com",
  "phone": "08012345678",
  "address": "456 Oak Avenue",
  "current_password": "old_password",
  "password": "new_password",
  "password_confirmation": "new_password"
}
```

**Success Response (200):**

```json
{
  "message": "Profile updated successfully.",
  "user": {
    "id": 1,
    "name": "John Michael Doe",
    "email": "john.doe@example.com",
    "role": "user",
    "phone": "08012345678",
    "address": "456 Oak Avenue"
  }
}
```

**Error Response (422):**

```json
{
  "message": "Current password is incorrect."
}
```

---

### 19. Get User Applications

**Endpoint:** `GET /user/applications`

**Authentication:** Required (Bearer Token)

**Description:** Fetch all driving school applications submitted by the user

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "surname": "Doe",
      "email": "john@example.com",
      "phone": "08012345678",
      "status": "pending",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ]
}
```

---

### 20. Get Application Details

**Endpoint:** `GET /user/applications/{id}`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Application ID

**Description:** Fetch details of a specific application

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "first_name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "phone": "08012345678",
    "date_of_birth": "1990-01-15",
    "status": "pending",
    "passport_url": "https://example.com/passports/photo.jpg",
    "created_at": "2026-06-13T10:00:00.000000Z"
  }
}
```

---

### 21. Update Application

**Endpoint:** `PUT /user/applications/{id}`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Application ID

**Description:** Update an application (only if status is pending)

**Request Body:**

```json
{
  "first_name": "John",
  "surname": "Doe",
  "email": "john@example.com",
  "phone": "08012345678",
  "date_of_birth": "1990-01-15",
  "address": "123 Main Street",
  "license_type": "Private",
  "gender": "Male",
  "blood_group": "O+",
  "marital_status": "Single"
}
```

**Success Response (200):**

```json
{
  "data": {...},
  "message": "Application updated."
}
```

**Error Response (422):**

```json
{
  "message": "Cannot edit an approved or rejected application."
}
```

---

### 22. Upload Application Passport

**Endpoint:** `POST /user/applications/{id}/passport`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Application ID

**Description:** Upload or update passport photo for an application

**Request Type:** Form Data

**Request Body:**

```
passport: <image_file> (max 2MB, formats: jpg, jpeg, png)
```

**Success Response (200):**

```json
{
  "message": "Passport uploaded.",
  "passport_url": "https://example.com/passports/photo.jpg"
}
```

---

### 23. Delete Application

**Endpoint:** `DELETE /user/applications/{id}`

**Authentication:** Required (Bearer Token)

**Parameters:**

- `id` (required): Application ID

**Description:** Delete an application (cannot delete if approved)

**Success Response (200):**

```json
{
  "message": "Application deleted."
}
```

**Error Response (422):**

```json
{
  "message": "Cannot delete an approved application."
}
```

---

## ADMIN ENDPOINTS (Requires Admin Role)

### 24. Get Admin Dashboard

**Endpoint:** `GET /admin/dashboard`

**Authentication:** Required + Admin role

**Description:** Fetch comprehensive admin dashboard with statistics

**Success Response (200):**

```json
{
  "stats": {
    "total_users": 150,
    "total_revenue": 500000,
    "pending_payments": 10,
    "paid_payments": 45,
    "total_documents": 8,
    "total_agents": 5
  },
  "monthly_revenue": [
    {
      "month": "Jun 2026",
      "total": 50000
    }
  ],
  "recent_payments": [
    {
      "id": 1,
      "payment_reference": "PAY-ABCD1234EFGH",
      "amount": 10000,
      "status": "paid",
      "payment_method": "online",
      "created_at": "2026-06-13T10:00:00.000000Z",
      "user": {
        "name": "John Doe",
        "email": "john@example.com"
      }
    }
  ],
  "recent_users": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ]
}
```

---

### 25. Get Payments (Admin)

**Endpoint:** `GET /admin/payments`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number
- `status` (optional): Filter by status (pending, paid, failed)
- `search` (optional): Search by payment reference or user name/email

**Description:** Fetch all payments with filtering

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "payment_reference": "PAY-ABCD1234EFGH",
      "amount": 10000,
      "status": "paid",
      "payment_method": "online",
      "description": "Course Fee",
      "created_at": "2026-06-13T10:00:00.000000Z",
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      }
    }
  ],
  "meta": {
    "total": 45,
    "current_page": 1,
    "last_page": 3
  }
}
```

---

### 26. Get Payment Details (Admin)

**Endpoint:** `GET /admin/payments/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Payment ID

**Description:** Fetch detailed information about a specific payment

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "payment_reference": "PAY-ABCD1234EFGH",
    "amount": 10000,
    "status": "paid",
    "payment_method": "online",
    "description": "Course Fee",
    "paystack_reference": "PAYSTACK-REF-123",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "receipt": {
      "id": 1,
      "receipt_number": "RCP-001"
    }
  }
}
```

---

### 27. Get Payment References

**Endpoint:** `GET /admin/payment-references`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number

**Description:** Fetch all payment reference IDs

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "reference_id": "REF-ABCD1234",
      "amount": 10000,
      "description": "Course Registration",
      "status": "pending",
      "expires_at": "2026-12-31T23:59:59.000000Z",
      "created_at": "2026-06-13T10:00:00.000000Z",
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      },
      "creator": {
        "name": "Admin User"
      }
    }
  ],
  "meta": {
    "total": 10,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 28. Get Users for Payment Reference

**Endpoint:** `GET /admin/payment-references/users`

**Authentication:** Required + Admin role

**Description:** Fetch list of users for assigning payment references

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  ]
}
```

---

### 29. Create Payment Reference

**Endpoint:** `POST /admin/payment-references`

**Authentication:** Required + Admin role

**Description:** Create a new payment reference ID

**Request Body:**

```json
{
  "user_id": 1,
  "amount": 10000,
  "description": "Course Registration",
  "expires_at": "2026-12-31"
}
```

**Success Response (201):**

```json
{
  "data": {
    "id": 1,
    "reference_id": "REF-ABCD1234",
    "amount": 10000,
    "description": "Course Registration",
    "status": "pending",
    "expires_at": "2026-12-31T23:59:59.000000Z",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "user": {...},
    "creator": {...}
  }
}
```

---

### 30. Get Payment Reference Details

**Endpoint:** `GET /admin/payment-references/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Payment Reference ID

**Description:** Fetch detailed information about a payment reference

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "reference_id": "REF-ABCD1234",
    "amount": 10000,
    "description": "Course Registration",
    "status": "pending",
    "expires_at": "2026-12-31T23:59:59.000000Z",
    "created_at": "2026-06-13T10:00:00.000000Z",
    "user": {...},
    "creator": {...},
    "payment": {
      "id": 1,
      "amount": 10000,
      "payment_reference": "PAY-ABCD1234EFGH"
    }
  }
}
```

---

### 31. Update Payment Reference Status

**Endpoint:** `PATCH /admin/payment-references/{id}/status`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Payment Reference ID

**Description:** Update the status of a payment reference

**Request Body:**

```json
{
  "status": "used"
}
```

**Status Options:** `pending`, `used`, `expired`

**Success Response (200):**

```json
{
  "message": "Status updated.",
  "data": {...}
}
```

---

### 32. Delete Payment Reference

**Endpoint:** `DELETE /admin/payment-references/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Payment Reference ID

**Description:** Delete a payment reference (cannot delete if used)

**Success Response (200):**

```json
{
  "message": "Reference deleted."
}
```

**Error Response (422):**

```json
{
  "message": "Cannot delete a used payment reference."
}
```

---

### 33. Get Agent Links

**Endpoint:** `GET /admin/agent-links`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number

**Description:** Fetch all agent referral links

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "name": "John's Link",
      "description": "Referral link for John Doe",
      "unique_link": "john-link-abc123",
      "full_url": "https://example.com/ref/john-link-abc123",
      "is_active": true,
      "payments_count": 5,
      "created_at": "2026-06-13T10:00:00.000000Z",
      "agent": {
        "id": 1,
        "name": "John Doe"
      }
    }
  ],
  "meta": {
    "total": 5,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 34. Get Agents List

**Endpoint:** `GET /admin/agent-links/agents`

**Authentication:** Required + Admin role

**Description:** Fetch list of agents for creating links

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  ]
}
```

---

### 35. Create Agent Link

**Endpoint:** `POST /admin/agent-links`

**Authentication:** Required + Admin role

**Description:** Create a new agent referral link

**Request Body:**

```json
{
  "agent_id": 1,
  "name": "John's Link",
  "description": "Referral link for John Doe",
  "is_active": true
}
```

**Success Response (201):**

```json
{
  "data": {
    "id": 1,
    "name": "John's Link",
    "description": "Referral link for John Doe",
    "unique_link": "john-link-abc123",
    "full_url": "https://example.com/ref/john-link-abc123",
    "is_active": true,
    "payments_count": 0,
    "created_at": "2026-06-13T10:00:00.000000Z",
    "agent": {...}
  }
}
```

---

### 36. Get Agent Link Details

**Endpoint:** `GET /admin/agent-links/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Agent Link ID

**Description:** Fetch detailed information about an agent link

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "name": "John's Link",
    "description": "Referral link for John Doe",
    "unique_link": "john-link-abc123",
    "full_url": "https://example.com/ref/john-link-abc123",
    "is_active": true,
    "payments_count": 5,
    "created_at": "2026-06-13T10:00:00.000000Z",
    "agent": {...},
    "payments": [
      {
        "id": 1,
        "amount": 10000,
        "status": "paid",
        "user": {
          "name": "Student Name"
        }
      }
    ]
  }
}
```

---

### 37. Update Agent Link

**Endpoint:** `PUT /admin/agent-links/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Agent Link ID

**Description:** Update an agent link

**Request Body:**

```json
{
  "agent_id": 1,
  "name": "Updated Link Name",
  "description": "Updated description",
  "is_active": false
}
```

**Success Response (200):**

```json
{
  "data": {...}
}
```

---

### 38. Delete Agent Link

**Endpoint:** `DELETE /admin/agent-links/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Agent Link ID

**Description:** Delete an agent link

**Success Response (200):**

```json
{
  "message": "Agent link deleted."
}
```

---

### 39. Get Documents (Admin)

**Endpoint:** `GET /admin/documents`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number

**Description:** Fetch all documents

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "title": "Student Handbook",
      "description": "Complete guide for students",
      "file_name": "handbook.pdf",
      "file_size": 2048000,
      "is_active": true,
      "created_at": "2026-06-13T10:00:00.000000Z",
      "uploader": {
        "name": "Admin User"
      }
    }
  ],
  "meta": {
    "total": 8,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### 40. Upload Document

**Endpoint:** `POST /admin/documents`

**Authentication:** Required + Admin role

**Description:** Upload a new document

**Request Type:** Form Data

**Request Body:**

```
title: "Student Handbook"
description: "Complete guide for students"
file: <file> (pdf, jpg, jpeg, png, docx - max 10MB)
is_active: true
```

**Success Response (201):**

```json
{
  "data": {
    "id": 1,
    "title": "Student Handbook",
    "description": "Complete guide for students",
    "file_name": "handbook.pdf",
    "file_size": 2048000,
    "is_active": true,
    "created_at": "2026-06-13T10:00:00.000000Z",
    "uploader": {...}
  }
}
```

---

### 41. Update Document

**Endpoint:** `PUT /admin/documents/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Document ID

**Description:** Update document details or file

**Request Type:** Form Data

**Request Body:**

```
title: "Updated Title"
description: "Updated description"
file: <file> (optional)
is_active: true
```

**Success Response (200):**

```json
{
  "data": {...}
}
```

---

### 42. Delete Document

**Endpoint:** `DELETE /admin/documents/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Document ID

**Description:** Delete a document

**Success Response (200):**

```json
{
  "message": "Document deleted."
}
```

---

### 43. Get Users (Admin)

**Endpoint:** `GET /admin/users`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number
- `search` (optional): Search by name, email, or phone
- `role` (optional): Filter by role (admin, agent, user)

**Description:** Fetch all users with filtering

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "08012345678",
      "role": "user",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "total": 150
  }
}
```

---

### 44. Get User Details (Admin)

**Endpoint:** `GET /admin/users/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): User ID

**Description:** Fetch detailed information about a user

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "08012345678",
    "address": "123 Main Street",
    "role": "user",
    "payments_count": 5,
    "created_at": "2026-06-13T10:00:00.000000Z"
  }
}
```

---

### 45. Update User (Admin)

**Endpoint:** `PUT /admin/users/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): User ID

**Description:** Update user information

**Request Body:**

```json
{
  "name": "John Michael Doe",
  "email": "john.doe@example.com",
  "phone": "08012345678",
  "role": "agent"
}
```

**Success Response (200):**

```json
{
  "data": {...},
  "message": "User updated."
}
```

---

### 46. Delete User (Admin)

**Endpoint:** `DELETE /admin/users/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): User ID

**Description:** Delete a user

**Success Response (200):**

```json
{
  "message": "User deleted."
}
```

**Error Response (403):**

```json
{
  "message": "Cannot delete yourself."
}
```

---

### 47. Get Students

**Endpoint:** `GET /admin/students`

**Authentication:** Required + Admin role

**Query Parameters:**

- `page` (optional): Page number
- `search` (optional): Search by name, email, phone, or NIN
- `status` (optional): Filter by status (pending, approved, rejected)

**Description:** Fetch all student registrations

**Success Response (200):**

```json
{
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "surname": "Doe",
      "email": "john@example.com",
      "phone": "08012345678",
      "status": "pending",
      "created_at": "2026-06-13T10:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "total": 50
  }
}
```

---

### 48. Get Student Details

**Endpoint:** `GET /admin/students/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Student ID

**Description:** Fetch detailed information about a student

**Success Response (200):**

```json
{
  "data": {
    "id": 1,
    "first_name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "phone": "08012345678",
    "date_of_birth": "1990-01-15",
    "address": "123 Main Street",
    "license_type": "Private",
    "status": "pending",
    "nin_number": "12345678901",
    "passport_url": "https://example.com/passports/photo.jpg",
    "user": {
      "id": 1,
      "name": "John Doe"
    },
    "created_at": "2026-06-13T10:00:00.000000Z"
  }
}
```

---

### 49. Update Student

**Endpoint:** `PUT /admin/students/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Student ID

**Description:** Update student information

**Request Body:**

```json
{
  "first_name": "John",
  "surname": "Doe",
  "email": "john@example.com",
  "phone": "08012345678",
  "date_of_birth": "1990-01-15",
  "address": "456 Oak Avenue",
  "license_type": "Commercial",
  "status": "pending",
  "gender": "Male",
  "blood_group": "O+",
  "marital_status": "Single"
}
```

**Success Response (200):**

```json
{
  "data": {...},
  "message": "Student updated successfully."
}
```

---

### 50. Delete Student

**Endpoint:** `DELETE /admin/students/{id}`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Student ID

**Description:** Delete a student registration

**Success Response (200):**

```json
{
  "message": "Student deleted successfully."
}
```

---

### 51. Upload Student Passport

**Endpoint:** `POST /admin/students/{id}/passport`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Student ID

**Description:** Upload or update student's passport photo

**Request Type:** Form Data

**Request Body:**

```
passport: <image_file> (max 2MB, jpg/jpeg/png)
```

**Success Response (200):**

```json
{
  "message": "Passport uploaded successfully.",
  "passport_url": "https://example.com/passports/photo.jpg"
}
```

---

### 52. Update Student Status

**Endpoint:** `PATCH /admin/students/{id}/status`

**Authentication:** Required + Admin role

**Parameters:**

- `id` (required): Student ID

**Description:** Update student application status

**Request Body:**

```json
{
  "status": "approved"
}
```

**Status Options:** `pending`, `approved`, `rejected`

**Success Response (200):**

```json
{
  "message": "Status updated.",
  "data": {...}
}
```

---

### 53. Get Settings

**Endpoint:** `GET /admin/settings`

**Authentication:** Required + Admin role

**Description:** Fetch all school settings

**Success Response (200):**

```json
{
  "data": {
    "school_name": "Alfawzan Driving School",
    "logo_url": "https://example.com/logo.png",
    "tagline": "Professional Driving Training",
    "address": "123 Main Street",
    "phone": "08012345678",
    "phone2": "08087654321",
    "phone3": null,
    "email": "info@alfawzan.com",
    "website": "https://alfawzan.com",
    "facebook_url": "https://facebook.com/alfawzan",
    "instagram_url": "https://instagram.com/alfawzan",
    "twitter_url": "https://twitter.com/alfawzan",
    "seo_title": "Alfawzan Driving School",
    "seo_description": "Best driving school in the region",
    "seo_keywords": "driving, school, training",
    "receipt_footer": "Thank you for your patronage",
    "registration_fee_note": "Registration fee is non-refundable",
    "signature_url": "https://example.com/signature.png"
  }
}
```

---

### 54. Update Settings

**Endpoint:** `POST /admin/settings`

**Authentication:** Required + Admin role

**Description:** Update school settings

**Request Body:**

```json
{
  "school_name": "Alfawzan Driving Academy",
  "tagline": "Excellence in Driving Training",
  "address": "456 Oak Avenue",
  "phone": "08012345678",
  "phone2": "08087654321",
  "phone3": "08098765432",
  "email": "info@alfawzan.com",
  "website": "https://alfawzan.com",
  "facebook_url": "https://facebook.com/alfawzan",
  "instagram_url": "https://instagram.com/alfawzan",
  "twitter_url": "https://twitter.com/alfawzan",
  "seo_title": "Alfawzan Driving Academy",
  "seo_description": "Professional driving training institute",
  "receipt_footer": "Thank you for choosing us",
  "registration_fee_note": "Non-refundable fee"
}
```

**Success Response (200):**

```json
{
  "message": "Settings saved.",
  "data": {...}
}
```

---

### 55. Upload Logo

**Endpoint:** `POST /admin/settings/logo`

**Authentication:** Required + Admin role

**Description:** Upload school logo

**Request Type:** Form Data

**Request Body:**

```
logo: <image_file> (max 2MB, jpg/jpeg/png)
```

**Success Response (200):**

```json
{
  "message": "Logo uploaded.",
  "logo_url": "https://example.com/logo.png"
}
```

---

### 56. Upload Signature

**Endpoint:** `POST /admin/settings/signature`

**Authentication:** Required + Admin role

**Description:** Upload digital signature for receipts

**Request Type:** Form Data

**Request Body:**

```
signature: <image_file> (max 2MB, jpg/jpeg/png)
```

**Success Response (200):**

```json
{
  "message": "Signature uploaded.",
  "signature_url": "https://example.com/signature.png"
}
```

---

## AGENT ENDPOINTS (Requires Agent Role)

### 57. Get Agent Dashboard

**Endpoint:** `GET /agent/dashboard`

**Authentication:** Required + Agent role

**Description:** Fetch agent dashboard with performance metrics

**Success Response (200):**

```json
{
  "stats": {
    "total_links": 3,
    "total_payments": 15,
    "total_revenue": 150000
  },
  "links": [
    {
      "id": 1,
      "name": "John's Link",
      "full_url": "https://example.com/ref/john-link-abc123",
      "is_active": true,
      "payments_count": 5,
      "revenue": 50000
    }
  ]
}
```

---

## ERROR RESPONSES

### Common HTTP Status Codes

| Status Code | Description                                  |
| ----------- | -------------------------------------------- |
| 200         | OK - Request successful                      |
| 201         | Created - Resource created successfully      |
| 400         | Bad Request - Invalid parameters             |
| 401         | Unauthorized - Authentication required       |
| 403         | Forbidden - No permission to access resource |
| 404         | Not Found - Resource not found               |
| 422         | Unprocessable Entity - Validation errors     |
| 500         | Internal Server Error - Server error         |

### Common Error Response Format

```json
{
  "message": "Error description",
  "errors": {
    "field_name": ["Error message for field"]
  }
}
```

---

## NOTES

- All timestamps are in ISO 8601 format (UTC)
- Pagination uses standard page-based system (20 items per page by default)
- File uploads support: PDF, JPG, JPEG, PNG, DOCX (max 10MB)
- Image uploads support: JPG, JPEG, PNG (max 2MB)
- All monetary amounts are in the system's base currency
- Authentication tokens last 7 days by default, 30 days if "remember me" is enabled
- All date fields are automatically generated by the system

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Author

**[Your Name]**

- LinkedIn: [Your LinkedIn](https://linkedin.com/in/yourusername)
- X (Twitter): [@yourhandle](https://x.com/yourhandle)

---

[![PHP](https://img.shields.io/badge/PHP-8.1+-%23777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-%23FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![Paystack](https://img.shields.io/badge/Paystack-00C3F8?style=flat-square&logo=paystack&logoColor=white)](https://paystack.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-%237952B3?style=flat-square&logo=bootstrap)](https://getbootstrap.com/)
[![Chart.js](https://img.shields.io/badge/Chart.js-4.x-%23FF6384?style=flat-square&logo=chartdotjs)](https://www.chartjs.org/)

[![Readme was generated by Dokugen](https://img.shields.io/badge/Readme%20was%20generated%20by-Dokugen-brightgreen)](https://www.npmjs.com/package/dokugen)
