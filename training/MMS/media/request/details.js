$(document).ready(function() {
    $(document).on('click', '#btnrequestinfo', function() {
        var reqtable = $(this);
        var borrowerId = $(this).closest('tr').find('#myrecid').text();
        // $.toast(borrowerId);
        $.ajax({
            type: "POST",
            url: "media/request/getdetails.php",
            data: {
                id: borrowerId
            },
            success: function(data) {
                $('.newtrrequestmodal').remove();
                var jsdata = JSON.parse(data);
                $('#Mymodalreq').css('display', 'block');
                // $.toast(' i will get the details');
                $('#modalh1req').text("Details");
                for (i in jsdata) {
                    var ii = parseInt(i);
                    $('.tblrequestmodalmedia').find('tbody').append(`
                <tr class="newtrrequestmodal">
                <td>${jsdata[i].MediaId}</td>
                <td>${jsdata[i].Title}</td>
                <td>${jsdata[i].MediaTypename}</td>
                <td>${jsdata[i].StatusName}</td>
                </tr>
                `);
                }

            }

        });
        $(document).on('click', '#modalacceptrequest', function() {
            var accept = confirm("Are you sure?");
            if (accept == true) {
                $('.tblrequestmodalmedia tbody tr').each(function() {
                    var id = $(this).find('td:eq(0)').text();
                    var rid = $(reqtable).closest('tr').find('td:eq(0)').text();

                    console.log(id, rid);
                    $.ajax({
                        type: "POST",
                        url: "media/request/acceptrequest.php",
                        data: {
                            mediaid: id,
                            recordid: rid
                        },
                        success: function(data) {
                            $(reqtable).closest('tr').remove();
                            $('.media-close-req').trigger('click');
                        }
                    });

                })
                $.toast({
                    text: "Request Accepted", // Text that is to be shown in the toast
                    heading: 'Success', // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'slide', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



                    textAlign: 'left', // Text alignment i.e. left, right or center
                    loader: true, // Whether to show loader or not. True by default
                    loaderBg: '#9EC600', // Background color of the toast loader
                    beforeShow: function() {}, // will be triggered before the toast is shown
                    afterShown: function() {}, // will be triggered after the toat has been shown
                    beforeHide: function() {}, // will be triggered before the toast gets hidden
                    afterHidden: function() {} // will be triggered after the toast has been hidden
                });
            }


        })
        $(document).on('click', '#modaldeclinerequest', function() {
            // $.toast("i will update media.StatusId to '1' and update records.Remarks to 'Declined' ");
            var can = confirm("Are you sure?");
            if (can == true) {
                var rid = reqtable.closest('tr').find('td:eq(0)').text();
                $('.tblrequestmodalmedia tbody tr').each(function() {
                    var mid = $(this).find('td:eq(0)').text();
                    $.ajax({
                        type: "POST",
                        url: "media/request/declinerequest.php",
                        data: {
                            recordid: rid,
                            mediaid: mid
                        },
                        success: function(data) {
                            $('.media-close-req').trigger('click');

                            $.ajax({
                                type: "POST",
                                url: "media/request/declinerequestdel.php",
                                data: {
                                    recordid: rid
                                },
                                success: function(data) {
                                    $.ajax({
                                        type: "POST",
                                        url: "media/request/requestmedia.php",
                                        success: function(data) {

                                            console.log("success");
                                            $('.requestnewtr').remove();
                                            var jsdata = JSON.parse(data);
                                            for (i in jsdata) {
                                                $('.tblrequestmedia').find('tbody').append(`
                                      <tr class="requestnewtr">
                                      <td id="myrecid">${jsdata[i].RecordId}</td>
                                      <td id="myreqid">${jsdata[i].CardNumber}</td>
                                      <td>${jsdata[i].Remarks}</td>
                                      <td><button class="btn btn-info" id="btnrequestinfo">Details</button></td>
                                      </tr>
                                      `);
                                            }

                                        }
                                    })
                                }
                            })

                        }
                    });
                })
            }



        })
    })
    $(document).on('click', '.media-close-req', function() {
        $('#Mymodalreq').css('display', 'none');

    })



})