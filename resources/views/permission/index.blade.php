<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Permission') }}
            </h2>
        </x-slot>
        <!-- Create Role Button -->
        <div class="flex justify-end items-center mb-4">
            <button id="createPermissionButton" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="addPermission(this)">
                Create Permission
            </button>
        </div>

        <table class="table table-striped table-bordered" id="maintb">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        @vite(['resources/js/permission.js'])
    @endsection
</x-app-layout>
