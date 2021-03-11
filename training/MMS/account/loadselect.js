$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "account/selectbranch.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log(jsdata);
            for (i in jsdata) {
                $('#adnacbranch').append(`
                <option value="${jsdata[i].BranchId}">${jsdata[i].Name}</option>
                `);
            }
        }
    })
    $.ajax({
        type: "POST",
        url: "account/selectuserlevel.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log(jsdata);
            for (i in jsdata) {
                $('#adnacuserlvl').append(`
                <option value="${jsdata[i].UserLevelId}">${jsdata[i].UserLevelName}</option>
                `);
            }
        }
    })
    $(document).on('click', '#btnaddnewacc', function() {

    })
})