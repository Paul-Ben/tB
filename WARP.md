# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

This is a Laravel 10 application built with:
- **Laravel Breeze** for authentication scaffolding
- **Spatie Laravel Permission** for role-based access control
- **Vite** for frontend asset bundling
- **TailwindCSS** with AlpineJS for styling and interactivity
- **PHPUnit** for testing

## Essential Development Commands

### Initial Setup
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file and configure
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed the database (if seeders exist)
php artisan db:seed
```

### Development Workflow
```bash
# Start development server
php artisan serve

# Start Vite development server (for assets)
npm run dev

# Build production assets
npm run build

# Run database migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run specific test file
php artisan test tests/Feature/AuthenticationTest.php

# Run tests with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Check code style without fixing
./vendor/bin/pint --test
```

### Cache and Optimization
```bash
# Clear all caches
php artisan optimize:clear

# Cache configuration and routes for production
php artisan optimize

# Clear specific caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Architecture Overview

### Authentication System
- Uses **Laravel Breeze** for authentication scaffolding
- Provides login, registration, password reset, and email verification
- Routes defined in `routes/auth.php`
- Controllers located in `app/Http/Controllers/Auth/`
- Views in `resources/views/auth/`

### Permission System
- **Spatie Laravel Permission** package for role-based access control
- Migration creates `permissions`, `roles`, and pivot tables
- Configuration in `config/permission.php`
- Teams feature is disabled (`'teams' => false`)
- Permission caching enabled (24-hour expiration)

### Frontend Architecture
- **Vite** bundler with Laravel plugin
- **TailwindCSS** for utility-first styling
- **AlpineJS** for reactive components
- Entry points: `resources/css/app.css` and `resources/js/app.js`
- Blade components in `resources/views/components/`

### Database Structure
- Standard Laravel user authentication tables
- Spatie permission system tables (roles, permissions, pivots)
- Migrations in `database/migrations/`
- Factories for testing in `database/factories/`

### Application Structure
- **Models**: `app/Models/` (User model with standard Laravel auth traits)
- **Controllers**: `app/Http/Controllers/` (Profile and Auth controllers)
- **Middleware**: Standard Laravel middleware in `app/Http/Middleware/`
- **Views**: Blade templates in `resources/views/` with component-based structure
- **Routes**: Separated into `web.php`, `api.php`, and `auth.php`

## Important Configuration Files

- **Environment**: `.env` (copy from `.env.example`)
- **Database**: `config/database.php`
- **Permissions**: `config/permission.php`
- **Frontend**: `vite.config.js`, `tailwind.config.js`
- **Testing**: `phpunit.xml`

## Development Notes

### Permission System Usage
To use the Spatie permission system in models:
- Add `HasRoles` and/or `HasPermissions` traits to User model
- Create and assign roles/permissions via Artisan commands or seeders
- Check permissions in controllers with middleware or direct methods

### Frontend Development
- Run `npm run dev` during development for hot reloading
- TailwindCSS configured to scan Blade templates and framework views
- AlpineJS available globally for reactive components

### Testing Environment
- PHPUnit configured with separate testing environment variables
- Feature tests for authentication flows included
- Database configured for array cache and sync queue in testing