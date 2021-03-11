<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>
<input id="rows" placeholder="Enter no. of rows" style="padding:5px" type="number" ></input>
<button id="btnrows" type="button" class ="btn btn-primary">Enter</button>
<table class="table table-bordered" id="mytable">
    <thead>
        <tr>
            <td>#</td>
            <td>INPUT 1</input></td>
            <td>INPUT 2</td>
            <td>INPUT 3</td>
            <td>SUM</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
<script src="https://code.jquery.com/jquery-3.5.1.slim.js"></script>
<script>
    var _rows = 0;
    var trows = 0;
    $(document).ready(function(){
        $('#btnrows').click(function(){          
            _rows = $('#rows').val();
            trows += parseInt(_rows);
        })
    })
    $(document).ready(function(){
        $('#btnrows').click(function(){
            $.fn.rowCount = function(){
                return $('tr',$(this).find('tbody')).length;
            };
            var rcount = $('.table').rowCount();
            for(var i = 1; i <= _rows; i++){
                ctr = rcount + i;
                $('tbody').append('<tr class="newcol"><td class="id">'+ctr+'</td><td><input type="number" id="inputs"></input></td><td><input type="number" id="inputs"></input></td><td><input type="number" id="inputs"></input></td ><td id="total">0</td></tr>')
            }
        })
        $(document).on('keyup','#inputs',function(){       
            var currentRow = $(this).closest("tr");
            var input1 = currentRow.find("td:eq(1)").children().val();
            var input2 = currentRow.find("td:eq(2)").children().val();
            var input3 = currentRow.find("td:eq(3)").children().val();
            if(input1 != "" && input2 != "" && input3 != ""){
            var total = parseInt(input1) + parseInt(input2) + parseInt(input3);
            currentRow.find("td:eq(4)").html(total);
            $.fn.rowCount = function(){
                return $('tr',$(this).find('tbody')).length;
            };
            var rcount = $('.table').rowCount();
            var grand_total = 0;
            for(var i = 0; i <= rcount - 1; i++){
                var totals = parseInt($('tbody').find('tr').eq(i).children().eq(4).text());
                grand_total += totals;
            }
            $('#grandtotal').text(grand_total);           
            }        
        })
    })
</script>
<h3 style="float:right;margin-right:50px" id="grandtotal"></h3>
<h3 style="float:right;margin-right:50px">Total:</h3>
</body>
</html>