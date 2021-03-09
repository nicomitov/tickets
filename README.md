# tickets

![Screenshot from 2021-03-09 16-24-34](https://user-images.githubusercontent.com/10790795/110485107-fa51b880-80f3-11eb-9610-3218914b4fa8.png)

A simple ticketing system, based on Laravel 7.x, Bootstrap 4.6 and ModularAdmin Dashboard Theme.

Integrated features:
- datatables
- filemanager
- fontawesome icons
- tinymce
- bootstrap multiselect


## How to start this prject?

**1. Clone this repo**

    git clone https://github.com/nicomitov/tickets.git

**2. Install dependencies**

    composer install
    npm install
    npm run dev

**3. Rename `.env.example` to `.env` and add these lines**

    APP_VERSION=0.0.1-dev
    ALLOW_REGISTRATION=false

**4. Generate a key**

    php artisan key:generate

**5. Create a database and migrate**

    php artisan migrate --seed

**6. Start the web server**

    php artisan serve

**7. Login with default credentials**

    email: admin@gmail.com
    passwd: admin
