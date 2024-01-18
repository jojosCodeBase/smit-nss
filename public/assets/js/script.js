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

