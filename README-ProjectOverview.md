===Wasll Backend API===

. Transportation & Trip Management Backend System built using Laravel and MySQL.

# Project Overview

Wasll is a backend system designed for managing transportation and trip workflows between passengers and drivers.

The project focuses on building scalable RESTful APIs with secure authentication, trip lifecycle management, role-based access control, and modular backend architecture following SOLID principles.

# Features
. JWT Authentication
. Secure Refresh Token Rotation
. Role-Based Authorization
. Passenger & Driver Management
. Trip Management System
. Vehicle Management
. Route Management
. File Uploads (Profile Pictures)
. RESTful API Architecture
. Service Layer & Repository Pattern
. Database Relationships & Indexing
. Validation & Error Handling

# Tech Stack
Backend
PHP 8+
Laravel 12
Database
MySQL
Authentication
JWT Authentication
Refresh Tokens
HttpOnly Cookies
Tools
Postman
Git
GitHub

# Project Structure
app/
├── Http/
├── Models/
├── Services/
├── Repositories/
├── Http/Controllers/API/
├── Http/Requests/
├── Http/Resources/

# Installation

1) Clone Repository
git clone https://github.com/mohamednabawy091/wasll.git

2) Navigate to Project
cd wasll

3) Install Dependencies
composer install

4) Create Environment File
cp .env.example .env

5) Generate Application Key
php artisan key:generate

6) Configure Database

DB_DATABASE=wasll
DB_USERNAME=wusll
DB_PASSWORD=

7) Run Migrations
php artisan migrate

8) Start Development Server
php artisan serve
API Authentication

The system uses JWT-based authentication with refresh token rotation.

# Authentication Flow

Login
   ↓
Generate Access Token
   ↓
Generate Refresh Token
   ↓
Store Refresh Token in HttpOnly Cookie
   ↓
Access Token Expired
   ↓
Refresh Endpoint
   ↓
Generate New Access Token

# Authentication Features
. JWT Access Tokens
. Secure Refresh Tokens
. Token Hashing
. Token Rotation
. HttpOnly Cookies
. Expiration Validation

# API Modules
Authentication
Register
Login
Logout
Refresh Token
Trips
Create Trip
Assign Trip to Driver
Update Trip Status
Trip Details
Vehicles
Create Vehicle
Assign Vehicle
Vehicle Listing
Drivers
Driver Management
Driver Assignment


# File Uploads
. The project supports secure file uploads using Laravel Storage.

# Supported Uploads

. Profile Pictures
. Storage Features
. UUID File Naming
. File Validation
. Public Disk Storage

# Database Design
Main Relationships

. User → Trips
. Driver → Trips
. Vehicle → Trips
. Route → Trips

# Security Features
. Password Hashing
. Refresh Token Hashing
. Request Validation
. Protected API Routes
. Secure Authentication Flow

# Future Improvements
. Real-Time Trip Tracking
. Notifications System
. Payment Integration
. Geo-location Features
. Queue Jobs
. Admin Dashboard
. API Documentation