document.addEventListener('DOMContentLoaded', function () {
    // Get the current URL path
    var path = window.location.protocol + "//" + window.location.host + window.location.pathname;

    // Find the corresponding navigation link and add the 'active' class
    var links = document.querySelectorAll('.sidebar-nav .sidebar-item a');
    console.log(links);
    links.forEach(function (link) {
        if (link.getAttribute('href') === path) {
            link.closest('li').classList.add('active');
        }
    });

    // Show password's javascript start
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('click', function () {
        if (showPasswordCheckbox.checked) {
            // If checkbox is checked, show the password
            passwordInput.type = 'text';
        } else {
            // If checkbox is unchecked, hide the password
            passwordInput.type = 'password';
        }
    });
    // Show password's javascript end

    // ajax function to get student name


    //    Code for validation start

    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
});

// Code for validation End

function changeToggleMobile(id) {
    var trCollapseId = "trCollapse" + id;
    var toggleId = "collapseToggleBtnMobile" + id;
    var trCollapse = document.getElementById(trCollapseId);
    var toggle = document.getElementById(toggleId);
    if (toggle.innerHTML === "View") {
        trCollapse.style.display = "table-row";
        toggle.innerHTML = "Close";
    } else {
        toggle.innerHTML = "View";
        trCollapse.style.display = "none";
    }
}

function changeToggleDesktop(id) {
    var trCollapseId = "trCollapse" + id;
    var toggleId = "collapseToggleBtnDesktop" + id;
    var trCollapse = document.getElementById(trCollapseId);
    var toggle = document.getElementById(toggleId);
    if (toggle.innerHTML === "View") {
        trCollapse.style.display = "table-row";
        toggle.innerHTML = "Close";
    } else {
        toggle.innerHTML = "View";
        trCollapse.style.display = "none";
    }
}

$(document).ready(() => {
    $('#getNameBtn').on('click', function () {
        event.preventDefault();
        var regno = $('#fetchRegno').val();
        if (regno == '') {
            swal("Registration number cannot be empty", "", "error");
        } else if (isNaN(regno) || regno.length != 9) {
            swal('Invalid registration number', "", "error");
        } else {
            jQuery.ajax({
                url: '/getname/' + regno,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response && response.name) {
                        document.getElementById('response-volunteer-name').value = response.name;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        }
    });

    $('#addAttendanceForm').submit(function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                // Handle success response
                swal("Attendance Recorded", "", "success");
                $('#fetchRegno').val('');
                $('#response-volunteer-name').val('');
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                // You can display an error message to the user here
            }
        });
    });

    $('#addModeratorBtn').on('click', function(){
        if($('#response-volunteer-name').val() == 'No results found' || $('#response-volunteer-name').val() == ""){
            event.preventDefault();
            alert('Volunteer not found, enter valid volunteer details');
        }
    });

    const csv = document.querySelector('.buttons-csv');
    csv.id = "btn-csv";
    csv.classList.remove('btn-secondary');
    csv.classList.add('btn-warning');
    csv.classList.add('bi');
    csv.classList.add('bi-filetype-csv');
    console.log(csv);

    const excel = document.querySelector('.buttons-excel');
    excel.id = "btn-excel";
    excel.classList.remove('btn-secondary');
    excel.classList.add('btn-success');
    excel.classList.add('bi');
    excel.classList.add('bi-file-earmark-spreadsheet');
    console.log(excel);

    const pdf = document.querySelector('.buttons-pdf');
    pdf.id = "btn-pdf";
    pdf.classList.remove('btn-secondary');
    pdf.classList.add('btn-danger');
    pdf.classList.add('bi');
    pdf.classList.add('bi-filetype-pdf');
    console.log(pdf);

    const print = document.querySelector('.buttons-print');
    print.id = "btn-print";
    print.classList.remove('btn-secondary');
    print.classList.add('btn-primary');
    print.classList.add('bi');
    print.classList.add('bi-printer-fill');
    console.log(print);
});
$('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'csv',
            text: ' CSV',
            title: 'NSS Batch ' + document.getElementById('batch-name-export').innerHTML + ' Volunteers List'
        },
        {
            extend: 'excel',
            text: ' Excel',
            title: 'NSS Batch ' + document.getElementById('batch-name-export').innerHTML + ' Volunteers List'
        },
        {
            extend: 'pdf',
            text: ' Pdf',
            title: 'test data'
        },
        {
            extend: 'print',
            text: ' Print',
            title: 'NSS Batch ' + document.getElementById('batch-name-export').innerHTML + ' Volunteers List',
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '16px')
                // .prepend(
                //     // '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                //     // '<div>Data from 10 Jan 2023 to 25th Jan 2024</div>'
                // );

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ]
});


