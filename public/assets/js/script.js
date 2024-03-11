document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path
    var path = window.location.protocol +"//" +  window.location.host + window.location.pathname;

    // Find the corresponding navigation link and add the 'active' class
    var links = document.querySelectorAll('.sidebar-nav .sidebar-item a');
    console.log(links);
    links.forEach(function(link) {
        if (link.getAttribute('href') === path) {
            link.closest('li').classList.add('active');
        }
    });
});

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


function viewInfoModalInit(id){
    console.log(id);
    $.ajax({
        url: '/admin/volunteer/getInfo/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response){
            console.log(response.volunteer);
            var volunteerInfo = response.volunteer[0];
            $('#regno').val(volunteerInfo.id);
            $('#name').val(volunteerInfo.name);
            $('#email').val(volunteerInfo.email);
            $('#phone').val(volunteerInfo.phone);
            $('#course').val(volunteerInfo.course);
            $('#batch').val(volunteerInfo.batch);
            $('#attended').val(volunteerInfo.drives_participated);
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

function deleteVolunteer() {
    var regno = ($('#regno').val());
    $('#volunteer-regno').val(regno);
}

// manage batch scripts start

document.getElementById('batchName').addEventListener('keyup', function() {
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

    if(status == 0 && status_btn.innerHTML === "Open"){
        status = 1;
    }else{
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
        success: function(response) {
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
        error: function(xhr, status, error) {
            console.error('AJAX request failed: ', status, error);
        }
    });
}

// manage batch scripts end

