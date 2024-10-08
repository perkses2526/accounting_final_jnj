$(document).ready(function () {
    $('#TransactionListBtn').click(function (e) {
        transactionList($(this));
    });

    $('#createTicketsBtn').click(function (e) {
        createTickets($(this));
    });
});

window.store_tickets = async function (btn) {
    const confirmation = await question("Add tickets", "Are you sure you want to add this ticket?");
    if (!confirmation) return;

    const form = $(btn).closest('#modal').find('form')[0];
    const formData = new FormData(form);

    const res = await ajax('/store_tickets/', formData, 'POST');

    if (res.success) {
        tsuccess('Tickets added successfully');
        closeModal();
        // set_table('/get_data_role/');
    } else {
        terror(res.message);
    }
}

window.createTickets = async function () {
    try {
        const res = await ajax(`/create_tickets/`);
        if (res.error) {
            terror('Failed to load tickets data.');
        } else {
            modalxl('Create tickets for approval', res, "store_tickets(this)");
            const trans_list = await ajax(`/get_transaction_list_data/`);
            setOption('#transaction_id', trans_list);
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching tickets data.');
    }
}

window.transactionList = async function () {
    try {
        const res = await ajax(`/transactionList/`);
        if (res.error) {
            terror('Failed to load transaction data.');
        } else {
            modalxl('Transaction list', res);

        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching transaction data.');
    }
}

window.transactionList = async function () {
    try {
        const res = await ajax(`/transactionList/`);
        if (res.error) {
            terror('Failed to load transaction data.');
        } else {
            modalxl('Transaction list', res);
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching transaction data.');
    }
}
