# POP TRACKER

POP TRACKER is a Laravel-based web application for managing and tracking Funko Pop collections. It allows users to organize their collections, manage wishlists, and visualize collection statistics with interactive charts.

## Features

- User authentication and dashboard
- Add, edit, and remove Funko Pop items
- Wishlist and duplicate management
- Collection statistics with Chart.js visualizations
- QR code generator for sharing collection URLs
- Responsive and modern UI with Tailwind CSS

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & npm

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/poptracker.git
   cd poptracker
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```sh
   npm install
   ```

4. **Copy the example environment file and set your configuration:**
   ```sh
   cp .env.example .env
   ```

5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

6. **Run migrations:**
   ```sh
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```sh
   npm run build
   ```

8. **Start the development server:**
   ```sh
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000`
- Register a new account and start managing your Funko Pop collection

## Project Structure

- `app/` - Application logic (Models, Controllers, Actions, etc.)
- `resources/views/` - Blade templates for UI ([user_dashboard/dashboard.blade.php](resources/views/user_dashboard/dashboard.blade.php), [welcome.blade.php](resources/views/welcome.blade.php))
- `routes/` - Application routes
- `config/` - Configuration files
- `public/` - Public assets and entry point
- `database/` - Migrations and seeders
- `tests/` - Automated tests

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).