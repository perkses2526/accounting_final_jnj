<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            Manage Accounting Data
        </x-slot>
        <!-- Create Role Button -->
        <table class="table table-striped table-bordered" id="maintb">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        @vite(['resources/js/accounting_raw_data.js'])
    @endsection
</x-app-layout>
