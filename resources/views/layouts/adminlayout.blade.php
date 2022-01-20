@if (auth()->user()->admin === 1)
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <title>Web for URSB Student Organization</title>
</head>

<body>
    <div class="bg-gray-100 grid grid-row-col">
        <div class="min-h-screen flex flex-row bg-gray-100">
            <div class="flex flex-col w-56 bg-white rounded-r-3xl overflow-hidden">
                <div class="flex items-center justify-center h-20 shadow-md">
                    <h1 class="text-3xl uppercase text-indigo-500"><a href="{{ route('posts') }}"><img
                                class="w-8 h-12" src="{{ asset('img/urslogo.png') }}" alt="urslogo"></a></h1>
                </div>
                <ul class="flex flex-col py-4">
                    <li>
                        <a href="{{ route('admin.index') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 ml-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <span class="text-sm font-medium">Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-sm font-medium">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.organizations') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 ml-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium">Organizations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium">Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 ml-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.files') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 ml-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">Files</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.registrations') }}"
                            class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 ml-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">Registrations</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col w-full bg-white rounded-2xl overflow-hidden m-10">
                @yield('content')
            </div>

        </div>
    </div>
</body>
@endif
