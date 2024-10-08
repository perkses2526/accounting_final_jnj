$(document).ready(function () {
    // Initialize the data table on page load
    set_table('/get_data_permission/');
    $('#maintb').on('click', '.delete-permission-btn', function () {
        const permissionId = $(this).data('permission-id');
        remove_permission(permissionId);
    });
});

window.remove_permission = async function (permissionId) {
    const confirmation = await question("Remove permission?", "Are you sure you want to remove this permission?");
    if (!confirmation) return;

    try {
        const res = await ajax(`/permission/${permissionId}`, '', 'DELETE');
        if (res.success) {
            tsuccess('permission has been removed successfully.');
            set_table('/get_data_permission/');
        } else {
            const message = res && typeof res === 'object' && res.message ? res.message : 'Unknown error occurred.';
            terror('Error deleting permission: ' + message);
        }
    } catch (error) {
        console.error('Error in remove_permission:', error);
        terror('An unexpected error occurred.');
    }
};

window.store_permission = async function (btn) {
    const confirmation = await question("Add permission", "Are you sure you want to add this permission?");
    if (!confirmation) return;

    const form = $(btn).closest('#modal').find('form')[0];
    const formData = new FormData(form);

    const res = await ajax('/store_permission/', formData, 'POST');

    if (res.success) {
        tsuccess('Permission added successfully');
        closeModal();
        set_table('/get_data_permission/');
    } else {
        terror(res.message);
    }
};

window.addPermission = async function () {
    const res = await ajax('/create_permission/');
    modalmd('Add new permission', res, "store_permission(this)");
};
