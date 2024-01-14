# Financial-client-api

This is  PHP client to work with Financial Modelling API

### Installation
git clone https://github.com/sabitri-shrestha/financial-client-api.git

# Navigate to the project directory
cd financial-client-api

# Install Laravel Sail and set up the environment
composer install
php artisan sail:install
./vendor/bin/sail up -d

# Install PHP dependencies using Sail
./vendor/bin/sail composer install

# Run database migrations and seed the database
./vendor/bin/sail artisan migrate --seed

# Install JavaScript dependencies using npm or yarn
npm install  # or yarn

# Build assets
npm run dev  # or yarn dev
