-   Clone the repo
-   Extract the file to your desired path
-   Required PHP version 8.0
-   Install composer
-   Install nodejs
-   Start XAMPP Control Panel
-   Open PHPMYADMIN
-   Create a database 'contact'
-   Open the project to cmd. Example if your project located at C:\Users\Downloads\stem-mobile copy the path and type in them cmd cd $path
-   Once done, run the following commands
-   composer update
-   npm install
-   copy .env.example and rename to .env
-   open the .env file
-   configure localhost properties such as: DB_DATABASE, DB_USERNAME, DB_PASSWORD
-   DB_DATABASE is equal to the database your created 'contact'
-   php artisan key:generate
-   php artisan migrate:fresh --seed
