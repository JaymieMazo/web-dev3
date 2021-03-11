// check if the media was on duedate




// display media on checkedOut
$(document).on('keyup', '#impretmed', function() {
    var ridinp = $('#impretmed').val();
    // $.toast(ridinp);
    // console.log(ridinp)
    $.ajax({
        type: "POST",
        url: "media/return/displaymediacout.php",
        data: {
            recordid: ridinp
        },
        success: function(data) {
            $('.retmedtr').remove();
            var jsdata = JSON.parse(data);
            // console.log(jsdata.length);
            // console.log(jsdata);
            for (i in jsdata) {
                $('.tblreturnmedia').find('tbody').append(`
                <tr class="retmedtr">
                <td>${jsdata[i].RecordId}</td>
                <td>${jsdata[i].MediaId}</td>
                <td>${jsdata[i].Title}</td>
                <td>${jsdata[i].StatusName}</td>
                <td>${jsdata[i].DateIssued}</td>
                <td>${jsdata[i].DateDue}</td>
                <td>${jsdata[i].Fine}</td>
                <td>
                <div class="btn-group">
                <button class="btn btn-success" id="btnretmed">Return Media</button>
                <button class="btn btn-danger" id="btnlostmed">Lost</button>
                <div>
                </td>
                
                </tr>
            `);
            }



        }

    })
})

//keydown on impretmed
// $(document).on('keydown', '#impretmed', function() {
//     $('#impretmed').val("");
// })


// returnmedia function
$(document).on('click', '#btnretmed', function() {
    // $.toast('hehe');
    var medid = $(this).closest('tr').find('td:eq(1)').text();
    var medrid = $(this).closest('tr').find('td:eq(0)').text();
    var me = $(this);
    var returned = "";
    var totalmedco = "";
    var stat = "";
    // update the medias.statudid and set curdate() on recordsdetails.DateReturned
    var ret = confirm("Are you sure?");
    if (ret == true) {


        $.ajax({
            type: "POST",
            url: "media/return/updatemediastatusid.php",
            data: {
                mediaid: medid,
                medrecordid: medrid
            },
            success: function(data) {
                me.closest('tr').remove();



                // get the length of medias checked out where recordid = medrid
                $.ajax({
                    type: "POST",
                    url: "media/return/getlengthofmedia.php",
                    data: {
                        recordid: medrid
                    },
                    success: function(data) {
                        var jsdata = JSON.parse(data);
                        totalmedco = jsdata.length;
                        // alert('Total Length: ' + totalmedco);

                        // get the length of returned media where recordid = medrid
                        $.ajax({
                            type: "POST",
                            url: "media/return/getlengthofreturned.php",
                            data: {
                                recordid: medrid
                            },
                            success: function(data) {
                                var jsdata = JSON.parse(data);
                                returned = jsdata.length;
                                // alert('Length of Returned: ' + returned)
                                stat = 'Returned (' + returned + '/' + totalmedco + ')';
                                // alert(stat);

                                // updates the Remark of records.Remarks WHERE recordid  = medrid
                                if (returned < totalmedco) {
                                    // alert("Returned (qwe/qwe)");
                                    $.ajax({
                                        type: "POST",
                                        url: "media/return/updateremarks.php",
                                        data: {
                                            newremarks: stat,
                                            recordid: medrid
                                        },
                                        succcess: function(data) {

                                        }
                                    })
                                } else {
                                    // alert("Returned");
                                    $.ajax({
                                        type: "POST",
                                        url: "media/return/updatemarks2.php",
                                        data: {
                                            recordid: medrid
                                        },
                                        success: function(data) {

                                        }
                                    })
                                }

                            }
                        });

                    }
                });

            }
        });
    }

    // $.toast(medid);
    // $.toast(medrid);
})

