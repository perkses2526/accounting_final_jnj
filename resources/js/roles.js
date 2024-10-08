$(document).ready(function () {
    // Initialize the data table on page load
    set_table('/get_data_role/');

    // Use event delegation to handle button clicks in the table
    $('#maintb').on('click', '.edit-role-btn', function () {
        const roleId = $(this).data('role-id');
        edit_role(roleId);
    });

    $('#maintb').on('click', '.delete-role-btn', function () {
        const roleId = $(this).data('role-id');
        remove_role(roleId);
    });

    $('#maintb').on('click', '.manage-permission-btn', function () {
        const roleId = $(this).data('role-id');
        managePermissions(roleId);
    });
});

window.managePermissions = async function (roleId) {
    try {
        const res = await ajax(`/view_permission_role/${roleId}`);
        if (res.error) {
            terror('Failed to load role data.');
        } else {
            modalxl('Manage roles permission', res);
            $('#modaltb').DataTable();
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching role data.');
    }
};


window.remove_role = async function (roleId) {
    const confirmation = await question("Remove role?", "Are you sure you want to remove this role?");
    if (!confirmation) return;

    try {
        const res = await ajax(`/role/${roleId}`, '', 'DELETE');
        if (res.success) {
            tsuccess('Role has been removed successfully.');
            set_table('/get_data_role/');
        } else {
            const message = res && typeof res === 'object' && res.message ? res.message : 'Unknown error occurred.';
            terror('Error deleting role: ' + message);
        }
    } catch (error) {
        console.error('Error in remove_role:', error);
        terror('An unexpected error occurred.');
    }
};

window.store_role = async function (btn) {
    const confirmation = await question("Add role", "Are you sure you want to add this role?");
    if (!confirmation) return;

    const form = $(btn).closest('#modal').find('form')[0];
    const formData = new FormData(form);

    const res = await ajax('/store_role/', formData, 'POST');

    if (res.success) {
        tsuccess('Role added successfully');
        closeModal();
        set_table('/get_data_role/');
    } else {
        terror(res.message);
    }
};

window.addrole = async function () {
    const res = await ajax('/create_role/');
    modalmd('Add new role', res, "store_role(this)");
};
