// customer

$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "Myaccount/getcustomeracc.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log(jsdata);
            for (i in jsdata) {
                $('.tblcusacc').find('tbody').append(`
            <tr class="cusacctr">
            <td>${jsdata[i].CardNumber}</td>
            <td>${jsdata[i].Branch}</td>
            <td>${jsdata[i].UserLevelName}</td>
            <td>${jsdata[i].Name}</td>
            <td>${jsdata[i].Address}</td>
            <td>${jsdata[i].ContactNumber}</td>
            <td>${jsdata[i].BirthDate}</td>
            <td>${jsdata[i].Username}</td>
            </tr>
            `);
            }

        }
    })

})
$(document).ready(function() {
    $(document).on('keyup', '#inpcustomercard', function() {
        var inpt = $(this).val();
        $.ajax({

            type: "POST",
            url: "Myaccount/getcustomeraccwhere.php",
            data: {
                input: inpt
            },
            success: function(data) {
                var jsdata = JSON.parse(data);
                // console.log(jsdata);
                $('.cusacctr').remove();
                for (i in jsdata) {
                    $('.tblcusacc').find('tbody').append(`
            <tr class="cusacctr">
            <td>${jsdata[i].CardNumber}</td>
            <td>${jsdata[i].Branch}</td>
            <td>${jsdata[i].UserLevelName}</td>
            <td>${jsdata[i].Name}</td>
            <td>${jsdata[i].Address}</td>
            <td>${jsdata[i].ContactNumber}</td>
            <td>${jsdata[i].BirthDate}</td>
            <td>${jsdata[i].Username}</td>
            </tr>
            `);
                }
            }
        })
    })
})



// employee

$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "Myaccount/getemployeeacc.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log(jsdata);
            $('.accemptr').remove();
            for (i in jsdata) {
                $('.tblempacc').find('tbody').append(`
            <tr class="accemptr">
            <td>${jsdata[i].CardNumber}</td>
            <td>${jsdata[i].Branch}</td>
            <td>${jsdata[i].UserLevelName}</td>
            <td>${jsdata[i].Name}</td>
            <td>${jsdata[i].Address}</td>
            <td>${jsdata[i].ContactNumber}</td>
            <td>${jsdata[i].BirthDate}</td>
            <td>${jsdata[i].Username}</td>
            </tr>
            `);
            }

        }
    })

})
$(document).ready(function() {
    $(document).on('keyup', '#impempacccard', function() {
        var inpt = $(this).val();
        $.ajax({

            type: "POST",
            url: "Myaccount/getemployeeaccwhere.php",
            data: {
                input: inpt
            },
            success: function(data) {
                var jsdata = JSON.parse(data);
                // console.log(jsdata);
                $('.accemptr').remove();
                for (i in jsdata) {
                    $('.tblempacc').find('tbody').append(`
            <tr class="accemptr">
            <td>${jsdata[i].CardNumber}</td>
            <td>${jsdata[i].Branch}</td>
            <td>${jsdata[i].UserLevelName}</td>
            <td>${jsdata[i].Name}</td>
            <td>${jsdata[i].Address}</td>
            <td>${jsdata[i].ContactNumber}</td>
            <td>${jsdata[i].BirthDate}</td>
            <td>${jsdata[i].Username}</td>
            </tr>
            `);
                }
            }
        })
    })
})