
$(document).ready(function () {
    set_table('/get_data_role/');
});

window.remove_role = async function (btn) {
    const confirmation = await question("Remove role?", "Are you sure you want to remove this role?");
    if (!confirmation) return;

    const role_id = $(btn).closest('tr').find('td:eq(0)').text();

    try {
        const res = await ajax(`/role/${role_id}`, '', 'DELETE');

        // Check for success in response
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

    var form = $(btn).closest('#modal').find('form')[0];

    var formData = new FormData(form);

    var res = await ajax('/store_role/', formData, 'POST');

    if (res.success) {
        tsuccess('Role added successfully');
        closeModal();
        set_table('/get_data_role/');
    } else {
        terror(res.message);
    }
};

window.addrole = async function () {
    var res = await ajax('/create_role/');
    modalmd('Add new role', res, "store_role(this)");
}
