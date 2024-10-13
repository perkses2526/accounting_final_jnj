<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            Manage Users
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
