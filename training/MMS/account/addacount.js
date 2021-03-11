var max = "";
$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "getmaxemployeeid.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            max = jsdata[0].cid;
            // alert(max);


        }
    })

    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }


    $(document).on('click', '#btnaddnewacc', function() {
        // console.log($('#adnacbday').val());
        var dob = $('#adnacbday').val();

        // get max of employeeId

        if ($('#adnacname').val() == "") {
            $.toast({
                text: "Please Enter Name", // Text that is to be shown in the toast
                heading: 'Required', // Optional heading to be shown on the toast
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
        } else if ($('#adnacaddress').val() == "") {
            $.toast({
                text: "Please Enter Address", // Text that is to be shown in the toast
                heading: 'Required', // Optional heading to be shown on the toast
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
        } else if ($('#adnaccontact').val() == "") {
            $.toast({
                text: "Please Enter Contact Number", // Text that is to be shown in the toast
                heading: 'Required', // Optional heading to be shown on the toast
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
        } else if (!Date.parse(dob)) {
            $.toast({
                text: "Please Enter Birth Date", // Text that is to be shown in the toast
                heading: 'Required', // Optional heading to be shown on the toast
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
            var createacc = confirm("Are you sure?");
            if (createacc == true) {






                var accbranch = $('#adnacbranch').val();
                var acclvl = $('#adnacuserlvl').val();
                var accname = $('#adnacname').val();
                var accaddress = $('#adnacaddress').val();
                var acccontact = $('#adnaccontact').val();
                var accbirthd = $('#adnacbday').val();
                var acccardno;
                var fname = accname.split(' ');
                var accusername = fname[0] + max;
                var p = "";
                //generate password
                var result = '';
                var characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i <= 5; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                p = result;
                if (acclvl == 1) {
                    var date = new Date();
                    var ndate = date.toLocaleDateString();
                    var datesp = ndate.split('/');
                    var y = datesp[2];
                    var m = datesp[0];
                    var mm = ("0" + m).slice(-2);
                    acccardno = 'E' + y + mm + max;
                    // alert(cardno);
                } else if (acclvl == 2) {
                    var date = new Date();
                    var ndate = date.toLocaleDateString();
                    var datesp = ndate.split('/');
                    var y = datesp[2];
                    var m = datesp[0];
                    var mm = ("0" + m).slice(-2);
                    acccardno = 'C' + y + mm + max;
                }


                $.ajax({
                    type: "POST",
                    url: "account/newaccount.php",
                    data: {
                        cardnumber: acccardno,
                        branch: accbranch,
                        level: acclvl,
                        name: accname,
                        address: accaddress,
                        contact: acccontact,
                        birthdate: accbirthd,
                        password: p,
                        username: accusername
                    },
                    success: function(data) {
                        // Generate download of hello.txt file with some content
                        var text = "USERNAME:" + accusername + "  PASSWORD:" + p;
                        var filename = acccardno + ".text";
                        download(filename, text);
                    }
                })


                $.toast({
                    text: "Account Created!", // Text that is to be shown in the toast
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
                // alert(
                //     'branch:' + accbranch +
                //     ' lbl:' + acclvl +
                //     ' name:' + accname +
                //     ' address:' + accaddress +
                //     ' contact:' + acccontact +
                //     ' bday:' + accbirthd +
                //     ' cardno:' + acccardno +
                //     ' pass:' + p +
                //     ' username:' + accusername +
                //     ' max:' + max
                // );
                alert('Card No: ' + acccardno);

            }
        }




    })
})