<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Add these inside the <head> tag of your layout -->
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div
        class="flex items-center justify-between px-4 py-2 lg:hidden bg-white border-b dark:bg-gray-900 dark:border-gray-700">
        <button id="toggleSidebar"
            class="p-2 text-gray-600 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
        <span class="text-lg font-semibold">JnJ</span>
    </div>

    <div class="flex min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="flex flex-col flex-1 min-h-screen overflow-hidden">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow flex justify-between items-center p-4">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ ucwords($header) }}
                        </h2>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit">
                                <span class="mx-2 font-medium">Logout</span>
                            </button>
                        </form>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-100 dark:bg-gray-900">
                <div class="bg-white shadow-sm sm:rounded-lg p-5 m-3 h-full overflow-y-auto max-h-[calc(92vh-4rem)]">
                    @yield('content')
                </div>
            </main>

            @stack('scripts')
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Modal Background -->
<div id="modalBackground" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50"></div>

<div id="modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div id="modalSize" class="bg-white rounded-lg shadow-lg relative">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold" id="modalTitle"></h2>
                    <button id="closeModal"
                        class="absolute top-5 right-5 text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="p-4" id="modalBody">
                    <!-- Content goes here -->
                </div>
                <div class="flex justify-end p-4 border-t space-x-3">
                    <div id="btn_submit"></div>
                    <button id="closeModal2" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>



</html>
