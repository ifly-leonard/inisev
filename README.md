# Inisev Task 
## Done by Leonard Selvaraja 

The app is created with SOLID principles in mind along with the brief that has been provided. The app uses Models, Validations, Migrations, Factories, Seeders, Jobs, Queues, Mailables, Markdown, Events and Listeners. All methods of all classes are well-commented with PHPDoc format.

To setup the app, first clone it and then run
    `composer install`
    `cp .env.example .env`
    `php artisan key:generate`
    `php artisan migrate --seed`

The app is included with seeders that will generate Faker data into the database.

### As per the brief, the goals were:

1. In which users can subscribe to a website (there can be multiple websites in the system). ☑️
2. Whenever a new post is published on a particular website, all it's subscribers shall receive 
an email with the post title and description in it. (no authentication of any kind is required) ☑️

### Other requirements:

- Use PHP 7.* (i.e. use Laravel 8 as Laravel 9 requires PHP 8.0) ☑️
- Write migrations for the required tables. ☑️
- Endpoint to create a "post" for a "particular website". ☑️
- Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it. ☑️
- Use of command to send email to the subscribers. ☑️
- Use of queues to schedule sending in background. ☑️
- No duplicate stories should get sent to subscribers. ☑️
- Deploy the code on a public github repository. ☑️


![image](https://user-images.githubusercontent.com/29737466/161173879-d48f158f-76eb-423e-9655-bce20d55b2b9.png)
