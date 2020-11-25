# Hooray! Points!

## It is time to get excited to do good things!

Using the power of Laravel, Vuejs, TailwindCSS, and associated technologies, I am creating a system for helping my family get motivated to do things that they otherwise would consider tedious, difficult, or otherwise dragging on their already depleted energies. It is, after all, the year 2020.

## details

This is a normal, boring old Laravel project. Quite simple at the moment. The logic is only Users, Actions (good or bad things a person can do), and Rewards (things a person can get for their points).

If you want to install it yourself, you can go ahead and run the normal boring old Laravel setup process:

### requirements:
- Composer
- Node and npm (or yarn)
- A local server environment (I use Laravel Valet, but you can use homestead, vagrant, *AMP, good old php artisan serve, etc.)
- PHP 7.3
    - BCMath PHP Extension
    - Ctype PHP Extension
    - Fileinfo PHP Extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
- Relational Db server (I use PostgreSQL locally)

Steps:
1. clone
In a terminal window run
2. `composer install`
3. `npm install` (or `yarn install`)
Then
4. create local database
5. create an `.env` file and update it with your desired db credentials
Back in a terminal, run
6. `php artisan migrate` or if you want faker data (and potentially some from my family), please run `php artisan migrate --seed`

### To do:
- Improve UX
    - considering using a Vue Component library
- Flesh out the CRUD capabilities for Actions, Users, Rewards
- Integration of User permissions and Laravel Sanctum authentication
    - 2 roles: Parent, Child
- Improved use of Action assignment and Reward assignment (so that people can see the actions that are tailored to them)
- Improved history logging - a calendar display of actions taken and rewards redeemed
- Make this a phone-ready SPA so that I can keep track of and update point totals from anywhere
- Create ability to set goals and track progress towards those goals.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