function viewInfoModalInit(id) {
    $.ajax({
        url: '/admin/volunteer/getInfo/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var volunteerInfo = response.volunteer[0];
            $('#regno').val(volunteerInfo.id);
            $('#name').val(volunteerInfo.name);
            $('#email').val(volunteerInfo.email);
            $('#phone').val(volunteerInfo.phone);
            $('#course').val(volunteerInfo.course);
            $('#batch').val(volunteerInfo.batch);
            $('#attended').val(volunteerInfo.drives_participated);
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

function deleteVolunteer() {
    var regno = ($('#regno').val());
    $('#volunteer-regno').val(regno);
}

// manage batch scripts start

document.getElementById('batchName').addEventListener('keyup', function () {
    var batchName = document.getElementById('batchName');
    var message = document.getElementById('message');
    var regex = /^\d{4}-\d{2}$/;

    if (regex.test(batchName.value)) {
        message.className = "text-success";
        batchName.className = "form-control mb-1 border-success";
        message.innerHTML = "Valid batch name";
    } else {
        message.className = "text-danger";
        batchName.className = "form-control mb-1 border-danger";
        message.innerHTML = "Invalid batch name. Format should be yyyy-yy";
    }
});

function changeStatus(id, status) {
    var status_btn = document.getElementById('status-btn' + id);
    var form_status = document.getElementById('form-status' + id);

    if (status == 0 && status_btn.innerHTML === "Open") {
        status = 1;
    } else {
        status = 0;
    }

    jQuery.ajax({
        url: '/admin/batch/manage/updateStatus', // if your url is using prefix enter url with prefix
        type: 'GET',
        dataType: 'json',
        data: {
            id: id,
            status: status
        },
        success: function (response) {
            console.log(response);
            if (response.message === "success") {
                if (status_btn.innerHTML === "Close" && form_status.innerHTML ===
                    "Accepting Responses") {
                    status_btn.className = "btn btn-success";
                    status_btn.innerHTML = "Open";
                    form_status.innerHTML = "Not accepting responses";
                } else {
                    status_btn.className = "btn btn-danger";
                    status_btn.innerHTML = "Close";
                    form_status.innerHTML = "Accepting Responses";
                }
            } else {
                alert('Some error occured in opening/closing form !');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

// manage batch scripts end

// manage drive scripts start

function driveEditModalInit(id) {
    $.ajax({
        url: '/admin/drive/getInfo/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response[0]);
            var driveInfo = response[0];
            $('#drive-id').val(driveInfo.id);
            $('#drive-date').val(driveInfo.date);
            $('#drive-from').val(driveInfo.from);
            $('#drive-to').val(driveInfo.to);
            $('#drive-type').val(driveInfo.type);
            $('#drive-title').val(driveInfo.title);
            $('#drive-area').val(driveInfo.area);
            $('#drive-conducted-by').val(driveInfo.conductedBy);
            $('#drive-attended-by').val(driveInfo.present);
            $('#drive-description').val(driveInfo.description);
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

function driveDeleteModalInit(id) {
    $('#delete-drive-id').val(id);
}
