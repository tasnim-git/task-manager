# Task Management System

A simple and clean task management system built using Laravel.

## Features
- Create, update, and delete tasks
- Task status tracking (Pending, In Progress, Completed)
- Dashboard with task statistics
- Clean MVC architecture
- Feature tests for reliability

## Tech Stack
- Laravel
- MySQL
- Blade
- Tailwind CSS

## Installation

## bash
git clone https://github.com/tasnim-git/task-manager.git
cd task-manager
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## Testing
php artisan test