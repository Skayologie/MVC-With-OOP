# PHP MVC Framework

## Description
A robust, secure, and modular PHP MVC framework designed for modern web application development. This framework provides a solid architecture with advanced features for building scalable and maintainable web applications.

## Features
- 🔒 Advanced routing system
- 🔐 Secure PostgreSQL connection via PDO
- 🚪 Separate Front Office and Back Office
- 🔐 Secure authentication system
- 🛡️ Role-based access control (ACL)
- 🖼️ Twig template engine
- 💉 Dependency injection
- 🛡️ Protection against SQL injection and XSS
- 📝 Comprehensive logging system
- 🏗️ Implementation of design patterns

## Requirements
- PHP 8.0+
- Composer
- PostgreSQL
- Web server (Apache recommended)

## Installation

1. Clone the repository
```bash
git clone https://github.com/Skayologie/MVC-With-OOP.git
cd MVC-With-OOP
```

2. Install dependencies
```bash
composer install
```

3. Configure environment
- Rename `.env.example` to `.env`
- Update database informations

4. Create autoload
```bash
# Run database migrations
composer dump-autoload
```

## Configuration
Edit files in the `config/` directory:
- `database.php`: Database connection settings
- `routes.php`: Define application routes
- `app.php`: Application-level configurations

## Security Features
- CSRF token generation and validation
- Input sanitization
- SQL injection prevention
- Secure session management

## Development
- Follow PSR-4 autoloading standards
- Use dependency injection
- Implement services via Service Container
- Validate and sanitize all user inputs

## Contributing
1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

