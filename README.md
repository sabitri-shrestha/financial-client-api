# Financial-client-api

This is  PHP client to work with Financial Modelling API

### Installation
git clone https://github.com/sabitri-shrestha/financial-client-api.git

# Navigate to the project directory
cd financial-client-api

#copy .env.example file and rename it to .env

#add your database variables in .env file  and add your key like this FINANCIAL_MODELING_API_KEY=your_key

# Install Laravel Sail and set up the environment
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs

# Run sail
./vendor/bin/sail up -d  

# Run database migrations and seed the database
./vendor/bin/sail artisan migrate

# Install JavaScript dependencies using npm or yarn
./vendor/bin/sail npm install  # or yarn

# Build assets
./vendor/bin/sail npm run dev  # or yarn dev
