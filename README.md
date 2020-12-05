# Blog API

## Dependencies

    1. lighthouse-graphql-passport-auth
    2. Laravel passport
    3. lighthouse

## Getting Started

``` diff

# Clone The Project
    git clone https://github.com/Ayoub-Bouarbi/blog-api.git

# cd to Project Directory
    cd blog-api

# install Dependencies
    composer install
    
# create .env file

# Copy .env.example file to .env and edit database credentials there

# Generate APP_KEY
    php artisan key:generat  

# Run migrations
    php artisan migrate --seed (it has some seeded data for your testing)

# Create Client
    php artisan passport:install
```
