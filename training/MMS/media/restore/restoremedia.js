$(document).ready(function() {
    $(document).on('click', '#subnav-restoremedia', function() {
        // $.toast('Welcome to Restore');
        $('.mainbody').hide();
        $('.addmediabody').hide();
        $('.restoremedform').show();
        $.ajax({
            type: "POST",
            url: "media/restore/displayonhold.php",
            success: function(data) {
                var jsdata = JSON.parse(data);
                console.log(jsdata);
                $('.tblrestoremedia').find('.newrestr').remove();
                // $.toast('Welcome to Restore');
                for (i in jsdata) {
                    $('.tblrestoremedia').find('tbody').append(`
                <tr class="newrestr">
                <td class="tdmedId">${jsdata[i].MediaId}</td>
                <td>${jsdata[i].Name}</td>
                <td>${jsdata[i].StatusName}</td>
                <td>${jsdata[i].MediaTypename}</td>
                <td>${jsdata[i].Title}</td>
                <td>${jsdata[i].Author}</td>
                
                <td>${jsdata[i].YearPub}</td>
                <td><button class="btn btn-success btnres"><i class="fas fa-undo-alt"></i>     Restore</button></td>
                </tr>
                `);
                }

            }


        })
    })

    $(document).on('click', '.btnres', function() {
        var resmedId = $(this).closest('tr').find('.tdmedId').text();
        var here = $(this);

        // $.toast(resmedId);

        $.ajax({
            type: "POST",
            url: "media/restore/restoremedia.php",
            data: {
                mediaId: resmedId
            },
            success: function(data) {
                // var jsdata = JSON.parse(data)
                // $.toast(data);
                here.closest('tr').css('display', 'none');
                $.toast({
                    text: "Media Restored.", // Text that is to be shown in the toast
                    heading: 'Success', // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'slide', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3500, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



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
})