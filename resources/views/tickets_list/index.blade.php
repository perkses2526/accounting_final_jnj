<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Approvals') }}
            </h2>
        </x-slot>
        <!-- Create Role Button -->
        <div class="flex justify-end items-center mb-4">
            <div class="update_div">
                <button id="MultipleUpdatesBtn" class="bg-blue-500 text-white px-4 py-2 rounded me-2">
                    Multiple updates
                </button>
            </div>
            <button id="TransactionListBtn" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Transaction list
            </button>
            {{-- <button id="createTicketsBtn" class="bg-blue-500 text-white px-4 py-2 rounded ms-2">
                Create Tickets
            </button> --}}
        </div>

        <table class="table table-striped table-bordered" id="maintb">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        @vite(['resources/js/approvals.js'])
    @endsection
</x-app-layout>
