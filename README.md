# Blog API

## Dependencies

    1. lighthouse-graphql-passport-auth
    2. Laravel passport
    3. lighthouse
    4. nestablecollection

## Getting Started

    ```
    diff
        # Clone The Project
            git clone https://github.com/Ayoub-Bouarbi/blog-api.git

        # cd to Project Directory
            cd blog-api

        # install Dependencies
            composer install

        # Create new file called .env and copy .env.example into .env file

        # Generate APP_KEY
            php artisan key:generat
        # Configure Database in .env file

            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=database
            DB_USERNAME=user
            DB_PASSWORD=secret    

        # Run migrations
            php artisan migrate

        # Create Client
            php artisan passport:install
    ```
