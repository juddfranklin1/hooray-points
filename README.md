# Hooray! Points!

## It is time to get excited to do good things!

![#gamifyallthethings](https://i.imgflip.com/4oeff0.jpg)

I am creating a points system for helping me and my family get and stay motivated. This is the app for that system.

## background

Staying motivated is a non-trivial task. I have 2 kids. They don't want to do anything that isn't thrilling. They don't want to eat anything that isn't sugary or salty. As a human, I am at the mercy of these desires. Life is full of seemingly arbitrary complexities that interfere with cause and effect. 30 years ago, a "personal shopper" was a role afforded only to the wealthiest and most elite people. Now, in the age of COVID-19 and Instacart, the personal shopper is an essential worker. Last year, my kids could go to school and learn from a teacher in a classroom the way they always had. Now, my kids "raise their hands" via zoom, and have to mute themselves, and have to navigate to breakout rooms. In short, contemporary life is a giant cascade of choices and acts that complicate everyday actions that we took for granted even 12 months ago. How do we keep ourselves goal-oriented in this hyper-intellectualized world?

Let's all say it together: Hooray!

With Hooray, you can:
- Define actions that you want to do (or avoid);
- Define rewards (incentives) that you can earn by doing what you need to do and avoiding what you need to avoid
- Download PDF "Vouchers" related to rewards claimed (fun for special activities)
- Set goals *
- Track progress *
- Be part of a team doing the same thing *

\* indicates that a feature is incompletely implemented.

## details

* Laravel 8
* VueJS 2
* Vuex 3
* Vue Router
* [TailwindCSS](https://github.com/tailwindlabs/tailwindcss)
* [VueTailwind](https://github.com/alfonsobries/vue-tailwind) (component library)
* [FullCalendar.io](https://github.com/fullcalendar/fullcalendar-vue) (Calendar vue component)
* [Storybook.js](https://storybook.js.org/docs/vue/get-started/introduction) (component Styleguide Builder)
* [laravel-dompdf package](https://github.com/barryvdh/laravel-dompdf)

This is currently a small-scale Laravel project, but it is growing more sophisticated with each commit. The Models are currently only Users, Actions (good or bad things a person can do), Goals, and Rewards (things a person can get for their points), with Pivot Models to give some rich relationships between Users and Actions and Rewards.

### requirements:
If you want to install it yourself, you can go ahead and run the good old Laravel setup process:

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
6. `php artisan migrate` or if you want faker data (and currently some from my family), please run `php artisan migrate --seed`

### To Do:
- Set up goals
    - Progress-based (saving up points)
    - Reward-based (Trigger a reward based upon point total achieved)
    - Time-based (See if a point total can be reached by a given date)
- "Plans" model - complex collections of actions with a cumulative point value
    - View for tracking progress towards completion of plans.
- "Teams" model - Ability to be part of a group of users with inter-related roles
- Improve Factories and Seeders to enable more realistic starter data
- Improve UX
    - At the moment, it is too plain; needs to be more fun
- Flesh out the CRUD capabilities for Actions, Users, Rewards
    - Jury is out on soft-deleting actions and rewards
- Set up roles and privileges
    - 2 roles to start:
        - Parent - can CRUD Actions and Rewards; can attribute actions to Users
        - Child
- Improved use of Action assignment and Reward assignment (so that people can see their histories, keep special track of actions and rewards tailored specifically to them, and can track progress toward goals)
- Improved history logging - Flesh out the calendar display of actions taken, rewards redeemed, and goals set in time
- Make this a phone-ready SPA so that I can keep track of and update point totals from anywhere
- Implement Unit and Feature testing

### Credits
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
