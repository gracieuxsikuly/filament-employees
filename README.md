
# Filament Employees Management Project

This project leverages Laravel Filament to streamline employee management and enhance project workflows. With Filament's admin panel, we efficiently handle CRUD operations, data visualization, and reporting, making it ideal for maintaining employee records and monitoring project progress.

## Requirements

- PHP 8.1 or higher
- Composer
- Laravel 10 or higher
- Laravel Filament 3.x
- Laravel Breeze
- Livewire

## Installation
Follow these steps to set up and run the project:

### 1. Clone the Repository
git clone https://github.com/your-username/filament-employees.git
cd filament-employees


### 2. Install Dependencies

Make sure you have [Composer](https://getcomposer.org/) installed on your machine. Then run:
composer install

### 3. Set Up Environment Variables
Copy the `.env.example` file to `.env` and configure your database and other environment settings:
cp .env.example .env

### 4. Generate Application Key
php artisan key:generate

### 5. Run Migrations

Set up the database schema by running the migrations:

php artisan migrate


### 6. Install Filament

Install Filament and set up the admin panel:
composer requere filament/filament
php artisan filament:install --panels
### Create a user
You can create a new user account with the following command:
php artisan make:filament-user

### 7. Install Laravel Breeze and Livewire

Install Laravel Breeze for authentication and Livewire for reactive components:

composer require laravel/breeze --dev
php artisan breeze:install blade
composer require livewire/livewire
npm install && npm run dev
php artisan migrate


## Usage

To start the development server, run:

php artisan serve

You can now access the application at `http://localhost:8000/admin/login`.
# Author
Gracier Kambale Sikuly
## Contributing

If you wish to contribute to this project, please fork the repository and submit a pull request. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-source and available under the [MIT License](LICENSE).


Enjoy using the Filament Employees Management Project!


Simply copy this Markdown content into your `README.md` file, and it will provide clear and concise installation instructions along with a brief overview of the project.
