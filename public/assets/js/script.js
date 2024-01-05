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
