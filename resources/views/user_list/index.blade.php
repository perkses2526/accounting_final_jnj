<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Users') }}
            </h2>
        </x-slot>
        <!-- Create Role Button -->
        <table class="table table-striped table-bordered" id="maintb">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        @vite(['resources/js/userlist.js'])
    @endsection
</x-app-layout>
