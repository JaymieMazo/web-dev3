var userlbl;
// create a ajax that will the $_SESSION['userlevel'] from another php file
// continue tommorow
$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "userlevel/getsession.php",
        success: function(data) {
            // var jsdata = JSON.parse(data);
            // userlbl = jsdata;
            // console.log(data);
            if (data[1] == 2) {
                console.log('level 2');
                $('#navbuttonaddnew').remove();
                $('#nav-transaction').remove();
                $('#managemed').remove();
                $('#medreoort').remove();
                $('#subnav-custoemeraccount').remove();
                $('#subnav-employeeaccount').remove();
                $('#selBranch').remove();
                $('#selBranchlbl').remove();
                // $('#btnmodaldelete').remove();
            } else {
                // console.log('level 1');
            }
        }
    })
})