// Function to toggle password visibility
$(document).ready(function () {
    $("#showPasswordCheckbox").change(function () {
        var passwordInput = $("#passwordInput");
        if ($(this).prop("checked")) {
            passwordInput.attr("type", "text");
        } else {
            passwordInput.attr("type", "password");
        }
    });
});


function sweetAlert(){
    swal("Success", "Attendance added successfully !", "success");
}

// Function to check all checkboxes on selectAll click
document.getElementById('selectAll').addEventListener('change', function () {
    var checkboxes = document.querySelectorAll('#myTable tbody input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = document.getElementById('selectAll').checked;
    });
});

// Function to toggle-icon on click
function changeIcon(id) {
    var toggleBtnId = 'toggleBtn' + id;
    var toggleBtn = document.getElementById(toggleBtnId);
    if (toggleBtn.className === "btn btn-danger bi-arrows-angle-contract") {
        toggleBtn.className = "btn btn-primary bi-arrows-angle-expand";
        return;
    }

    if (toggleBtn.className === "btn btn-primary bi-arrows-angle-expand" || toggleBtn.className === "btn btn-primary bi-arrows-angle-expand collapsed") {
        toggleBtn.className = "btn btn-danger bi-arrows-angle-contract";
        return;
    }
}

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

