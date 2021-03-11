$(document).ready(function() {

    var oldval;
    $(document).on('mousedown', '#btnviewpass', function() {
            $('#myaccinpemppass').attr('type', 'text');
        }).on('mouseup mouseleave', function() {
            $('#myaccinpemppass').attr('type', 'password');
        })
        // click edit
    $(document).on('click', '#btneditmydetails', function() {
            oldval = $(this).closest('div').find('.modalinp').val();
            $('.btneditmyacc').attr('disabled', true);
            $(this).css('display', 'none');
            $(this).closest('div').find('#btnsavemydetails').css('display', 'block');
            $(this).closest('div').find('#btncancelmydetails').css('display', 'block');
            $(this).closest('div').find('.modalinp').removeAttr('disabled');
        })
        // cancel
    $(document).on('click', '#btncancelmydetails', function() {
            $(this).closest('div').find('.modalinp').val(oldval);
            $(this).hide();
            $(this).closest('div').find('#btnsavemydetails').css('display', 'none');
            $(this).closest('div').find('#btneditmydetails').css('display', 'block');
            $(this).closest('div').find('.modalinp').attr('disabled', true);
            $('.btneditmyacc').attr('disabled', false);
        })
        // save
    $(document).on('click', '#btnsavemydetails', function() {
        $(this).hide();
        $(this).closest('div').find('#btneditmydetails').css('display', 'block');
        $(this).closest('div').find('#btncancelmydetails').css('display', 'none');
        $(this).closest('div').find('.modalinp').attr('disabled', true);
        $('.btneditmyacc').attr('disabled', false);
        var contno = $('#myaccinpempcontact').val();
        var address = $('#myaccinpempaddress').val();
        var pass = $('#myaccinpemppass').val();
        // console.log(contno, address, pass);
        $.ajax({
            type: "POST",
            url: "Myaccount/savemyacc.php",
            data: {
                contact: contno,
                address: address,
                password: pass
            },
            success: function(data) {
                $.toast({
                    text: "Account Updated!", // Text that is to be shown in the toast
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
    })

    $(document).ready(function() {

        $(document).on('click', '#subnav-myaccount', function() {
            $.ajax({
                type: "POST",
                url: "Myaccount/emp-myaccount.php",

                success: function(data) {
                    $('.myaccountnewdiv').remove();
                    var jsdata = JSON.parse(data);

                    $('.myaccount-body').append(`
                <div class="myaccountnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Card Number</span>
                  </div>
                  <input class="form-control modalinp" id="myaccinpempcn" value = "${jsdata[0].CardNumber}"  disabled></input>
                </div>
  
                <div class="myaccountnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Contact Number</span>
                    </div>
                  <input class="form-control modalinp" id="myaccinpempcontact" value = "${jsdata[0].ContactNumber}"  disabled></input>
                  <button class="btn btn-info btneditmyacc" id="btneditmydetails"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-success" id="btnsavemydetails" style="display:none;"><i class="fas fa-save"></i></button>
                  <button class="btn btn-danger" id="btncancelmydetails" style="display:none;"><i class="fas fa-ban"></i></button>
                </div>
  
                <div class="myaccountnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                    </div>
                  <input class="form-control modalinp" id="myaccinpempaddress" value = "${jsdata[0].Address}"  disabled></input>
                  <button class="btn btn-info btneditmyacc" id="btneditmydetails"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-success" id="btnsavemydetails" style="display:none;"><i class="fas fa-save"></i></button>
                  <button class="btn btn-danger" id="btncancelmydetails" style="display:none;"><i class="fas fa-ban"></i></button>
                </div>
  
                <div class="myaccountnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                    </div>
                  <input type="password" class="form-control modalinp" id="myaccinpemppass" value = "${jsdata[0].Password}"  disabled></input>
                  <button class="btn btn-secondary" id="btnviewpass"><i class="fas fa-eye"></i></button>
                  <button class="btn btn-info btneditmyacc" id="btneditmydetails"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-success" id="btnsavemydetails" style="display:none;"><i class="fas fa-save"></i></button>
                  <button class="btn btn-danger" id="btncancelmydetails" style="display:none;"><i class="fas fa-ban"></i></button>
                
                
                </div>
              `);


                }


            });

            $.ajax({
                type: "POST",
                url: "Myaccount/mycart.php",
                success: function(data) {
                    $('.mycarttr').remove();
                    // $.toast('I will display the medias on your cart');s
                    var jsdata = JSON.parse(data);
                    for (var i = 0; i < jsdata.length; i++) {
                        var ii = parseInt(i);
                        // alert(i);
                        $('#tblmyaccount').find('tbody').append(`
                <tr class="mycarttr">
                <td class="myaccmedid" data-id=${jsdata[i].MediaId} data-hid=${jsdata[i].HoldId}>${ii + 1} </td>
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



            $.ajax({
                type: "POST",
                url: "Myaccount/mycheckedout.php",
                success: function(data) {
                    $('.mycheckednewtr').remove();
                    var jsdata = JSON.parse(data);
                    for (i in jsdata) {

                        $('#tblmychecked').find('tbody').append(`
                    <tr class="mycheckednewtr">
                    <td>${parseInt(i + 1)}</td>
                    <td>${jsdata[i].RecordId}</td>
                    <td>${jsdata[i].Title}</td>
                    <td>${jsdata[i].DateIssued}</td>
                    <td>${jsdata[i].DateDue}</td>
                    </tr>
                    `);
                    }

                }
            })

            $.ajax({
                type: "POST",
                url: "Myaccount/myfines.php",
                success: function(data) {
                    $('.newtrfines').remove();
                    var jsdata = JSON.parse(data);
                    for (i in jsdata) {
                        $('#tblmyfines').find('tbody').append(`
                        <tr class="newtrfines">
                        <td>${parseInt(i + 1)}</td>
                        <td>${jsdata[i].RecordId}</td>
                        <td>${jsdata[i].Title}</td>
                        <td>${jsdata[i].DateIssued}</td>
                        <td>${jsdata[i].DateDue}</td>
                        <td>${jsdata[i].Fine}</td>
                        </tr>
                        `);
                    }

                }
            })
        })






    })






})