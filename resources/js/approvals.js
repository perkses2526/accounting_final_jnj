$(document).ready(function () {
    set_table('/get_data_tickets/');
    setInterval(() => {
        set_table('/get_data_tickets/');
    }, 30000);
    $('#TransactionListBtn').click(function (e) {
        transactionList($(this));
    });

    $('#createTicketsBtn').click(function (e) {
        createTickets($(this));
    });

    $('#maintb').on('click', '.view-ticket-details', function () {
        const ticketId = $(this).data('ticket-id');
        show_ticket(ticketId);
    });
});

window.update_ticket = async function (btn, event) {
    const confirmation = await question("Update ticket?", "Are you sure you want to update this ticket? This cannot be undone.");
    if (!confirmation) return;

    var form = $(btn).closest('#modal').find('form')[0];
    var formDataSerialized = $(form).serialize(); // Serialize form data
    var ticketId = $(form).find('input:hidden[name="id"]').val();

    var res = await ajax(`/update_ticket/${ticketId}`, formDataSerialized, 'PUT');
    if (res.status === 'success') {
        set_table('/get_data_tickets/');
        tsuccess(`Ticket updated successfully`);
        closeModal();
    } else {
        terror();
    }
}


window.show_ticket = async function (ticketId) {
    try {
        const res = await ajax(`/show_ticket/${ticketId}`);
        if (res.error) {
            terror('Failed to load tickets data.');
        } else {
            modalxl('Create tickets for approval', res);
            $('#reason_if_denied_div').hide();
            setselect($('#status'));
            $('#status').change(function (e) {
                var val = $(this).val();
                if (val === 'Approved') {
                    $('#reason_if_denied_div').hide();
                } else if (val === 'Denied') {
                    twarning(`Please add the reason.`);
                    $('#reason_if_denied_div').show();
                }
                $('#btn_submit').html(`<button class="btn btn-success" type="button" onclick="update_ticket(this)">Submit</button>`);
            });
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching tickets data.');
    }
}


window.store_tickets = async function (btn) {
    const confirmation = await question("Add tickets", "Are you sure you want to add this ticket?");
    if (!confirmation) return;

    const form = $(btn).closest('#modal').find('form')[0];
    const formData = new FormData(form);

    const res = await ajax('/store_tickets/', formData, 'POST');

    if (res.success) {
        tsuccess('Tickets added successfully');
        closeModal();
        set_table('/get_data_tickets/');
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
