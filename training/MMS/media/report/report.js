$(document).ready(function() {
    var series = [{
        name: 'Percentage',
        colorByPoint: true,
        data: []
    }];
    var chartdata = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Media In And Out This Month'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: []
    }


    var loadaterfrom = $('#reportdatefrom').val();
    $(document).on('change', '#reportdatefrom', function() {
        var datefrom = $(this).val();
        console.log(loadaterfrom, datefrom);
    })
    $(document).on('change', '#reportdatefrom', function() {
        var dfrom = $('#reportdatefrom').val();
        var dto = $('#reportdateto').val();

        console.log(dfrom, dto)


        if (dfrom != "" && dto != "") {
            console.log('query');
            $.ajax({
                type: "POST",
                url: "media/charts/loadchart.php",
                data: {
                    from: dfrom,
                    to: dto
                },
                success: function(data) {
                    // $.toast('success');
                    $('.newtrreportformto').remove();
                    var jsdata = JSON.parse(data);
                    for (i in jsdata) {
                        $('.tblreports').find('tbody').append(`
                        <tr class="newtrreportformto">
                        <td>${parseInt(i) + 1}</td>
                        <td>${jsdata[i].Title}</td>
                        <td>${jsdata[i].TOTAL}</td>
                        </tr>
                        
                        `);
                    }

                    renderChartData(jsdata)
                }
            })
        }

    })
    $(document).on('change', '#reportdateto', function() {
        var dfrom = $('#reportdatefrom').val();
        var dto = $('#reportdateto').val();


        if (dfrom != "" && dto != "") {
            // console.log('query');
            $.ajax({
                type: "POST",
                url: "media/charts/loadchart.php",
                data: {
                    from: dfrom,
                    to: dto
                },
                success: function(data) {
                    // $.toast('success');
                    $('.newtrreportformto').remove();
                    var jsdata = JSON.parse(data);
                    for (i in jsdata) {
                        $('.tblreports').find('tbody').append(`
                        <tr class="newtrreportformto">
                        <td>${parseInt(i) + 1}</td>
                        <td>${jsdata[i].Title}</td>
                        <td>${jsdata[i].TOTAL}</td>
                        </tr>
                        
                        `);
                    }

                    renderChartData(jsdata)
                }
            })
        }

    })

    function renderChartData(jsdata) {
        series[0].data = []
        for (i in jsdata) {
            series[0].data.push({
                name: (jsdata[i].Title),
                y: (parseInt(jsdata[i].percent)),
                selected: i == 0 ? true : false,
                sliced: i == 0 ? true : false,
            })
        }
        // console.log(jsdata)
        chartdata.series = series;


        $('#container').highcharts(chartdata);
    }

    // var tbodlen = tbod;
    $(document).on('click', '#btnprintfromto', function() {
        var dfrom = $('#reportdatefrom').val();
        var dto = $('#reportdateto').val();
        var tbod = $('.tblreports').find('tbody').children();
        if (tbod.length != 0) {
            if (dfrom != "" && dto != "") {

                var InfoData = {
                    datefrom: dfrom,
                    dateto: dto
                }
                var info = JSON.stringify(InfoData)
                window.open('media/report/pdfmediareport.php?infoData=' + info, '_blank');
            } else {
                $.toast({
                    text: "Please set the date.", // Text that is to be shown in the toast
                    heading: 'Info', // Optional heading to be shown on the toast
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
        } else {
            $.toast({
                text: "No data to print!", // Text that is to be shown in the toast
                heading: 'Information', // Optional heading to be shown on the toast
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
        }



    })
})