<x-app-layout>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @section('content')
        <x-slot name="header">
            {{ __('Accounting Listing') }}
        </x-slot>
        <!-- Create Role Button -->
        <div class="flex justify-center items-center mb-4">
            <div class="form-group m-2">
                <label for="company_code">Company Code:</label>
                <select name="company_code" id="company_code">
                    <option value="">Select Company</option>
                    <option value="COMP_ABC">COMP_ABC</option>
                    <option value="COMP_XYZ">COMP_XYZ</option>
                    <option value="COMP_BCD">COMP_BCD</option>
                </select>
            </div>

            <div class="form-group m-2">
                <label for="division_code">Division Code:</label>
                <select name="division_code" id="division_code">
                    <option value="" disabled select>Select Division</option>
                </select>
            </div>

            <div class="form-group m-2">
                <label for="department_code">Department Code:</label>
                <select name="department_code" id="department_code">
                    <option value="" disabled select>Select Department</option>
                </select>
            </div>
        </div>

        <table class="table table-striped table-bordered" id="maintb">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        @vite(['resources/js/accounting_data.js'])
    @endsection
</x-app-layout>
