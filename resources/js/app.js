import './bootstrap';

import Alpine from 'alpinejs';
import $ from 'jquery';
import 'datatables.net-bs5'
import 'selectize';

window.Alpine = Alpine;

Alpine.start();

window.$ = $;
window.jQuery = $;
window.Alpine = Alpine;

$(document).ready(function () {
    document.getElementById('toggleSidebar').onclick = function () {
        document.getElementById('mobileSidebar').classList.toggle('hidden');
    };

    document.getElementById('closeSidebar').onclick = function () {
        document.getElementById('mobileSidebar').classList.add('hidden');
    };
    // Add 'active' class to clicked nav item and remove from others
    // Add 'active' class to clicked nav item and remove from others
    document.querySelectorAll('.nav-item').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Get the current URL of the page
    var currentUrl = window.location.href;
    var navLinks = document.querySelectorAll(".nav-link");

    for (var i = 0; i < navLinks.length; i++) {
        // Get the href attribute from the nav-link
        var linkUrl = navLinks[i].getAttribute("href");

        // Check if the current URL starts with the link URL (more accurate than includes)
        if (linkUrl && currentUrl.startsWith(linkUrl)) {
            // Add the Tailwind active class to the current link
            navLinks[i].classList.add("bg-gray-200"); // Tailwind class to style the active link
            break; // Exit the loop once the active link is found and highlighted
        }
    }






    window.setselect = async function (sel) {
        if ($(sel).length) {
            $(sel).selectize();
        }
    }

    window.setOption = async function (sel, res, val = '') {
        var $select = $(sel).selectize()[0].selectize;
        $select.clearOptions(); // Clear existing options
        $.each(res, function (index, item) {
            $select.addOption({ value: item.id, text: item.name });
        });
        if (val !== '') {
            $select.setValue(val);
        }
    }

    window.simpletb = function (tb = '#modaltb') {
        if (!$(tb).text().includes('No data yet')) {
            $(tb).DataTable();
        }
    }

    window.setdatatb = async function (parsedRes, tb = '#maintb') {
        $(tb).html('Loading data, please wait...'); // Replace with appropriate loading message function if needed

        try {
            if (!parsedRes || !parsedRes.data || !Array.isArray(parsedRes.data)) {
                throw new Error('Invalid data format. Expected an object with a "data" property containing an array.');
            }

            const dataLength = parsedRes.data.length;

            if (dataLength === 0) {
                $(tb).html(`
                    <tbody>
                        <tr>
                            <td>No data found yet</td>
                        </tr>
                    </tbody>
                    `);
                return;
            }

            $(tb).DataTable().clear().destroy();
            $(tb).html("");

            var columns = Object.keys(parsedRes.data[0] || {}).map(key => ({
                title: formatHeaderTitle(key),
                data: key
            }));

            var data = parsedRes.data;

            var numRecords = data.length;
            var lengthMenu = [];
            var step = 10;
            for (var i = step; i < numRecords; i += step) {
                lengthMenu.push(i);
            }
            lengthMenu.push(numRecords, -1);
            var lengthMenuLabels = lengthMenu.slice(0, -1).concat(["All"]);

            var header = '<tr>';
            columns.forEach(() => {
                header += `<th></th>`;
            });
            header += '</tr>';

            $(tb).DataTable({
                data: data,
                columns: columns,
                pageLength: 100,
                lengthMenu: [lengthMenu, lengthMenuLabels],
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    $('thead').append(header);
                    var api = this.api();
                    api.columns().eq(0).each(function (colIdx) {
                        var cell = $('thead tr:eq(0) th').eq(colIdx);
                        var cell1 = $('thead tr:eq(1) th').eq(colIdx);
                        var title = $(cell).text();
                        if (title !== 'Action') {
                            var trnew = `<input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="Search ${formatHeaderTitle(title)}" />`;
                            $(cell1).html(`${trnew}`);

                            $('input', cell1).off('keyup change').on('keyup change', function (e) {
                                e.stopPropagation();
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})';
                                var cursorPosition = this.selectionStart;
                                api.column(colIdx).search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                ).draw();

                                $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                            });
                        }
                    });
                }
            });
            $('.dt-search').find('input').removeClass().addClass('px-2 py-1 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-200 focus:ring-blue-100 focus:ring-opacity-20 dark:focus:border-blue-300 focus:outline-none focus:ring');
        } catch (error) {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching the data.'); // Replace with appropriate error handling function if needed
        }
        $('button.refresh-tb').click(function (e) {
            console.log('Refresh')
            set_table();
        });
        /*  $('btn.modal-refresh-tb').click(function (e) {
             set_table();
         }); */
    }

    window.set_table = async function (route, tb = '#maintb', form = null) {
        try {
            var res = await ajax(route, form);
            if (res) {
                setdatatb(res, tb);
            } else {
                console.error('Failed to fetch data.');
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    window.formatHeaderTitle = function (str) {
        // Convert camelCase to space-separated words
        str = str.replace(/([a-z])([A-Z])/g, '$1 $2');
        // Convert snake_case to space-separated words
        str = str.replace(/_/g, ' ');
        // Capitalize the first letter of each word
        return str.replace(/\b\w/g, function (match) {
            return match.toUpperCase();
        });
    }

    window.ajax = async function (url, formData = null, method = 'GET') {
        try {
            const options = {
                url: url,
                type: method,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };

            // Handle data and content type for methods that send data to the server
            if (method === 'POST' || method === 'PUT' || method === 'PATCH' || method === 'DELETE') {
                options.data = formData ? new URLSearchParams(formData).toString() : null;
                options.processData = false;
                options.contentType = 'application/x-www-form-urlencoded';
            }

            const response = await $.ajax(options);

            // Check if response looks like JSON
            if (typeof response === 'string') {
                try {
                    return JSON.parse(response.trim());
                } catch (e) {
                    return response.trim(); // Return raw response if parsing fails
                }
            } else {
                return response; // Already an object
            }
        } catch (error) {
            console.error('Error: ' + error.statusText + ' - ' + (error.responseText || error.responseJSON || 'No additional error info'));
            return "";
        }
    };

    window.question = function (title, text) {
        return new Promise((resolve) => {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            });
        });
    }
    window.tsuccess = function (texts, sec = 3) {
        toast('success', 'Successful', texts, sec);
    }

    window.terror = function (texts = `There's something wrong, please try again.`, sec = 3) {
        toast('error', 'Error', texts, sec);
    }

    window.twarning = function (texts, sec = 3) {
        toast('warning', 'Warning', texts, sec);
    }

    window.toast = function (icons, titles, texts, sec) {
        Swal.fire({
            icon: icons,
            title: titles,
            html: texts,
            timer: (sec * 1000),
            showConfirmButton: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    }

    window.modalmd = function (title, body, btn = '', btnType = '') {
        setModalSize('xl:w-1/2', title, body, btn, btnType);
    };

    window.modallg = function (title, body, btn = '', btnType = '') {
        setModalSize('lg:w-2/3', title, body, btn, btnType);
    };

    window.modalxl = function (title, body, btn = '', btnType = '') {
        setModalSize('md:w-3/4', title, body, btn, btnType);
    };

    window.modalsm = function (title, body, btn = '', btnType = '') {
        setModalSize('md:w-1/3', title, body, btn, btnType);
    };

    function setModalSize(size, title, body, btn = '', btnType = '') {
        let btnClass = 'btn-success';  // Default class for Submit button
        let btnText = 'Submit';  // Default button text

        // Update class and text based on button type
        switch (btnType) {
            case 'delete':
                btnClass = 'btn-danger';
                btnText = 'Remove';
                break;
            case 'update':
                btnClass = 'btn-warning';
                btnText = 'Update';
                break;
            default:
                btnClass = 'btn-success';
                btnText = 'Submit';
        }

        // If `btn` is not empty, add the button HTML
        const submitButtonHtml = btn
            ? `<button class="btn ${btnClass}" type="button" onclick="${btn}">${btnText}</button>`
            : '';

        // Update modal content
        $('#btn_submit').html(submitButtonHtml);  // Update the button if there is one
        $('#modalTitle').html(title);  // Update the modal title
        $('#modalBody').html(body);  // Update the modal body content

        // Adjust modal size by updating classes
        $('#modalSize').removeClass('w-full md:w-3/4 lg:w-2/3 xl:w-1/2');  // Reset size
        $('#modalSize').addClass(size);  // Set the new size
        $('#modal').removeClass('hidden');  // Show the modal
        $('#modalBackground').removeClass('hidden');  // Show modal background
    }

    // Open modal manually
    window.openModal = function () {
        $('#modal').removeClass('hidden');
        $('#modalBackground').removeClass('hidden');
    };

    // Close modal manually
    window.closeModal = function () {
        $('#modal').addClass('hidden');
        $('#modalBackground').addClass('hidden');
    };

    // Attach event listeners to close buttons and background click
    $('#closeModal, #closeModal2').on('click', window.closeModal);

    $('#modalBackground').on('click', function (event) {
        // Close modal when clicking outside of the modal content (on background)
        if ($(event.target).is('#modalBackground')) {
            window.closeModal();
        }
    });


    window.datatable_to_excel = function (tableId, fileName = $('#' + tableId).attr('id')) {
        var table = $('#' + tableId).DataTable();
        var data = table.rows({ search: 'applied' }).data().toArray();

        var workbook = XLSX.utils.book_new();
        var sheetData = [];

        // Extract headers
        var headers = [];
        table.columns().header().each(function (header) {
            headers.push($(header).text().trim());
        });
        sheetData.push(headers); // Add headers to sheetData

        // Convert each row to an array and add to sheetData
        data.forEach(function (rowData) {
            var rowArray = [];
            Object.values(rowData).forEach(function (cellData) {
                rowArray.push(cellData);
            });
            sheetData.push(rowArray);
        });

        var sheet = XLSX.utils.aoa_to_sheet(sheetData);
        XLSX.utils.book_append_sheet(workbook, sheet, "Sheet1");
        XLSX.writeFile(workbook, fileName + '.xlsx');
    }

    window.htmltb_to_excel = function (tbid, name = tbid) {
        var name = $("#tbtitle").html();
        name = ((name == "" || name == undefined) ? tbid : name);
        var data = document.getElementById(tbid).cloneNode(true);
        elems = $(data).find('.hideelem');
        links = $(data).find('a');
        var head = $(data).find('thead');
        $.each(links, function (i, v) {
            var l = $(v).attr('href');
            var p = $(v).parent();
            $(p).html(l);
        });
        $.each(head, function (i, v) {
            var thcnt = $(v).contents();
            $(v).replaceWith(thcnt);
        });
        var bdy = $(data).find('tbody');
        $.each(bdy, function (i, v) {
            var bdycnt = $(v).contents();
            $(v).replaceWith(bdycnt);
        });

        $(elems).remove();
        var file = XLSX.utils.table_to_book(data, {
            sheet: "Schedule",
            raw: false
        });

        XLSX.write(file, {
            bookType: 'xlsx',
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, name + '.xlsx');

    }


    window.reqfunc = function (elem) {
        let $input = $(elem).closest('div').find('div.selectize-input');
        if (elem.hasClass("selectized")) {
            $input.addClass('border border-danger');
            setTimeout(() => {
                $input.removeClass('border border-danger');
            }, 3000);
        } else {
            $(elem).addClass('bg-danger bg-opacity-50');
            setTimeout(() => {
                $(elem).removeClass('bg-danger bg-opacity-50');
            }, 3000);
        }
    }

    window.loading = function (msg = "") {
        return `<span class=" fs-6">` + msg + `</span><div class="spinner-border spinner-border-sm text-warning" id="l" role="status"></div>`;
    }

});

