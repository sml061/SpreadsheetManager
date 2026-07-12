Install composer if not installed!

// phpMiller install command
    - Install phpMiler
    
    composer require phpmailer/phpmailer

// dotEnv install command
    - Install dotEnv

    composer require vlucas/phpdotenv


// Email Message
    - To send emails, create the .env file and configure it according to the following template.

    SMTP_HOST=smtp.gmail.com
    SMTP_AUTH=true
    SMTP_USERNAME='YourEmail@gmail.com'
    SMTP_PASSWORD='App Password'
    SMTP_SECURE=ssl
    SMTP_PORT=465
    DB_HOST=127.0.0.1
    DB_NAME='DB Name'
    DB_USER='User Name'
    DB_PASSWORD='Password'
