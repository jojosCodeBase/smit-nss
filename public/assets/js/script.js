// Form validation script
(() => {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})();

// DOM Content Loaded
$(document).ready(function () {
    console.log('DOM fully loaded and parsed');

    // Toggle button functionality
    document.getElementById('toggle-button').addEventListener('click', function () {
        const button = document.getElementById('toggle-button');
        button.classList.toggle('expanded');
        if (button.classList.contains('expanded')) {
            document.getElementById('search-input').focus();
        }
    });

    // Button click handler for getting volunteer info
    $('#getNameByRegnoBtn').on('click', function () {
        $.ajax({
            url: '/volunteer/getInfo/' + $('#regno').val(),
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#response-volunteer-name').val(response.name);
                $('#response-volunteer-email').val(response.email);
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed: ', status, error);
                alert(xhr.status === 404 ? 'Volunteer not found' : 'An error occurred: ' + error);
            }
        });
    });

    // Batch edit button click handler
    $('.batchEditBtn').on('click', function () {
        const batchId = $(this).data('batch-id');
        $.ajax({
            url: '/admin/batch/getInfo/' + batchId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#id').val(response.id);
                $('#response-batch-name').val(response.name);
                $('#response-batch-student-coordinator').val(response.studentCoordinator);
                $('#editBatchModal').show();
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed: ', status, error);
            }
        });
    });

    // Batch name validation
    document.getElementById('batchName').addEventListener('keyup', function () {
        const batchName = document.getElementById('batchName');
        const message = document.getElementById('message');
        const regex = /^\d{4}-\d{2}$/;

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

    // Form submission with AJAX
    $('#addAttendanceForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        const formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                swal("Attendance Recorded", "", "success");
                $('#fetchRegno').val('');
                $('#response-volunteer-name').val('');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Add Moderator button click handler
    $('#addModeratorBtn').on('click', function () {
        if ($('#response-volunteer-name').val() === 'No results found' || $('#response-volunteer-name').val() === "") {
            event.preventDefault();
            alert('Volunteer not found, enter valid volunteer details');
        }
    });

    // Button style customization
    const csv = document.querySelector('.buttons-csv');
    csv.id = "btn-csv";
    csv.classList.remove('btn-secondary');
    csv.classList.add('btn-warning', 'bi', 'bi-filetype-csv');
    console.log(csv);

    const excel = document.querySelector('.buttons-excel');
    excel.id = "btn-excel";
    excel.classList.remove('btn-secondary');
    excel.classList.add('btn-success', 'bi', 'bi-file-earmark-spreadsheet');
    console.log(excel);

    const pdf = document.querySelector('.buttons-pdf');
    pdf.id = "btn-pdf";
    pdf.classList.remove('btn-secondary');
    pdf.classList.add('btn-danger', 'bi', 'bi-filetype-pdf');
    console.log(pdf);

    const print = document.querySelector('.buttons-print');
    print.id = "btn-print";
    print.classList.remove('btn-secondary');
    print.classList.add('btn-primary', 'bi', 'bi-printer-fill');
    console.log(print);
});

// Show password toggle
document.getElementById('showPassword').addEventListener('change', function () {
    const passwordField = document.getElementById('password');
    passwordField.type = this.checked ? 'text' : 'password';
});

// Navigation link activation
const path = window.location.protocol + "//" + window.location.host + window.location.pathname;
const links = document.querySelectorAll('.sidebar-nav .sidebar-item a');
links.forEach(function (link) {
    if (link.getAttribute('href') === path) {
        link.closest('li').classList.add('active');
    }
});

// Toggle visibility functions for mobile and desktop
function changeToggleMobile(id) {
    const trCollapse = document.getElementById("trCollapse" + id);
    const toggle = document.getElementById("collapseToggleBtnMobile" + id);
    if (toggle.innerHTML === "View") {
        trCollapse.style.display = "table-row";
        toggle.innerHTML = "Close";
    } else {
        toggle.innerHTML = "View";
        trCollapse.style.display = "none";
    }
}

function changeToggleDesktop(id) {
    const trCollapse = document.getElementById("trCollapse" + id);
    const toggle = document.getElementById("collapseToggleBtnDesktop" + id);
    if (toggle.innerHTML === "View") {
        trCollapse.style.display = "table-row";
        toggle.innerHTML = "Close";
    } else {
        toggle.innerHTML = "View";
        trCollapse.style.display = "none";
    }
}

// DataTables initialization
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
                $(win.document.body).css('font-size', '16px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
            }
        }
    ]
});

// Volunteer and drive management functions
function viewInfoModalInit(id) {
    $.ajax({
        url: '/volunteer/getInfo/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            const volunteerInfo = response;
            $('#regno').val(volunteerInfo.id);
            $('#name').val(volunteerInfo.name);
            $('#email').val(volunteerInfo.email);
            $('#phone').val(volunteerInfo.phone);
            $('#course').val(volunteerInfo.course);
            $('#batch').val(volunteerInfo.batch);
            $('#attended').val(volunteerInfo.drives_participated);
            $('#gender').val(volunteerInfo.gender);
            $('#nationality').val(volunteerInfo.nationality);
            $('#dob').val(volunteerInfo.date_of_birth);
            $('#category').val(volunteerInfo.category);
            $('#document_number').val(volunteerInfo.document_number);
        },
        error: function (xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

function deleteVolunteer() {
    const regno = $('#regno').val();
    $('#volunteer-regno').val(regno);
}

function changeStatus(id, status) {
    const status_btn = document.getElementById('status-btn' + id);
    const form_status = document.getElementById('form-status' + id);

    if (form_status === 0 && status_btn.innerHTML === "Open") {
        form_status = 1;
    } else {
        form_status = 0;
    }
}
$.ajax({
    url: '/admin/batch/manage/updateStatus', // Adjust URL as needed
    type: 'GET',
    dataType: 'json',
    data: {
        id: id,
        status: status
    },
    success: function (response) {
        console.log(response);
        if (response.message === "success") {
            if (status_btn.innerHTML === "Close" && form_status.innerHTML === "Accepting Responses") {
                status_btn.className = "btn btn-success";
                status_btn.innerHTML = "Open";
                form_status.innerHTML = "Not accepting responses";
            } else {
                status_btn.className = "btn btn-danger";
                status_btn.innerHTML = "Close";
                form_status.innerHTML = "Accepting Responses";
            }
        } else {
            alert('Some error occurred in opening/closing form!');
        }
    },
    error: function (xhr, status, error) {
        console.error('AJAX request failed: ', status, error);
    }
});


// Manage drive scripts start
function driveEditModalInit(id) {
    $.ajax({
        url: '/admin/drive/getInfo/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const driveInfo = response[0];
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
