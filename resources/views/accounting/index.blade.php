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
            <div class="flex justify-center">
                <!-- Tab Links -->
                <div class="flex space-x-4">
                    <button id="balanceSheetTab"
                        class="tab-button text-gray-600 hover:text-blue-500 py-2 px-4 focus:outline-none">Balance
                        Sheet</button>
                    <button id="incomeStatementTab"
                        class="tab-button text-gray-600 hover:text-blue-500 py-2 px-4 focus:outline-none">Income
                        Statement</button>
                    <button id="trialBalanceTab"
                        class="tab-button text-gray-600 hover:text-blue-500 py-2 px-4 focus:outline-none">Trial
                        Balance</button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="mt-4">
                <table class="table table-striped table-bordered w-full" id="maintb">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Account</th>
                            <th class="px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Content will be populated here based on selected tab -->
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            // JavaScript to handle tab switching and content population
            const balanceSheetData = [{
                    account: 'Assets',
                    amount: '$50,000'
                },
                {
                    account: 'Liabilities',
                    amount: '$20,000'
                },
                {
                    account: 'Equity',
                    amount: '$30,000'
                }
            ];

            const incomeStatementData = [{
                    account: 'Revenue',
                    amount: '$100,000'
                },
                {
                    account: 'Expenses',
                    amount: '$70,000'
                },
                {
                    account: 'Net Income',
                    amount: '$30,000'
                }
            ];

            const trialBalanceData = [{
                    account: 'Cash',
                    amount: '$25,000'
                },
                {
                    account: 'Accounts Receivable',
                    amount: '$15,000'
                },
                {
                    account: 'Accounts Payable',
                    amount: '$10,000'
                },
                {
                    account: 'Equity',
                    amount: '$30,000'
                }
            ];

            const tableBody = document.getElementById('tableBody');

            // Function to populate the table
            function populateTable(data) {
                tableBody.innerHTML = ''; // Clear existing rows
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML =
                        `<td class="border px-4 py-2">${item.account}</td><td class="border px-4 py-2">${item.amount}</td>`;
                    tableBody.appendChild(row);
                });
            }

            // Function to handle tab clicks
            function handleTabClick(tab) {
                if (tab === 'balanceSheet') {
                    populateTable(balanceSheetData);
                } else if (tab === 'incomeStatement') {
                    populateTable(incomeStatementData);
                } else if (tab === 'trialBalance') {
                    populateTable(trialBalanceData);
                }
            }

            // Event listeners for tab buttons
            document.getElementById('balanceSheetTab').addEventListener('click', () => handleTabClick('balanceSheet'));
            document.getElementById('incomeStatementTab').addEventListener('click', () => handleTabClick('incomeStatement'));
            document.getElementById('trialBalanceTab').addEventListener('click', () => handleTabClick('trialBalance'));

            // Initialize with the balance sheet data
            populateTable(balanceSheetData);
        </script>


        @vite(['resources/js/accounting_data.js'])
    @endsection
</x-app-layout>
