<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PS-Assignment</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="flex h-screen">
            <div class="px-4 py-2 bg-gray-200 bg-indigo-600 lg:w-1/5">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-8 h-8 text-white lg:hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <div class="hidden lg:block">
                    <div class="my-2 mb-6">
                        <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
                    </div>
                    <ul>
                        <li class="mb-2 rounded hover:shadow hover:bg-gray-800">
                            <a href="#" class="inline-block w-full h-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-2 -mt-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    
                                    <!-- Inner boxes (represents items) -->
                                    <rect width="7" height="7" x="5" y="5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <rect width="7" height="7" x="15" y="5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <rect width="7" height="7" x="5" y="15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <rect width="7" height="7" x="15" y="15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                  
                                Item
                            </a>
                        </li>
                        <li class="mb-2 bg-gray-800 rounded shadow">
                            <a href="#" class="inline-block w-full h-full px-3 py-2 font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-2 -mt-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <!-- Top bar -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                  </svg>                                  
                                Category
                            </a>
                        </li>
                        <!-- Logout Button -->
                        <li class="mb-2 bg-red-600 rounded hover:bg-red-700 mt-auto absolute bottom-0">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-block w-full h-full px-3 py-2 font-bold text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-2 -mt-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <!-- Icon for "Logout" -->
                                        <!-- You can replace this icon with your logout icon -->
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                                              
                    </ul>
                </div>
            </div>
            {{--content here, also need to make li active--}}
            @yield('content')
        </div>
    </body>

</html>