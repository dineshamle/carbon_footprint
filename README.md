## Installation instructions
1. Clone the repo via this url `https://github.com/dineshamle/carbon_footprint.git`
2. Get inside the project folder `cd carbon_footprint`
3. Create a `.env` file by running the following command `cp .env.example .env`. Update your database credentials inside this `.env` file.
4. Install various packages and dependencies: `composer install`
5. Generate an encryption key for the app: `php artisan key:generate`.
6. Run migrations: `php artisan migrate`
7. Add `TRIPTOCARBON_API=https://api.triptocarbon.xyz/v1/footprint` in `.env` file
8. Run `php artisan serve` and open `http://127.0.0.1:8000` in your browser
9. You are now good to go.