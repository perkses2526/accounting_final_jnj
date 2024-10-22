let refreshInterval;

$(document).ready(function () {
    set_table('/get_data_tickets/');
    // startAutoRefresh();

    $('#TransactionListBtn').click(function (e) {
        e.preventDefault();
        transactionList($(this));
    });

    $('#createTicketsBtn').click(function (e) {
        e.preventDefault();
        createTickets($(this));
    });

    $('#MultipleUpdatesBtn').click(function (e) {
        e.preventDefault();
        multipleUpdates($(this));
    });

    $('#maintb').on('click', '.view-ticket-details', function () {
        const ticketId = $(this).data('ticket-id');
        show_ticket(ticketId);
    });

    $('#closeModal2, #closeModal').click(function (e) {
        e.preventDefault();
        startAutoRefresh();
    });

    // Stop auto-refresh when the user starts typing in the search field
    $('#maintb thead input[type="text"]').on('focus input', function () {
        stopAutoRefresh();
    });

    // Handle blur event to conditionally restart auto-refresh when leaving the search fields
    $('#maintb thead input[type="text"]').on('blur', function () {
        // Check if all search fields are empty
        let allFieldsEmpty = true;
        $('#maintb thead input[type="text"]').each(function () {
            if ($(this).val().trim() !== '') {
                allFieldsEmpty = false;
                return false; // Exit the loop if any input is not empty
            }
        });

        // Restart auto-refresh only if all search fields are empty
        if (allFieldsEmpty) {
            startAutoRefresh();
        }
    });


    setTimeout(() => {
        const currentUrl = window.location.href;
        const statusMatch = currentUrl.match(/approval_list\/(\w+)/);
        const status = statusMatch ? statusMatch[1] : null; // This will be 'pending' or whatever status is in the URL

        console.log(status);

        // Check if the status is found and set it as the value of the input
        if (status) {
            const statusInput = $('#maintb input[placeholder="Search Status"]');

            // Set the value
            statusInput.val(status).trigger("change");

            // Trigger the input event to simulate user typing

        }
    }, 1000);


});

// Function to start the auto-refresh interval
function startAutoRefresh() {
    refreshInterval = setInterval(() => {
        set_table('/get_data_tickets/');
    }, 30000);
}

// Function to stop the auto-refresh interval
function stopAutoRefresh() {
    clearInterval(refreshInterval);
}

window.multipleUpdates = async function (btn) {
    stopAutoRefresh();
    set_table('/multiple_ticket_updates/');
    setTimeout(() => {
        $('#maintb').find('tbody tr').each(function () {
            // Add checkbox to the first column of each row
            $(this).find('td:first').prepend(`
                <div class="flex items-center">
                    <input type="checkbox" class="ticket-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
            `);
        });
    }, 500);

    // Update the button content to show Submit and Cancel options
    $(btn).closest('div').html(`
    <div class="flex items-center space-x-2 update_div">
        <select id="statusSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            <option value="" disabled selected>Select status</option>
            <option value="Approved">Approved</option>
            <option value="Denied">Denied</option>
        </select>
        <textarea id="reasonTextarea" name="reason_if_denied" row="10" class="hidden mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300" placeholder="Reason for denial (required if status is Denied)"></textarea>
        <button id="SubmitUpdatesBtn" class="btn btn-success">Submit</button>
        <button id="CancelUpdatesBtn" class="btn btn-danger">Cancel</button>
    </div>
`);

    // Show/hide the reason textarea based on the selected status
    $('#statusSelect').change(function () {
        if ($(this).val() === 'Denied') {
            $('#reasonTextarea').removeClass('hidden');
        } else {
            $('#reasonTextarea').addClass('hidden').val(''); // Clear the textarea if it was shown
        }
    });


    $('#SubmitUpdatesBtn').click(async function () {
        let selectedTickets = [];
        $('#maintb').find('tbody tr').each(function () {
            // Check if the checkbox is checked
            const isChecked = $(this).find('input.ticket-checkbox').is(':checked');
            // Get the ticket ID from the third <td> (index 1) which is the second column (assumed to be the ID column)
            const ticketId = $(this).find('td:nth-child(1)').text().trim(); // This gets the ticket ID from the first <td>

            // If the checkbox is checked and we have a valid ticket ID
            if (isChecked && ticketId) {
                selectedTickets.push(ticketId); // Push the ticket ID into the array
            }
        });

        console.log("Selected Tickets: ", selectedTickets); // Debugging line

        const selectedStatus = $('#statusSelect').val();
        const reasonIfDenied = $('#reasonTextarea').val(); // Get the reason if "Denied" is selected

        if (selectedTickets.length > 0) {
            const confirmation = await question("Update multiple ticket?", "Are you sure you want to update multiple tickets? This cannot be undone.");
            if (!confirmation) return;
            $.ajax({
                url: '/update_tickets_status',
                method: 'POST',
                data: {
                    ticket_ids: selectedTickets,
                    status: selectedStatus,
                    reason_if_denied: selectedStatus === 'Denied' ? reasonIfDenied : null, // Include reason only if Denied
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function (response) {
                    tsuccess('Tickets updated successfully!');
                    set_table('/get_data_tickets/'); // Refresh the table
                    $('#CancelUpdatesBtn').click();
                },
                error: function (error) {
                    console.error('Error updating tickets:', error);
                    terror('An error occurred while updating the tickets.');
                }
            });
        } else {
            twarning('Please select at least one ticket to update.');
        }
    });


    // Handle the cancel button click
    $('#CancelUpdatesBtn').click(function () {
        set_table('/get_data_tickets/'); // Refresh the table to its original state
        $(this).closest('div.update_div').html(`
            <button id="MultipleUpdatesBtn" class="bg-blue-500 text-white px-4 py-2 rounded me-2">
                Multiple Updates
            </button>
        `);

        // Re-bind the click event for the Multiple Updates button
        $('#MultipleUpdatesBtn').click(function (e) {
            e.preventDefault();
            multipleUpdates($(this));
        });

        // Restart the auto-refresh after canceling the multiple update
        startAutoRefresh();
    });
};



window.update_ticket = async function (btn, event) {
    const confirmation = await question("Update ticket?", "Are you sure you want to update this ticket? This cannot be undone.");
    if (!confirmation) return;

    var form = $(btn).closest('#modal').find('form')[0];
    var formDataSerialized = $(form).serialize(); // Serialize form data
    var ticketId = $(form).find('input:hidden[name="id"]').val();

    var res = await ajax(`/update_ticket/${ticketId}`, formDataSerialized, 'PUT');
    if (res.status === 'success') {
        set_table('/get_data_tickets/');
        tsuccess(res.message); // This will now show "Ticket updated and email queued for sending"
        closeModal();
    } else {
        terror();
    }
}



window.show_ticket = async function (ticketId) {
    stopAutoRefresh();
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
