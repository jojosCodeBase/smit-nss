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
            $('#regno').val(volunteerInfo.regno);
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
