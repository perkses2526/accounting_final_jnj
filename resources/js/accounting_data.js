$(document).ready(function () {
    setselect($('#company_code, #division_code, #department_code'));

    $('#company_code').change(function (e) {
        setdiv($(this));
    });

    $('#division_code').change(function (e) {
        setdept($(this));
    });

    $('#department_code').change(function (e) {
        setaccount_data($(this));
    });

});

window.setdiv = async function (sel) {
    const div_data = await ajax(`/get_div_data/${$(sel).val()}`);
    setOption('#division_code', div_data);
}

window.setdept = async function (sel) {
    const dept_data = await ajax(`/get_dept_data/${$(sel).val()}`);
    setOption('#department_code', dept_data);
}

window.setaccount_data = async function (sel) {

}