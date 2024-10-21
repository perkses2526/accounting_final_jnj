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

        <div class="container mx-auto p-6">
            <!-- Tab Bar -->
            <div class="flex justify-center mb-4">
                <button id="balanceSheetTab"
                    class="tab-button px-4 py-2 border bg-blue-500 text-white hover:bg-blue-700">Balance Sheet</button>
                <button id="incomeStatementTab"
                    class="tab-button px-4 py-2 border bg-gray-200 text-gray-700 hover:bg-gray-400">Income
                    Statement</button>
                <button id="trialBalanceTab"
                    class="tab-button px-4 py-2 border bg-gray-200 text-gray-700 hover:bg-gray-400">Trial Balance</button>
            </div>

            <!-- Balance Sheet Tab Content -->
            <!-- Balance Sheet Tab Content -->
            <div id="balance-sheet" class="tab-content mt-4">
                <h2 class="text-xl font-semibold mb-2">Balance Sheet</h2>

                <!-- Assets Section -->
                <h3 class="text-lg font-semibold mt-4">Assets</h3>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Account</th>
                            <th class="border border-gray-200 px-4 py-2">Debit</th>
                            <th class="border border-gray-200 px-4 py-2">Credit</th>
                        </tr>
                    </thead>
                    <tbody id="assets-data">
                        <tr>
                            <td colspan="3" class="text-center">Select data first</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Liabilities Section -->
                <h3 class="text-lg font-semibold mt-4">Liabilities</h3>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Account</th>
                            <th class="border border-gray-200 px-4 py-2">Debit</th>
                            <th class="border border-gray-200 px-4 py-2">Credit</th>
                        </tr>
                    </thead>
                    <tbody id="liabilities-data">
                        <tr>
                            <td colspan="3" class="text-center">Select data first</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Equity Section -->
                <h3 class="text-lg font-semibold mt-4">Equity</h3>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Account</th>
                            <th class="border border-gray-200 px-4 py-2">Debit</th>
                            <th class="border border-gray-200 px-4 py-2">Credit</th>
                        </tr>
                    </thead>
                    <tbody id="equity-data">
                        <tr>
                            <td colspan="3" class="text-center">Select data first</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <!-- Income Statement Tab Content -->
            <div id="income-statement" class="tab-content mt-4 hidden">
                <h2 class="text-xl font-semibold mb-2">Income Statement</h2>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Revenue</th>
                            <th class="border border-gray-200 px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="income-statement-data">
                        <tr>
                            <td colspan="2" class="text-center">Select data first</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <!-- Trial Balance Tab Content -->
            <div id="trial-balance" class="tab-content mt-4 hidden">
                <h2 class="text-xl font-semibold mb-2">Trial Balance</h2>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Account</th>
                            <th class="border border-gray-200 px-4 py-2">Debit</th>
                            <th class="border border-gray-200 px-4 py-2">Credit</th>
                        </tr>
                    </thead>
                    <tbody id="trial-balance-data">
                        <tr>
                            <td colspan="3" class="text-center">Select data first</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @vite(['resources/js/accounting_data.js'])
        @endsection
</x-app-layout>
