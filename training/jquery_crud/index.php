<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>CRUD</title>
</head>
<body>
    <!-- <form action="add.php" method="POST"> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <input class="form-control" type="text" name="firstName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="lasttName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text"  name="contactNumber[]"id="">
                    </td>
                    <td>
                        <!-- <button class="btn btn-primary">Edit</button> -->
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <input class="form-control" type="text" name="firstName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="lasttName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text"  name="contactNumber[]"id="">
                    </td>
                    <td>
                        <!-- <button class="btn btn-primary">Edit</button> -->
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <input class="form-control" type="text" name="firstName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="lasttName[]" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text"  name="contactNumber[]"id="">
                    </td>
                    <td>
                        <!-- <button class="btn btn-primary">Edit</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    <input type="button" class="btn btn-secondary submit" value="Submit">
    <!-- </form> -->

    <script>
        $(document).ready(function(){
            $('.submit').click(function(){
               var details = [];
               for(var x= 0; x<$('tbody').find('tr').length; x++){
                  details.push({
                      firstName: $('tbody').find('tr').eq(x).children().eq(1).children().val(),
                      lastName: $('tbody').find('tr').eq(x).children().eq(2).children().val(),
                      contactNumber: $('tbody').find('tr').eq(x).children().eq(3).children().val()
                    }) 
               }
                $.ajax({
                type: "POST",
                url: "add.php",
                data: {details:details},
                success: function(data){
                    console.log(data)
                }
                });
            })
        })
    </script>
</body>
</html>