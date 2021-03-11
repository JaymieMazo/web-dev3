$(document).ready(function() {
    $('#inptype').val("");
    $('#divbill').val("");
    // $('#divmain').css('display', 'none');
    var service = prompt("Enter Account Number:");
    switch (service) {
        case "111":
            {

                $('#inptype').val("Regular");
                $('#inpbill').val("10");
                $('#inpbill').attr('value', 10);
                $('#divam').find('span').text("Total Hours: ");
                $('#divpm').css('display', 'none');
                $('#divmain').css('display', 'block');
                break;
            }

        case "222":
            {
                $('#inptype').val("Premium");
                $('#inpbill').val("25");
                $('#inpbill').attr('value', 25);
                $('#divmain').css('display', 'block');
                break;
            }
        default:
            {
                alert("No account found!")
                break;
            }
    }


})

// $(document).on('click', '#btnsubmit', function() {
//     var service = $('#inptype').val();
//     var bill = parseInt($('#inpbill').attr('value'));
//     var chargeam = parseInt($('#inpam').val());
//     var chargepm = parseInt($('#inppm').val());
//     $.ajax({
//             type: "POST",
//             url: "setpost.php",
//             data: {
//                 service: service,
//                 bill: bill,
//                 chargeam: chargeam,
//                 chargepm: chargepm
//             },
//             success: function(data) {
//             }
//         })

// })