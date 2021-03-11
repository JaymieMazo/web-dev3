try {
    $.ajax({
        type: "GET",
        url: "media/select/selectMediatypes.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log("i will get media types");
            for (i in jsdata) {
                $('#adnmediatyp').append(`
                <option value = ${jsdata[i].MediaTypeId}>${jsdata[i].MediaTypename}</option>`)
            }


        }
    })
} catch (error) {

}
try {
    $.ajax({
        type: "GET",
        url: "media/select/selectBranch.php",
        success: function(data) {
            var jsdata = JSON.parse(data);
            // console.log("i will get media types");
            for (i in jsdata) {
                $('#adnmedbranch').append(`
                <option value = ${jsdata[i].BranchId}>${jsdata[i].Name}</option>`)

            }



        }
    })
} catch (error) {

}

// $(document).ready(function() {
//     $(document).on('click', '#btnadnmedia', function() {
//         alert("jumbotron")
//     })
// })