# LMS - RGC

A library management system that allows for the efficient organization and management of books, borrowers, and inventory.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them.

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer

### Installing

A step-by-step guide to help you get a development environment running:

1. Clone the repository

```bash
git clone https://github.com/199ocero/Library-Management-System-RGC.git
```

2. Install the dependencies

```bash
composer install
```

3. Configure your .env file

- cp .env.example .env

4. Generate an app key

```bash
php artisan key:generate
```

5. Run migrations

```bash
php artisan migrate
```

6. Start the server

```bash
php artisan serve
```

Now you should be able to access the application in your browser at http://localhost:8000.

## Built With

- [Laravel](https://laravel.com/) - The web framework used for building the project. Laravel is a PHP framework that provides a set of tools and features for building modern web applications.

- [Livewire](https://laravel-livewire.com/) - A full-stack framework for building dynamic interfaces. Livewire is a tool built on top of Laravel that allows you to build reactive user interfaces using PHP, without the need for JavaScript.

- [Bootstrap](https://getbootstrap.com/) - A CSS framework for creating responsive, mobile-first web designs. Bootstrap is a popular open-source tool that provides a set of CSS classes and JavaScript plugins for creating responsive, mobile-friendly websites.

- [MySQL](https://www.mysql.com/) - The database management system used to store the project data. MySQL is a popular open-source relational database management system that is widely used in web applications.

- [Git](https://git-scm.com/) - A version control system used to manage the project's codebase. Git is a widely-used open-source tool that allows developers to keep track of changes made to the code, collaborate with other developers, and roll back to previous versions of the code if needed.
