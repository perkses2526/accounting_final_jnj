$(document).ready(function () {
    setselect($('#company_code, #division_code, #department_code'));

    $('#company_code').change(function (e) {
        if ($(this).val() === "") {
            twarning(`Please select a company`);
            return;
        }
        setdiv($(this));
    });

    $('#division_code').change(function (e) {
        if ($(this).val() === "") {
            twarning(`Please select a division`);
            return;
        }
        setdept($(this));
    });

    $('#department_code').change(function (e) {
        if ($(this).val() === "") {
            twarning(`Please select a department`);
            return;
        }
        setaccount_data($(this));
    });

    // Tab click event listeners
    $('#balanceSheetTab').on('click', () => handleTabClick('balance-sheet'));
    $('#incomeStatementTab').on('click', () => handleTabClick('income-statement'));
    $('#trialBalanceTab').on('click', () => handleTabClick('trial-balance'));
});

// Function to handle tab switching
function handleTabClick(tabId) {
    // Hide all tab contents
    $('.tab-content').addClass('hidden');

    // Show the selected tab content
    $(`#${tabId}`).removeClass('hidden');

    // Update tab button styles
    $('.tab-button').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700');
    $(`#${tabId}Tab`).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white');
}

window.setdiv = async function (select) {
    const div_data = await ajax(`/get_div_data/${$(select).val()}`);
    setOption('#division_code', div_data);
    console.log(div_data)
}

window.setdept = async function (select) {
    const dept_data = await ajax(`/get_dept_data/${$(select).val()}`);
    setOption('#department_code', dept_data);
    console.log(dept_data)
}
window.setaccount_data = async function (select) {
    const company_code = $('#company_code').val();
    const division_code = $('#division_code').val();
    const department_code = $('#department_code').val();
    const account_data = await ajax(`/get_account_data/${company_code}/${division_code}/${department_code}`);

    // Clear existing data before adding new content
    $('#assets-data').empty();
    $('#liabilities-data').empty();
    $('#equity-data').empty();
    $('#income-statement-data').empty();
    $('#trial-balance-data').empty();

    // Separate data into Balance Sheet, Income Statement, and Trial Balance categories
    account_data.forEach(item => {
        // Balance Sheet rows - segregate into Assets, Liabilities, and Equity
        let balanceRow = `<tr>
            <td class="border px-4 py-2">${item.charts_of_accounts}</td>
            <td class="border px-4 py-2">${item.debit ? item.debit : '-'}</td>
            <td class="border px-4 py-2">${item.credit ? item.credit : '-'}</td>
        </tr>`;

        if (item.class === 'asset') {
            $('#assets-data').append(balanceRow);
        } else if (item.class === 'liability') {
            $('#liabilities-data').append(balanceRow);
        } else if (item.class === 'equity') {
            $('#equity-data').append(balanceRow);
        }

        // Income Statement rows - showing only revenue accounts or earned amounts
        if (item.class === 'revenue' || item.credit > 0) {
            const incomeRow = `<tr>
                <td class="border px-4 py-2">${item.charts_of_accounts}</td>
                <td class="border px-4 py-2">${item.credit ? item.credit : '-'}</td>
            </tr>`;
            $('#income-statement-data').append(incomeRow);
        }

        // Trial Balance rows (Include all accounts)
        const trialRow = `<tr>
            <td class="border px-4 py-2">${item.charts_of_accounts}</td>
            <td class="border px-4 py-2">${item.debit ? item.debit : '-'}</td>
            <td class="border px-4 py-2">${item.credit ? item.credit : '-'}</td>
        </tr>`;
        $('#trial-balance-data').append(trialRow);
    });
}
