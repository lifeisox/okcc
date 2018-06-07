// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("topButton").style.display = "block";
    } else {
        document.getElementById("topButton").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

toastr.options.timeOut = 2500; // How long the toast will display without user interaction
toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
toastr.options.closeButton = true;

// Start about Privileges
const PRIVILEGES_DATA = [
    [ 99, i18n.admin.table.semiMember ],   
    [ 10, i18n.admin.table.member ],  
    [ 1, i18n.admin.table.admin ],  
    [ 0, i18n.admin.table.super ] 
];

function getPrivilegeById( $value ) {
    var ret = '';
    $.each( PRIVILEGES_DATA, function(index, data) {
        if ($value === data[0]) { ret = data[1]; return false }
    });
    return (ret ? ret : i18n.admin.table.undefined);
}

function buildPrivilegesCombo() {
    var html = "";
    $.each( PRIVILEGES_DATA, function(index, data) {
        html += '<option value="' + data[0] + '" ' + (index === 0 ? 'selected' : '') + '>' + data[1] + '</option>';
    });
    return html;
}