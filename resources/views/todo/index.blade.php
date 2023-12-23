<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif


        <div class="grow ">

            {{ view('todo.create') }}


            @auth
                <div class="mx-auto w-full sm:max-w-md mt-6">
                    <ul>

                        @foreach ($todos as $todo)
                            <li class="dark:text-gray-400 mb-5">

                                Status: {{ $todos->status }} <br>
                                Task: {{ $todos->todo }}

                                <div class="flex gap-2">
                                    <a href="{{ route('todo.edit', ['todo' => $todo]) }}"
                                        class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>

                                    <form method="post" action="{{ route('todo.status', ['todo' => $todo]) }}">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="todo_status"
                                            value="{{ $todos->status == 'pending' ? 'completed' : 'pending' }}">
                                        <button type="submit"
                                            class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Make
                                            as {{ $todos->status == 'pending' ? 'completed' : 'pending' }}</button>
                                    </form>

                                    <form method="post" action="{{ route('todo.destroy', ['todo' => $todo]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="mt-3 inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-300 uppercase tracking-widest hover:bg-red-500 dark:hover:bg-red-500 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">delete</button>
                                    </form>



                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            @endauth

        </div>





    </div>
</body>

</html>
