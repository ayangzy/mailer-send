# Task Description
Create a mini version of a transactional email app, let's call it MiniSend, where a client could send an email through a Laravel API and also would have the ability to see how many emails have been sent, and track more interesting data about them through a VueJS frontend

# Task Requirements
### Email API <br>
Allow sending emails with these fields: <br>
-From (Sender) <br>
-To (Recipient) <br>
-Subject <br>
-Text content <br>
-HTML content <br>
-Attachment(-s) <br>

### A frontend
A list of email activities
Search by  <br>
sender, recipient, subject  <br>
Possible statuses:<br>
-Posted <br>
-Sent <br>
-Failed <br>
-A view of single email <br>
-A list of emails for a recipient <br>


# Project Installation & Usage

### Note: This project uses Laravel 9, php 8 and vue 3 <br>

You can simply clone ``mailer-send
`` like below on your git bash <br>

``
https://github.com/ayangzy/mailer-send.git
``

After cloning the project, please run this command on the project directory <br>
``
composer install
``
<br>


### Configure Environment
Make sure you configure the .env environment file with your database details. Use the below commmand to create .env file.

``
cp .env.example .env
``
### set smtp credentials
```
MAIL_MAILER=smtp <br>
MAIL_HOST=smtp.mailtrap.io <br>
MAIL_PORT=2525 <br>
MAIL_USERNAME=xxxxxxxxxx  (Your mailtrap username)<br>
MAIL_PASSWORD=xxxxxxxx (Your mailtrap password)<br>
MAIL_ENCRYPTION=tls <br>
MAIL_FROM_ADDRESS=testuer@gmail.com <br>
MAIL_FROM_NAME="MiniSend"
```

NOTE: Because the app could be used by thousand of clients, i have decided to make youse of queues, so Make sure you change your queue connection to database
``
QUEUE_CONNECTION=database
``
### Generating app key
``
php artisan key:generate
``

### Make Migration
``
php artisan migrate
``

### Serving the application, run the below command
``
php artisan serve
``
### Install NPM packages
Run
``
npm install
``
to install all the npm packages

Run
``
npm run dev
``
to run the dev script defined in the project’s package.json file

Note: To actually see that the email is queued and running on the background, ensure you run this command on your terminal

``
php artisan queue:work
``