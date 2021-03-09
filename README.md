# tickets
Simple ticket system, based on Laravel 7.x, Bootstrap 4.6 and ModularAdmin Dashboard Theme.

Included: 
- datatables
- filemanager
- fontawesome icons
- tinymce

How to start this prject?

**1. Clone this repo**

git clone https://github.com/nicomitov/tickets.git

**2. Install dependencies**

composer install

npm install

npm run dev

**3. Rename .env.example to .env**

**4. Add these lines to .env:**

APP_VERSION=0.0.1-dev

ALLOW_REGISTRATION=false

**5. Generate a key**

php artisan key:generate

**6. Create a database and migrate**

php artisan migrate --seed

**7. Start the web server**

php artisan serve

**8. Login with default credentials**

email: admin@gmail.com

passwd: admin
