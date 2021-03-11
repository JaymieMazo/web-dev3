$(document).ready(function() {
    $(document).on('click', '#subnav-mediafines', function() {
        $.ajax({
            type: "POST",
            url: "media/fine/selectfines.php",
            success: function(data) {
                $('.mediafine').remove();
                var jsdata = JSON.parse(data);
                // $.toast('iwilldisplayfines');
                for (i in jsdata) {
                    $('.tblfine').find('tbody').append(`
                <tr class="mediafine">
                    <td>${jsdata[i].RecordId}</td>
                    <td data-medid=${jsdata[i].MediaId}>${jsdata[i].Title}</td>
                    <td>${jsdata[i].CardNumber}</td>
                    <td>${jsdata[i].DateIssued}</td>
                    <td>${jsdata[i].DateDue}</td>
                    <td>${jsdata[i].Fine}</td>
                    <td><button class="btn btn-info" id="btnsettlefine">Settle</button></td>
                </tr>
                `);
                }

            }
        })
    })

    $(document).on('keyup', '#inpsearchfine', function() {
        var inp = $('#inpsearchfine').val();
        $.ajax({
            type: "POST",
            url: "media/fine/filterfine.php",
            data: {
                cardnumber: inp
            },
            success: function(data) {
                $('.mediafine').remove();
                var jsdata = JSON.parse(data);
                // alert('success');
                for (i in jsdata) {
                    $('.tblfine').find('tbody').append(`
                <tr class="mediafine">
                    <td>${jsdata[i].RecordId}</td>
                    <td data-medid=${jsdata[i].MediaId}>${jsdata[i].Title}</td>
                    <td>${jsdata[i].CardNumber}</td>
                    <td>${jsdata[i].DateIssued}</td>
                    <td>${jsdata[i].DateDue}</td>
                    <td>${jsdata[i].Fine}</td>
                    <td><button class="btn btn-info" id="btnsettlefine">Settle</button></td>
                </tr>
                `);
                }
            }
        });
    })

    $(document).on('click', '#btnsettlefine', function() {
        $('#Myfinemodal').css('display', 'block');
        var finerecid = $(this).closest('tr').find('td:eq(0)').text();
        var finetitle = $(this).closest('tr').find('td:eq(1)').text();
        var fineborrower = $(this).closest('tr').find('td:eq(2)').text();
        var fineamount = $(this).closest('tr').find('td:eq(5)').text();
        var me = $(this).closest('tr');
        // console.log(finerecid, finetitle, fineborrower, fineamount);
        $('#finemodalrecid').val(finerecid);
        $('#finemodalborrowerid').val(fineborrower);
        $('#finemodaltitle').val(finetitle);
        $('#finemodaltotal').val(fineamount);

        // click pay
        $(document).on('click', '#btnpayfine', function() {
            var fine = $('#finemodaltotal').val();
            var exchange = $('#finemodalpayment').val() - fine;
            var mediaid = me.find('td:eq(1)').attr('data-medid');
            var payment = $('#finemodalpayment').val();
            console.log(finerecid, mediaid, fine, payment, exchange);
            if (exchange > -1) {
                // $.toast('proceed');
                $.ajax({
                    type: "POST",
                    url: "media/fine/recordfine.php",
                    data: {
                        recordid: finerecid,
                        medid: mediaid,
                        fine: fine,
                        payment: payment,
                        extra: exchange
                    },
                    success: function(data) {
                        $.ajax({
                            type: "POST",
                            url: "media/fine/selectfines.php",
                            success: function(data) {
                                $('.mediafine').remove();
                                var jsdata = JSON.parse(data);
                                // $.toast('iwilldisplayfines');
                                for (i in jsdata) {
                                    $('.tblfine').find('tbody').append(`
                                <tr class="mediafine">
                                    <td>${jsdata[i].RecordId}</td>
                                    <td data-medid=${jsdata[i].MediaId}>${jsdata[i].Title}</td>
                                    <td>${jsdata[i].CardNumber}</td>
                                    <td>${jsdata[i].DateIssued}</td>
                                    <td>${jsdata[i].DateDue}</td>
                                    <td>${jsdata[i].Fine}</td>
                                    <td><button class="btn btn-info" id="btnsettlefine">Settle</button></td>
                                </tr>
                                `);
                                }

                            }
                        })
                        $('.media-close-fine').trigger('click');

                        $.toast({
                            text: "Payment Success", // Text that is to be shown in the toast
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
            } else {
                $.toast({
                    text: "Insufficient Amount", // Text that is to be shown in the toast
                    heading: 'Warning', // Optional heading to be shown on the toast
                    icon: 'warning', // Type of toast icon
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
    })



    $(document).on('click', '.media-close-fine', function() {
        $('#Myfinemodal').css('display', 'none');
    })


    $(document).on('keyup', '#finemodalpayment', function() {
        var fine = $('#finemodaltotal').val();
        var exchange = $(this).val() - fine;

        if (exchange < 0) {
            $('#finemodalchange').val(0);
        } else {
            $('#finemodalchange').val(exchange);
        }

    })





})