$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "userlevel/getsession.php",
        success: function(data) {
            // var jsdata = JSON.parse(data);
            // userlbl = jsdata;
            // console.log(data);
            if (data[1] == 2) {
                // alert('create new queries');
                $.ajax({
                    type: "GET",
                    url: "filtertype.php",
                    success: function(data) {
                        var values = JSON.parse(data)
                        for (i in values) {
                            $('#selType').append('<option value=' + values[i].MediaTypeId + '>' + values[i].MediaTypename + '</option>');
                            // console.log(i);
                        }
                    }
                })
                $.ajax({
                    type: "POST",
                    url: "userlevel_user/filter/filterall.php",
                    success: function(data) {
                        $('.newdiv').remove();
                        var tbltypeval = JSON.parse(data);
                        for (i in tbltypeval) {
                            $('.bookstylediv').append(`<div class="newdiv" 
                                id=${tbltypeval[i].MediaId}  
                                data-mtId=${tbltypeval[i].MediaTypeId}
                                data-mbId=${tbltypeval[i].BranchId}
                                data-sId=${tbltypeval[i].StatusId}
                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                tbltypeval[i].Title +
                                `</div>`)
                        }
                    }
                })
                $(document).on('change', '#selType', function() {
                    $('#inptitle').val('');
                    $('#inpauthor').val('');
                    $('#selYear').val('All');
                    // alert('type changed');
                    var type = $(this).val();
                    // alert(type)
                    if (type == 'All') {
                        $.ajax({
                            type: "POST",
                            url: "userlevel_user/filter/filterall.php",
                            success: function(data) {
                                $('.newdiv').remove();
                                var tbltypeval = JSON.parse(data);
                                for (i in tbltypeval) {
                                    $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                        tbltypeval[i].Title +
                                        `</div>`)
                                }
                            }
                        })
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "userlevel_user/filter/filtermedtype.php",
                            data: {
                                mediatypeid: type
                            },
                            success: function(data) {
                                $('.newdiv').remove();
                                var tbltypeval = JSON.parse(data);
                                for (i in tbltypeval) {
                                    $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                        tbltypeval[i].Title +
                                        `</div>`)
                                }
                            }
                        })
                    }

                })
                $(document).on('keyup', '#inptitle', function() {
                    $('#inpauthor').val("");
                    $('#selYear').val("All");
                    var title = $(this).val();
                    var mediaval = $('#selType').val();
                    if (mediaval != 'All') {
                        // alert(mediaval);
                        // alert('filter media like author with type');
                        $.ajax({
                            type: "POST",
                            url: "userlevel_user/filter/filter_like_and_type.php",
                            data: {
                                type: mediaval,
                                title: title
                            },
                            success: function(data) {
                                // alert('success');
                                $('.newdiv').remove();
                                var tbltypeval = JSON.parse(data);
                                for (i in tbltypeval) {
                                    $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                        tbltypeval[i].Title +
                                        `</div>`)
                                }



                            }
                        })

                    } else if (mediaval == 'All') {
                        if (title == "") {
                            // alert('empty');
                            $.ajax({
                                type: "POST",
                                url: "userlevel_user/filter/filter_all_like_title.php",
                                data: {
                                    title: title
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var tbltypeval = JSON.parse(data);
                                    for (i in tbltypeval) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            tbltypeval[i].Title +
                                            `</div>`)
                                    }



                                }
                            })
                        } else {
                            // alert('filter_like_title.php');
                            $.ajax({
                                type: "POST",
                                url: "userlevel_user/filter/filter_like_title.php",
                                data: {
                                    title: title
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var tbltypeval = JSON.parse(data);
                                    for (i in tbltypeval) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            tbltypeval[i].Title +
                                            `</div>`)
                                    }

                                }
                            })
                        }
                    }





                    // alert(title);

                })
                $(document).on('keyup', '#inpauthor', function() {
                        $('#inptitle').val("");
                        $('#selYear').val("All");
                        var type = $('#selType').val();
                        var author = $('#inpauthor').val();
                        if (type == 'All') {
                            if (author == "") {
                                $.ajax({
                                    type: "POST",
                                    url: "userlevel_user/filter/filter_all_author.php",

                                    success: function(data) {
                                        $('.newdiv').remove();
                                        var tbltypeval = JSON.parse(data);
                                        for (i in tbltypeval) {
                                            $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                tbltypeval[i].Title +
                                                `</div>`)
                                        }


                                    }
                                })
                            } else if (author != "") {

                                $.ajax({
                                    type: "POST",
                                    url: "userlevel_user/filter/filter_author_and_type.php",
                                    data: {
                                        author: author
                                    },
                                    success: function(data) {
                                        $('.newdiv').remove();
                                        var tbltypeval = JSON.parse(data);
                                        for (i in tbltypeval) {
                                            $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                tbltypeval[i].Title +
                                                `</div>`)
                                        }

                                    }
                                })
                            }
                            // alert('filter all by author')

                        } else {
                            // alert('filter author with type')
                            $.ajax({
                                type: "POST",
                                url: "userlevel_user/filter/filter_author_with_type.php",
                                data: {
                                    mediatype: type,
                                    author: author
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var tbltypeval = JSON.parse(data);
                                    for (i in tbltypeval) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                                        id=${tbltypeval[i].MediaId}  
                                        data-mtId=${tbltypeval[i].MediaTypeId}
                                        data-mbId=${tbltypeval[i].BranchId}
                                        data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            tbltypeval[i].Title +
                                            `</div>`)
                                    }

                                }
                            })
                        }
                    })
                    // $(document).on('change', '#selYear', function() {
                    //     var type = $('#selType').val();
                    //     if (type == "All") {
                    //         alert('filter just the date')
                    //     }
                    // })
            } else {
                // admin functions
                // alert('copy paste');
                $(document).ready(function() {
                        $.ajax({
                            type: "GET",
                            url: "filtertype.php",
                            success: function(data) {
                                var values = JSON.parse(data)
                                for (i in values) {
                                    $('#selType').append('<option>' + values[i].MediaTypename + '</option>');
                                    // console.log(i);
                                }
                                // if type is All
                                if ($('#selType').val() == 'All') {
                                    $.ajax({
                                        type: "GET",
                                        url: "filteralltypetbl.php",
                                        success: function(data) {
                                            $('.newdiv').remove();
                                            var tbltypeval = JSON.parse(data);
                                            for (i in tbltypeval) {
                                                $('.bookstylediv').append(`<div class="newdiv" 
                                id=${tbltypeval[i].MediaId}  
                                data-mtId=${tbltypeval[i].MediaTypeId}
                                data-mbId=${tbltypeval[i].BranchId}
                                data-sId=${tbltypeval[i].StatusId}
                                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                    tbltypeval[i].Title +
                                                    `</div>`)
                                            }
                                        }
                                    })
                                } else {
                                    $(document).ready(function() {
                                        var type = $('#selType').val();
                                        // console.log(type);
                                        $.ajax({
                                            type: "POST",
                                            url: "filtertypetbl.php",
                                            data: {
                                                mediaType: type,
                                            },
                                            success: function(data) {
                                                var tbltypeval = JSON.parse(data);
                                                for (i in tbltypeval) {
                                                    $('.bookstylediv').append(`<div class="newdiv" 
                                    id=${tbltypeval[i].MediaId}
                                    data-mtId=${tbltypeval[i].MediaTypeId}
                                    data-mbId=${tbltypeval[i].BranchId}
                                    data-sId=${tbltypeval[i].StatusId}
                        style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                            tbltypeval[i].Title +
                                                            `</div>`)
                                                        //     $('.mediatable').append(`<tr class='newtr'>
                                                        // <td class='mediatitle'>` + tbltypeval[i].Title + `</td>
                                                        // <td class='mediatype'>` + tbltypeval[i].MediaTypename + `</td>
                                                        // <td class=''mediaid>` + tbltypeval[i].MediaId + `</td>
                                                        // <td class='mediastatus'>` + tbltypeval[i].StatusName + `</td>
                                                        // <td class='medialocation'>` + tbltypeval[i].MediaLocation + `</td>
                                                        // <td class='mediawriter'>` + tbltypeval[i].Writer + `</td>
                                                        // <td class='mediaauthordir'>` + tbltypeval[i].Author + `</td>
                                                        // <td class='mediaauthordir'>` + tbltypeval[i].YearPub + `</td>
                                                        // </tr>`)

                                                }
                                            }
                                        })
                                    })
                                }




                            }
                        })

                    })
                    // combobox selected index changed
                $(document).ready(function() {
                    $(document).on('change', '#selType', function() {
                        $('.newdiv').remove();
                        var changedtype = $(this).val();
                        if (changedtype == 'All') {
                            $.ajax({
                                type: "GET",
                                url: "filteralltypetbl.php",
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var tbltypeval = JSON.parse(data);
                                    for (i in tbltypeval) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${tbltypeval[i].MediaId} 
                        data-mtId=${tbltypeval[i].MediaTypeId}
                        data-mbId=${tbltypeval[i].BranchId}
                        data-sId=${tbltypeval[i].StatusId}
                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                tbltypeval[i].Title +
                                                `</div>`)
                                            // $('.mediatable').append(`<tr class='newtr'>
                                            // <td class='mediatitle '>` + tbltypeval[i].Title + `</td>
                                            // <td class='mediatype'>` + tbltypeval[i].MediaTypename + `</td>
                                            // <td class=''mediaid>` + tbltypeval[i].MediaId + `</td>
                                            // <td class='mediastatus'>` + tbltypeval[i].StatusName + `</td>
                                            // <td class='medialocation'>` + tbltypeval[i].MediaLocation + `</td>
                                            // <td class='mediawriter'>` + tbltypeval[i].Writer + `</td>
                                            // <td class='mediaauthordir'>` + tbltypeval[i].Author + `</td>
                                            // <td class='mediaauthordir'>` + tbltypeval[i].YearPub + `</td>
                                            // </tr>`)
                                    }
                                }
                            })
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "filtertypetbl.php",
                                data: {
                                    mediaType: changedtype,
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var tbltypeval = JSON.parse(data);
                                    for (i in tbltypeval) {
                                        $('.bookstylediv').append(`<div class="newdiv " 
                        id=${tbltypeval[i].MediaId} 
                        data-mtId=${tbltypeval[i].MediaTypeId}
                        data-mbId=${tbltypeval[i].BranchId}
                        data-sId=${tbltypeval[i].StatusId}
                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                                tbltypeval[i].Title +
                                                `</div>`)
                                            // $('.mediatable').append(`<tr class='newtr'>
                                            // <td class='mediatitle '>` + tbltypeval[i].Title + `</td>
                                            // <td class='mediatype'>` + tbltypeval[i].MediaTypename + `</td>
                                            // <td class=''mediaid>` + tbltypeval[i].MediaId + `</td>
                                            // <td class='mediastatus'>` + tbltypeval[i].StatusName + `</td>
                                            // <td class='medialocation'>` + tbltypeval[i].MediaLocation + `</td>
                                            // <td class='mediawriter'>` + tbltypeval[i].Writer + `</td>
                                            // <td class='mediaauthordir'>` + tbltypeval[i].Author + `</td>
                                            // <td class='mediaauthordir'>` + tbltypeval[i].YearPub + `</td>
                                            // </tr>`)

                                        // console.log(tbltypeval[i].MediaTypename);
                                        // console.log(JSON.parse(data)[i].MediaTypename);
                                        // console.log(JSON.parse(data)[i].StatusName);
                                        // console.log(JSON.parse(data)[i].Title);
                                        // console.log(JSON.parse(data)[i].Writer);
                                        // console.log(JSON.parse(data)[i].YearPub);





                                        //   $('.mediatable').append

                                    }
                                }
                            })
                        }
                    })
                })
                $(document).ready(function() {
                    $(document).on('keyup', '#inptitle', function() {
                        var inp = $(this).val();
                        var typ = $('#selType').val();
                        // console.log(inp);
                        if (typ == 'All') {
                            $.ajax({
                                type: "POST",
                                url: "filterlike.php",
                                data: {
                                    inptitle: inp,
                                    inptype: typ,
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    // console.log("success");
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId} 
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId}
                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }

                                }
                            })
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "filterlike_type.php",
                                data: {
                                    inptitle: inp,
                                    inptype: typ,
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    // console.log("success");
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId}
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId}
                style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }

                                }
                            })
                        }
                    })
                })

                // author
                $(document).ready(function() {
                    $(document).on('keyup', '#inpauthor', function() {
                        var inp = $(this).val();
                        var type = $('#selType').val();
                        // console.log(type);
                        if (type == 'All') {
                            $.ajax({
                                type: "POST",
                                url: "filter/filterauthor.php",
                                data: {
                                    inputauthor: inp
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId}
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId} 
              style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }
                                }
                            })
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "filter/filterauthor_type.php",
                                data: {
                                    likeinpauthor: inp,
                                    medtype: type
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId}
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId} 
              style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }

                                }
                            })

                        }
                    })
                })

                $(document).ready(function() {
                    $(document).on('change', '#selType', function() {
                        // alert("Nandito ka sa MediaTypes!");
                        $('#inptitle').val("");
                        $('#inpauthor').val("");
                        $('#selYear').val("All");
                        $('#selBranch').val("All");
                    })
                    $(document).on('click', '#inptitle', function() {
                        $('#inpauthor').val("");
                        $('#selYear').val("All");
                        $('#selBranch').val("All");
                    })
                    $(document).on('click', '#inpauthor', function() {
                        $('#inptitle').val("");
                        $('#selYear').val("All");
                        $('#selBranch').val("All");

                    })
                    $(document).on('change', '#selYear', function() {
                        $('#inptitle').val("");
                        $('#inpauthor').val("");
                        $('#selBranch').val("All");
                    })
                    $(document).on('change', '#selBranch', function() {
                        $('#inptitle').val("");
                        $('#inpauthor').val("");
                        $('#selYear').val("All");
                        $('#selType').val("All");
                    })

                })

                $(document).ready(function() {
                    $.ajax({
                        type: "POST",
                        url: "media/select/selectBranch.php",
                        success: function(data) {
                            var jsdata = JSON.parse(data);
                            for (i in jsdata) {
                                $('#selBranch').append(`
                // <option value=` + jsdata[i].BranchId + `>` + jsdata[i].Name + `</option>
                `);
                            }

                        }
                    })


                    $(document).on('change', '#selBranch', function() {
                        var branch = $("#selBranch option:selected").text();
                        var branchid = $(this).val();
                        // alert(branch + branchid);

                        if (branch == 'All') {
                            // alert('All');
                            $.ajax({
                                type: "POST",
                                url: "filter/filterallbranch.php",
                                success: function(data) {
                                    // alert('allbranch');
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId}
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId} 
              style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }
                                }
                            })
                            $
                        } else {
                            // alert(branchid);
                            $.ajax({
                                type: "POST",
                                url: "filter/filterbranch.php",
                                data: {
                                    branchid: branchid
                                },
                                success: function(data) {
                                    $('.newdiv').remove();
                                    var getdata = JSON.parse(data);
                                    for (i in getdata) {
                                        $('.bookstylediv').append(`<div class="newdiv" 
                        id=${getdata[i].MediaId}
                        data-mtId=${getdata[i].MediaTypeId}
                        data-mbId=${getdata[i].BranchId}
                        data-sId=${getdata[i].StatusId} 
              style="margin:10px 10px 10px 10px ;position:relative;float:left; height:150px; width:120px;text-align:center;border: 1px solid black;background-color:rgba(192,192,192,0.3);">` +
                                            getdata[i].Title +
                                            `</div>`)
                                    }

                                }
                            })
                        }
                    })
                })
            }
        }
    })
})