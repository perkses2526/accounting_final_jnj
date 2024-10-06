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
    <div class="flex min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="flex flex-col flex-1">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow flex justify-between items-center p-4">
                    <div>
                        {{ $header }}
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
            <main class="flex-1 p-6">
                <div class="pt-1 pb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                        @yield('content')
                        {{-- {{ $slot ?? '' }} <!-- Use this to safely render the slot if it's not defined --> --}}
                    </div>
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

<div id="modalBackground" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50"></div>

<div id="modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div id="modalSize" class="bg-white rounded-lg shadow-lg relative">
        <!-- Modal Header -->
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold" id="modalTitle"></h2>
            <button id="closeModal" class="absolute top-5 right-5 text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-4" id="modalBody"></div>

        <!-- Modal Footer (Buttons) -->
        <div class="p-4 border-t flex justify-end space-x-3">
            <div id="btn_submit"></div>
            <button id="closeModal2" class="btn btn-warning">Close</button>
        </div>
    </div>
</div>


</html>
