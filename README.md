# Lumen Performance API

## Setup Instructions

- Navigate into project directory
    ```bash
    cd lumen-performance-api
    ```
- Install composer packages
    ```bash
    composer install
    ```
- Create `.env` file
    ```bash
    cp .env.example .env
    ```
- Generate application key
    ```bash
    php artisan key:generate
    ```
- Create a new MySQL database named `performance_api`
- Set database credentials in `.env` file
    ```bash
    DB_DATABASE=performance_api
    DB_USERNAME=root
    DB_PASSWORD=
    ```
- Run database migration
    ```bash
    php artisan migrate
    ```
- Serve application on port `8001`
    ```bash
    php artisan serve --port=8001
    ```
- Access application within browser on URL `http://localhost:8001/`
