$(document).ready(function() {
    $(document).on('click', '#myaccationremovemed', function() {
        var id = $(this).closest('tr').find('.myaccmedid').attr('data-id');
        // $.toast(id);
        $.ajax({
            type: "POST",
            url: "Myaccount/removemed.php",
            data: {
                mediaId: id
            },
            success: function(data) {
                $(this).closest('tr').remove();
                $.ajax({
                    type: "POST",
                    url: "Myaccount/mycart.php",
                    success: function(data) {
                        $('.mycarttr').remove();
                        // $.toast('I will display the medias on your cart');
                        var jsdata = JSON.parse(data);
                        // alert(jsdata.length);
                        for (i in jsdata) {

                            var ii = parseInt(i);
                            $('#tblmyaccount').find('tbody').append(`
                        <tr class="mycarttr">
                        <td class="myaccmedid" data-id=${jsdata[i].MediaId}>${ii + 1}</td>
                        <td>${jsdata[i].Title}</td>
                        <td>${jsdata[i].MediaTypename}</td>
                        <td>${jsdata[i].Author}</td>
                        <td>${jsdata[i].YearPub}</td>
                        <td>${jsdata[i].Location}</td>
                        <td><button class="btn btn-danger" id="myaccationremovemed"><i class="fas fa-ban"></i> Remove</button></td>
                        </tr>
                        `);
                        }
                    }
                });
            }
        });
    })

    $(document).on('click', '#btnmyaccreq', function() {
        $(document).ready(function() {
            $('#tblmyaccount tbody').each(function() {
                var no = $(this).find('tr:eq(0)');
                if (no.length > 0) {

                    var fine = $('#tblmyfines').find('tr');
                    // console.log(fine);
                    if (fine.length < 0) {
                        $.toast({
                            text: "Sorry. You have an outstanding Fine.", // Text that is to be shown in the toast
                            heading: 'Warning', // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



                            textAlign: 'left', // Text alignment i.e. left, right or center
                            loader: true, // Whether to show loader or not. True by default
                            loaderBg: 'white', // Background color of the toast loader
                            beforeShow: function() {}, // will be triggered before the toast is shown
                            afterShown: function() {}, // will be triggered after the toat has been shown
                            beforeHide: function() {}, // will be triggered before the toast gets hidden
                            afterHidden: function() {} // will be triggered after the toast has been hidden
                        });
                    } else {



                        // pagpatuloy bukasss, baka may errorr!!!!



                        // condition to check if user has outstanding request
                        var req = confirm("Do you want to post request?");
                        if (req == true) {


                            $.ajax({
                                type: "POST",
                                url: "Myaccount/checkmycart.php",
                                success: function(data) {
                                    var jsdata = JSON.parse(data);
                                    if (jsdata.length > 0) {
                                        $.toast({
                                            text: "You have an outstanding request!", // Text that is to be shown in the toast
                                            heading: 'Sorry', // Optional heading to be shown on the toast
                                            icon: 'info', // Type of toast icon
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
                                    } else {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'Myaccount/checkfine.php',
                                            success: function(data) {
                                                var jsdata = JSON.parse(data);
                                                if (jsdata.length > 0) {
                                                    $.toast({
                                                        text: "You have outstanding fines.", // Text that is to be shown in the toast
                                                        heading: 'Sorry', // Optional heading to be shown on the toast
                                                        icon: 'error', // Type of toast icon
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
                                                } else {
                                                    // $.toast(jsdata.length);
                                                    var x = "";
                                                    // generate id
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "Myaccount/genrecid.php",
                                                        success: function(data) {
                                                            var jsdata = JSON.parse(data);
                                                            x = jsdata[0].id;
                                                            console.log(x);
                                                            // save the recordheader
                                                            $.ajax({
                                                                    type: "POST",
                                                                    url: "Myaccount/requesttorec.php",
                                                                    data: {
                                                                        recordid: x
                                                                    },
                                                                    success: function(data) {
                                                                        // $.toast('iwiilsave the header of records');
                                                                    }
                                                                })
                                                                // save the recorddetails
                                                            $('#tblmyaccount tbody tr').each(function() {
                                                                var no = $(this).find('td:eq(0)').attr('data-id');
                                                                var hno = $(this).find('td:eq(0)').attr('data-hid');
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "Myaccount/requesttorecdetails.php",
                                                                    data: {

                                                                        recordid: x,
                                                                        mediaid: no
                                                                    },
                                                                    success: function(data) {


                                                                    }
                                                                });
                                                                // alert(no);
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "Myaccount/monholdsetdeldate.php",
                                                                    data: {
                                                                        mediaid: no,
                                                                        holdid: hno
                                                                    },
                                                                    success: function(data) {
                                                                        $('#tblmyaccount').find('tbody').find('.mycarttr').remove();
                                                                    }
                                                                })


                                                            })


                                                        }
                                                    })
                                                    $.toast({
                                                        text: "Request Posted.", // Text that is to be shown in the toast
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
                                            }
                                        })

                                    }
                                }
                            })


                        }
                    }

                } else {
                    $.toast({
                        text: "Your Cart is Empty", // Text that is to be shown in the toast
                        heading: 'Warning', // Optional heading to be shown on the toast
                        icon: 'error', // Type of toast icon
                        showHideTransition: 'slide', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



                        textAlign: 'left', // Text alignment i.e. left, right or center
                        loader: true, // Whether to show loader or not. True by default
                        loaderBg: 'white', // Background color of the toast loader
                        beforeShow: function() {}, // will be triggered before the toast is shown
                        afterShown: function() {}, // will be triggered after the toat has been shown
                        beforeHide: function() {}, // will be triggered before the toast gets hidden
                        afterHidden: function() {} // will be triggered after the toast has been hidden
                    });
                }
            })
        })
    })
})