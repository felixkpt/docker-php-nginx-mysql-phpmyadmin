Here's a README for your **php-docker-nginx-mysql-phpmyadmin** project:

---

# php-docker-nginx-mysql-phpmyadmin

A simple Docker-based development environment featuring PHP, MySQL, phpMyAdmin, and Nginx. This setup enables you to easily run a PHP web application with a MySQL database and manage the database using phpMyAdmin.

## Table of Contents

- [Overview](#overview)
- [Technologies](#technologies)
- [Requirements](#requirements)
- [Setup and Installation](#setup-and-installation)
- [Usage](#usage)
- [Directory Structure](#directory-structure)
- [Customization](#customization)
- [License](#license)

## Overview

This project utilizes Docker to set up an environment with the following components:

- **PHP** (PHP-FPM): The PHP backend server.
- **Nginx**: The web server that serves the PHP application.
- **MySQL**: A relational database server with a demo database.
- **phpMyAdmin**: A web interface to manage MySQL databases.

The `docker-compose.yml` file orchestrates the services, and each service is configured to work seamlessly together.

## Technologies

- **PHP**: PHP 8.2 with necessary extensions (PDO, mysqli, pdo_mysql).
- **MySQL**: MySQL 5.7 running in a Docker container.
- **Nginx**: Lightweight web server to serve the PHP application.
- **phpMyAdmin**: Web-based MySQL management interface.
- **Docker**: Containerization platform to manage the services.

## Requirements

- Docker
- Docker Compose

Ensure Docker and Docker Compose are installed on your system. You can follow the installation guides for [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/install/) if you don't have them installed yet.

## Setup and Installation

1. Clone the repository or download the project files.

2. Navigate to the project directory:

    ```bash
    cd php-docker-nginx-mysql-phpmyadmin
    ```

3. Build and start the services using Docker Compose:

    ```bash
    docker-compose up --build -d
    ```

    This will build the PHP image, pull the necessary images for MySQL, Nginx, and phpMyAdmin, and start the containers in detached mode.

## Usage

1. **Access the application**:
    - The PHP application will be available at [http://localhost:8080](http://localhost:8080).
    - Nginx serves the application, and PHP-FPM processes PHP files.

2. **Access phpMyAdmin**:
    - phpMyAdmin will be available at [http://localhost:8081](http://localhost:8081).
    - Login with the following credentials:
        - **Username**: `root`
        - **Password**: `demo_password`

3. **Interact with MySQL**:
    - The MySQL server runs on port `3307` (you can connect to it using MySQL client with the following credentials):
        - **Username**: `root`
        - **Password**: `demo_password`
        - **Database**: `demo_db`

4. **Application Demo**:
    - The PHP application automatically creates a `users` table in the `demo_db` database if it doesn't exist, and inserts sample data for users (`John Doe` and `Jane Smith`).
    - You can see the success or error messages, and view the users listed in the database.

## Directory Structure

```bash
docker/
    ├── Dockerfile
    ├── docker-compose.yml
    ├── nginx.conf
public/
    ├── index.php
```

- `Dockerfile`: Defines the PHP image, installs necessary extensions, and configures PHP-FPM.
- `docker-compose.yml`: Defines and configures all the services (PHP, Nginx, MySQL, phpMyAdmin).
- `nginx.conf`: Nginx configuration file to serve the PHP application.
- `index.php`: Example PHP script that connects to MySQL, creates a table, and inserts demo data.

## Customization

You can customize the project as follows:

- Modify the `nginx.conf` file to change the Nginx configuration (e.g., set a different root path, enable SSL).
- Modify the `index.php` to match your application's requirements or extend it with more complex logic.
- Modify the MySQL environment variables in the `docker-compose.yml` file, such as the `MYSQL_ROOT_PASSWORD` or `MYSQL_DATABASE`.

## License

This project is open-source and released under the [MIT License](LICENSE).