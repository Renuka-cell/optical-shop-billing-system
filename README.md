# Optical Shop Billing & Invoice Management System

## Project Overview

The Optical Shop Billing & Invoice Management System is a full-stack web application developed to automate and digitize the daily operations of an optical store. The system enables efficient management of customers, invoices, prescriptions, payments, staff, and shop information through a secure and user-friendly interface.

The application is built using CodeIgniter 4 for the backend and React.js for the frontend. It provides secure authentication, role-based access control, invoice generation, PDF downloads, customer history tracking, staff management, payment monitoring, and shop settings management.

---

## Features

### Authentication & Authorization

- Secure Login System
- Session-Based Authentication
- Protected Routes
- Role-Based Access Control
- Password Validation
- Password Visibility Toggle
- Secure Session Management

### User Roles

#### Admin

- Dashboard Access
- Create Invoice
- Search Customer
- Customer History
- Invoice Management
- All Invoices
- Staff Management
- Shop Settings
- Payment Updates
- Invoice Editing
- Invoice Deletion

#### Staff

- Create Invoice
- Search Customer
- Customer History

---

### Customer Management

- Customer Search
- Customer Billing History
- Prescription History Tracking
- Customer Information Storage

### Invoice Management

- Create Invoice
- Edit Invoice
- Delete Invoice
- Search Invoices
- Invoice Listing
- Auto Invoice Number Generation
- Download PDF Invoice

#### Invoice Number Format

```text
INV-2026-001
INV-2026-002
INV-2026-003
```

### Prescription Management

#### Right Eye (RE)

- SPH
- CYL
- AXIS
- ADD

#### Left Eye (LE)

- SPH
- CYL
- AXIS
- ADD

#### Additional Features

- Lens Type Management
- Prescription Popup View
- Prescription History Tracking

### Payment Management

- Payment Tracking
- Due Amount Calculation
- Partial Payment Support
- Payment Status Updates
- Payment Mode Management

#### Payment Status

- PAID
- PARTIAL
- PENDING

### Staff Management

- Create Staff Accounts
- Edit Staff Information
- Delete Staff Accounts
- Reset Password
- Username Management
- Password Visibility Toggle

#### Password Policy

Password must contain:

- 8–20 Characters
- At Least One Uppercase Letter
- At Least One Lowercase Letter
- At Least One Number
- At Least One Special Character

Example:

```text
Admin@123
```

### Shop Settings

- Shop Name Management
- Address Management
- Phone Number Management
- Email Management
- GST Number Management
- Dynamic Shop Information in Invoice PDFs

### PDF Invoice Generation

- Professional Invoice Layout
- Customer Details
- Prescription Details
- Payment Information
- Dynamic Shop Information
- Downloadable PDF Format

---

## Technology Stack

### Frontend

- React.js
- Vite
- Tailwind CSS
- Axios
- React Router DOM
- React Hot Toast
- Lucide React

### Backend

- PHP 8+
- CodeIgniter 4
- MySQL
- REST API Development

### PDF Generation

- mPDF

---

## Project Structure

```text
billing_system_php
│
├── README.md
├── .gitignore
│
├── backend
│   │
│   ├── app
│   │   ├── Controllers
│   │   ├── Models
│   │   ├── Views
│   │   ├── Config
│   │   └── Libraries
│   │
│   ├── public
│   ├── writable
│   ├── composer.json
│   ├── composer.lock
│   └── spark
│
├── frontend
│   │
│   ├── public
│   ├── src
│   │   ├── components
│   │   ├── pages
│   │   ├── services
│   │   └── assets
│   │
│   ├── package.json
│   ├── package-lock.json
│   └── vite.config.js
│
└── database
```

---

## Installation Guide

### Clone Repository

```bash
git clone https://github.com/Renuka-cell/optical-shop-billing-system.git
cd billing_system_php
```

## 1. Backend Setup

### Navigate to Backend

```bash
cd backend
```

### Install Dependencies

```bash
composer install
```

### Configure Environment

Copy:

```bash
env
```

to:

```bash
.env
```

### Configure Database

Update database settings inside `.env`

```env
database.default.hostname = localhost
database.default.database = billing_system
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### Run Migrations

```bash
php spark migrate
```

### Start Backend Server

```bash
php spark serve
```

### Backend URL

```bash
http://localhost:8080
```

---

## 2. Frontend Setup

Open a new terminal.

```bash
cd frontend
npm install
npm run dev
```

### Frontend URL

```bash
http://localhost:5173
```

---

## Application Workflow

1. User logs in using username and password.
2. System validates credentials.
3. Role permissions are loaded.
4. Customer details are entered or retrieved.
5. Invoice is generated.
6. Prescription information is stored.
7. Payment details are recorded.
8. Invoice PDF is generated.
9. Customer history is maintained.
10. Admin can manage staff and shop settings.

---

## Security Features

- Role-Based Access Control
- Password Validation
- Protected Admin Operations
- Session Authentication
- Input Validation
- Secure API Communication

---

## Recent Enhancements

- Django to CodeIgniter 4 Migration
- Improved Invoice Number Generation
- Username Tracking for Invoice Creation
- Shop Settings Integration
- Password Visibility Toggle
- Strong Password Validation
- Enhanced Staff Management
- Improved Invoice PDF Generation

---

## Author

Developed as an Internship Project for Optical Shop Billing & Invoice Management Automation.

**Frontend:** React.js + Vite + Tailwind CSS

**Backend:** CodeIgniter 4 + PHP + MySQL