// sets fine
$(document).ready(function(data) {
    $.ajax({
        type: "POST",
        url: "media/return/calcfine.php",

        success: function(data) {
            var jsdata = JSON.parse(data);
            for (i in jsdata) {
                // alert(jsdata[i].RecordId + jsdata[i].Title + jsdata[i].Status);
                if (jsdata[i].Status == 'set fine') {
                    var r = jsdata[i].RecordId;
                    var m = jsdata[i].MediaId;
                    var f = jsdata[i].FineLate
                        // alert(r + "--" + m + "--" + "set fine: " + f);
                    $.ajax({
                        type: "POST",
                        url: "media/return/setfine.php",
                        data: {
                            recordid: r,
                            mediaid: m,
                            finelate: f
                        },
                        success: function(data) {
                            // alert("fine sets!");
                            // alert(jsdata[i].RecordId + ": " + "Due Date!");

                        }
                    });

                } else {
                    // alert(jsdata[i].RecordId + "--" + jsdata[i].MediaId + "--" + " good");


                }
            }
        }
    })
})


// lost media function
$(document).ready(function() {
    $(document).on('click', '#btnlostmed', function() {
        var lost = confirm("This media will be set as 'Lost'");


        if (lost == true) {
            var medid = $(this).closest('tr').find('td:eq(1)').text();
            var medrid = $(this).closest('tr').find('td:eq(0)').text();
            var me = $(this);
            var returned = "";
            var totalmedco = "";
            var stat = "";
            $.ajax({
                type: "POST",
                url: "media/return/lostmeduprecdet.php",
                data: {
                    recordid: medrid,
                    mediaid: medid
                },
                success: function(data) {
                    alert('record details fine updated!');


                    // update medias deleteddate and statudid
                    $.ajax({
                        type: "POST",
                        url: "media/return/lostmedupmeds.php",
                        data: {
                            mediaid: medid
                        },
                        success: function(data) {
                            alert('media deteleddate and statusid updated!');


                            me.closest('tr').remove();



                            // get the length of medias checked out where recordid = medrid
                            $.ajax({
                                type: "POST",
                                url: "media/return/getlengthofmedia.php",
                                data: {
                                    recordid: medrid
                                },
                                success: function(data) {
                                    var jsdata = JSON.parse(data);
                                    totalmedco = jsdata.length;
                                    // alert('Total Length: ' + totalmedco);

                                    // get the length of returned media where recordid = medrid
                                    $.ajax({
                                        type: "POST",
                                        url: "media/return/getlengthofreturned.php",
                                        data: {
                                            recordid: medrid
                                        },
                                        success: function(data) {
                                            var jsdata = JSON.parse(data);
                                            returned = jsdata.length;
                                            // alert('Length of Returned: ' + returned)
                                            stat = 'Returned (' + returned + '/' + totalmedco + ')';
                                            // alert(stat);

                                            // updates the Remark of records.Remarks WHERE recordid  = medrid
                                            if (returned < totalmedco) {
                                                // alert("Returned (qwe/qwe)");
                                                $.ajax({
                                                    type: "POST",
                                                    url: "media/return/updateremarks.php",
                                                    data: {
                                                        newremarks: stat,
                                                        recordid: medrid
                                                    },
                                                    succcess: function(data) {

                                                    }
                                                })
                                            } else {
                                                // alert("Returned");
                                                $.ajax({
                                                    type: "POST",
                                                    url: "media/return/updatemarks2.php",
                                                    data: {
                                                        recordid: medrid
                                                    },
                                                    success: function(data) {

                                                    }
                                                })
                                            }

                                        }
                                    });

                                }
                            });
                        }
                    });
                }
            })
        }

        // recorddetails fine update 


    })
})




// uncomment for barcode scanner
// $(document).ready(function() {

//     var action = 0;
//     $(document).on('keyup', '#impretmed', function() {

//         action = action + 1;
//         // alert(action);
//         if (action == 2) {
//             $(document).find('#impretmed').val('');
//             action = 0;
//         }
//     })
// })