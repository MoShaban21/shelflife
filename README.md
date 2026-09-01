# ShelfLife

A library management and book borrowing system.

## Installation

1. Install PHP dependencies:

```bash
composer install
```

2. Create your environment file:

```bash
cp .env.example .env
```

On Windows PowerShell, you can also use:

```powershell
Copy-Item .env.example .env
```

3. Generate the application key:

```bash
php artisan key:generate
```

4. Configure your database in the `.env` file.

5. Run the database migrations:

```bash
php artisan migrate
```

6. Start the Laravel development server:

```bash
php artisan serve
```

The application will then be available at:

`http://127.0.0.1:8000`
