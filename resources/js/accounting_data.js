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

});

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

    // $('#company_code, #division_code, #department_code');
    company_code = $('#company_code').val();
    division_code = $('#division_code').val();
    department_code = $('#department_code').val();
    const account_data = await ajax(`/get_account_data/${company_code}/${division_code}/${department_code}`);
}