$(document).ready(function() {
    var mediaId = "";
    var mediaTitle = "";
    var holdtitle = ""
    var newMediaTitle = "";
    $(document).on('click', '.newdiv', function() {
            $('#Mymodal').css('display', 'block');
            holdtitle = $(this);
            mediaId = $(this).attr('id');
            var mtId = $(this).attr('data-mtId');
            var sId = $(this).attr('data-sId');
            var mbId = $(this).attr('data-mbId');
            mediaTitle = $(this).text();
            // console.log(mediaId);
            // console.log(mediaTitle);
            $.ajax({
                type: "POST",
                url: "media/mediamodal.php",
                data: {
                    MediaId: mediaId
                },
                success: function(data) {
                    var dat = JSON.parse(data);
                    var finelate = parseFloat(dat[0].FineLate).toFixed(2);
                    var finelost = parseFloat(dat[0].FineLost).toFixed(2);
                    // console.log(finelost);
                    // console.log(finelate);
                    // console.log(JSON.parse(data)[0].Title);
                    // console.log(data[0].Title);
                    $('#modalh1').text(dat[0].Title);
                    $('.modalnewdiv').remove();
                    $('.media-modal-body').append(`
                <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                <div class="input-group-prepend">
                  <span class="input-group-text">Title</span>
                  </div>
                <input class="form-control modalinp" id="modalinptitle" value = "${dat[0].Title}"  disabled></input>
                <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
                <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
                </div>


              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
                <div class="input-group-prepend">
                <span class="input-group-text">Author</span>
                </div>
              <input class="form-control modalinp" id="modalinpauthor" value = "${dat[0].Author}" disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>


              <button class="btn btn-success btnmodalsave popup" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>

              


              
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Writer</span>
                </div>
              <input class="form-control modalinp" id="modalinpwriter" value = "${dat[0].Writer}"  disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>


              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Year Published</span>
                </div>
              <input class="form-control modalinp" id="modalinpyearpub" value = "${dat[0].YearPub}"  disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>



              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Type</span>
                </div>
              <select class="form-control modalinp" id="modalselmediatype" disabled>
              
              </select>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Status</span>
                </div>
              <select class="form-control modalinp" id="modalselstatusname"   disabled></select>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Branch</span>
                </div>
              <select class="form-control modalinp" id="modalselbranch"  disabled></select>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Location</span>
                </div>
              <input class="form-control modalinp" id="modalinplocation" value = "${dat[0].MediaLocation}"  disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Fine Late</span>
                </div>
              <input class="form-control modalinp" id="modalinpfinelate" value = "${finelate}"  disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>

              <div class="modalnewdiv input-group" style="height:40px;margin: 10px 10px;width:97%">
              <div class="input-group-prepend">
                <span class="input-group-text">Fine Lost</span>
                </div>
              <input class="form-control modalinp" id="modalinpfinelost" value = "${finelost}"  disabled></input>
              <button class="btn btn-info btnmodaledit"><i class="fas fa-edit"></i></button>
              <button class="btn btn-success btnmodalsave" style="display:none;"><i class="fas fa-save"></i></button>
              <button class="btn btn-danger btnmodalcanvel" style="display:none;"><i class="fas fa-ban"></i></button>
              </div>
              <div class="modalnewdiv" style="height:40px;margin: 10px 10px;width:97%">
              <button type="button" class="btn btn-success btnmodalrequest" style="float:left"><i class="fas fa-shopping-basket"></i>   Add to Cart</button>
              <button type="button" class="btn btn-secondary ml-3 btnmodalback" style="float:right"><i class="fas fa-arrow-circle-left"></i>   Back</button>
              <button type="button" class="btn btn-warning ml-3 btnmodalhold" style="float:right"><i class="fas fa-pause-circle"></i>   Hold</button>
              <button type="button" class="btn btn-danger btnmodaldelete" style="float:right"><i class="fas fa-trash-alt"></i>   Delete</button>
              </div>


              `)
                    $.ajax({
                        type: "GET",
                        url: "media/select/selectMediatypes.php",
                        success: function(data) {
                            // console.log("i will get the mediatypes")
                            var jsdata = JSON.parse(data);
                            // console.log(jsdata);
                            for (i in jsdata) {
                                $('#modalselmediatype').append(`
                    <option value = ${jsdata[i].MediaTypeId}>${jsdata[i].MediaTypename}</option>
                    `);
                                $('#modalselmediatype option[value=' + mtId + ']').attr('selected', 'selected');
                                // console.log(mediaId);
                            }
                        }
                    })
                    $.ajax({
                        type: "GET",
                        url: "media/select/selectStatusname.php",
                        success: function(data) {
                            var jsdata = JSON.parse(data);
                            for (i in jsdata) {
                                $('#modalselstatusname').append(`
                  <option value = ${jsdata[i].StatusId}>${jsdata[i].StatusName}</option>
                  `);
                                $('#modalselstatusname option[value=' + sId + ']').attr('selected', 'selected');
                            }

                        }
                    })
                    $.ajax({
                        type: "GET",
                        url: "media/select/selectBranch.php",
                        success: function(data) {
                            // console.log("i wil get the branch");
                            var jsdata = JSON.parse(data);
                            for (i in jsdata) {
                                $('#modalselbranch').append(`
                    <option value = ${jsdata[i].BranchId}>${jsdata[i].Name}</option>
                    `);
                                $('#modalselbranch option[value=' + mbId + ']').attr('selected', 'selected');
                            }
                        }
                    })
                }
            })
            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: "userlevel/getsession.php",
                    success: function(data) {
                        // var jsdata = JSON.parse(data);
                        // userlbl = jsdata;
                        // console.log(data);
                        if (data[1] == 2) {
                            // console.log('level 2');
                            $('.btnmodaldelete').remove();
                            $('.btnmodalhold').remove();
                            $('.btnmodaledit').remove();
                        } else {
                            // console.log('level 1');
                        }
                    }
                })
            })


        })
        // backbuton
    $(document).on('click', '.btnmodalback', function() {
            $('.media-close').trigger('click');
        })
        // delete button
    $(document).on('click', '.btnmodaldelete', function() {
        // console.log(mediaId)
        var del = confirm("This media will be deleted.");
        if (del == true) {
            $.ajax({
                type: "POST",
                url: "media/delete/deletemedia.php",
                data: {
                    mId: mediaId
                },
                success: function(data) {
                    alert("Media Deleted");
                    holdtitle.css('display', 'none');
                }

            })

            $('.media-close').trigger('click');
        }

    })


    // hold media
    $(document).on('click', '.btnmodalhold', function() {
            // console.log(mediaId);
            var del = confirm("This media will be put on hold.");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: "media/hold/putmediaonhold.php",
                    data: {
                        mId: mediaId
                    },
                    success: function(data) {
                        holdtitle.css('display', 'none');
                        $('.media-close').trigger('click');
                        $.toast({
                            text: "Media Placed On Hold.", // Text that is to be shown in the toast
                            heading: 'Success', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
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
            }
        })
        // close button
    $(document).on('click', '.media-close', function() {
            $('#Mymodal').css('display', 'none');
        })
        // modal actions

    $(document).ready(function() {
        var oldval = "";
        $(document).on('click', '.btnmodaledit', function() {
            oldval = $(this).closest('div').find('.modalinp').val();
            // console.log(oldval);
            $('.btnmodaledit').attr('disabled', true);
            $(this).hide();
            $(this).closest('div').find('.btnmodalsave').css('display', 'block');
            $(this).closest('div').find('.btnmodalcanvel').css('display', 'block');
            $(this).closest('div').find('.modalinp').removeAttr('disabled');
        })
        $(document).on('click', '.btnmodalsave', function() {
            $(this).hide();
            $(this).closest('div').find('.btnmodaledit').css('display', 'block');
            $(this).closest('div').find('.btnmodalcanvel').css('display', 'none');
            $(this).closest('div').find('.modalinp').attr('disabled', true);
            $('.btnmodaledit').attr('disabled', false);
            var modalauthor = $('#modalinpauthor').val();
            var modalwriter = $('#modalinpwriter').val();
            var modalmediatype = $('#modalselmediatype').val();
            var modalstatusname = $('#modalselstatusname').val();
            var modalbranch = $('#modalselbranch').val();
            var modallocation = $('#modalinplocation').val();
            var modalfinelate = $('#modalinpfinelate').val();
            var modalfinelost = $('#modalinpfinelost').val();
            var modalinpyearpub = $('#modalinpyearpub').val();
            var modalinptitle = $('#modalinptitle').val();
            $('#modalh1').text(modalinptitle);
            newMediaTitle = $('#modalinptitle').val();
            holdtitle.text(newMediaTitle);

            // console.log(mediaId, modalinptitle, modalauthor, modalwriter, modalmediatype, modalstatusname, modalbranch, modallocation, modalfinelate, modalfinelost);
            $.ajax({
                type: 'POST',
                url: 'media/udpate/updateMedia.php',
                data: {
                    mediaid: mediaId,
                    mediatitle: modalinptitle,
                    author: modalauthor,
                    writer: modalwriter,
                    mediatype: modalmediatype,
                    statusname: modalstatusname,
                    branch: modalbranch,
                    location: modallocation,
                    finelate: modalfinelate,
                    finelost: modalfinelost,
                    yearpub: modalinpyearpub
                },
                success: function(data) {

                    // alert("Update Success!");
                    $.toast({
                        text: "Media Updated!", // Text that is to be shown in the toast
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

            // $.ajax({
            //   type:'POST',
            //   url:'mediaupdate',
            //   data:{
            //     author:modalauthor,
            //     writer:modalauthor,
            //     mediatype:modalmediatype,
            //     statusname:
            //   }
            // })

        })
        $(document).on('click', '.btnmodalcanvel', function() {
            $(this).closest('div').find('.modalinp').val(oldval);
            $(this).hide();
            $(this).closest('div').find('.btnmodalsave').css('display', 'none');
            $(this).closest('div').find('.btnmodaledit').css('display', 'block');
            $(this).closest('div').find('.modalinp').attr('disabled', true);
            $('.btnmodaledit').attr('disabled', false);
        })
        $(document).on('click', '.btnmodalrequest', function() {
            var mediaid = holdtitle.attr('id');
            // $.toast(mediaid);
            var request = confirm("This media will be added to cart.");
            if (request == true) {
                $.ajax({
                    type: "POST",
                    url: "media/request/myrequest.php",
                    data: {
                        mediaId: mediaid
                    },
                    success: function(data) {
                        $('.media-close').trigger('click');
                        holdtitle.remove();
                        $.toast({
                            text: "Media Added to Cart!", // Text that is to be shown in the toast
                            heading: 'Successs', // Optional heading to be shown on the toast
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
            }


        })
    })
})