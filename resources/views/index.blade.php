<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hooray! A Points System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen dark:bg-gray-900 sm:items-center">
            <div class="min-w-full mx-auto mb-2xl">
                <div id="app" class="pb-32">
                    <app
                        :users-prop="{{ $users }}"
                        :actions-prop="{{ $actions }}"
                        :rewards-prop="{{ $rewards }}"
                        :user-actions-prop="{{ $userActions }}"
                        :user-goals-prop="{{ $userGoals }}"
                        :user-rewards-prop="{{ $userRewards }}"
                    ></app>
                </div>

                <footer class="bg-blue-100 absolute bottom-0 w-full py-6 h-32 flex flex-col align-middle justify-items-center">
                    <div class="mx-auto max-w-6xl flex justify-center mt-4 sm:items-center sm:justify-between">
                        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                            &copy; {{ \Carbon\Carbon::now()->year }} The Yay! Corporation
                        </div>
                        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
