# ShelfLife

A library book-loan management system built with Laravel.

Members can browse and borrow books, view their loan history, and search the catalog.  
Librarians can manage books/copies and process returns.  
The project also exposes a token-authenticated JSON API.

## Tech Stack

- Laravel
- Blade + Breeze (auth)
- MySQL
- Laravel Sanctum (API tokens)
- Pest (tests)
- Laravel Pint (code style)

## Features

- Role-based access (`member` / `librarian`)
- Book and physical copy management
- Borrowing with business rules:
  - no borrow if no available copies
  - no borrow if member has overdue loans
- Librarian return flow
- Member loan history
- Book search (title/author)
- JSON API:
  - `POST /api/login`
  - `GET /api/user`
  - `GET /api/books`
  - `GET /api/loans`
- Automated feature tests for core borrowing rules and API auth

## Setup

```bash
git clone <your-repo-url>
cd shelflife
composer install
cp .env.example .env
php artisan key:generate
Update database settings in .env, then:
Bashphp artisan migrate --seed
php artisan serve
App URL: http://127.0.0.1:8000
Demo credentials
Librarian (seeded):

Email: admin@shelflife.test
Password: password

Test/demo credentials only. Not for production use.
Members can register normally from /register.
Tests
Run the full suite:
Bashphp artisan test
API quick start

Login:

BashPOST /api/login
{
  "email": "member@example.com",
  "password": "password"
}

Use the returned token:

textAuthorization: Bearer {token}

Example endpoints:


GET /api/books
GET /api/loans