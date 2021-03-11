<?php
 try{
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('SELECT * FROM employees');
    $max = $pdo->query('SELECT MAX(id) from employees');
    $data =$stmt->fetchAll();
    $maxid =$max->fetchAll();
    // print_r($data);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
    input[type=number] {
  -moz-appearance: textfield;
}
    </style>
</head>
<body>
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
        <tbody id="maintbody">
            <?php
                foreach($data as $key=>$val){
            ?>
            <tr>
                <td class="id"><?=$val['id']?></td>
                <td class="fName"><?=$val['firstName']?></td>
                <td class="lName"><?=$val['lastName']?></td>
                <td class="contactNo"><?=$val['contactNumber']?></td>
                <td>
                    <button class="btn btn-success confirm" style="display:none">Done</button>
                    <button class="btn btn-danger delete" data-id="<?=$val['id']?>" data-key="<?=$key?>">Delete</button>
                    <button class="btn btn-info edit" style="margin-left:4px">Edit</button>
                    <button class="btn btn-warning cancel" style="display:none;margin-left:4px">Cancel</button>
                </td>
            </tr>

            <?php
                }
            ?>
        </tbody>
        
    </table>
    <center>
    <button type="button" class="btn btn-primary btn-lg" id="myBtn" >Add Info</button>
    </center>
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
            <table class="table table-bordered tablemodal">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="mtbody">
            <tr>
                <?php
                foreach($maxid as $key=>$val){
                ?>
                    <td class="mid" id="iddd"></td>
                    <td class="mfname">
                        <input class="form-control" type="text" name="mfirstName" id="">
                    </td >
                    <td class="mlname">
                        <input class="form-control" type="text" name="mlasttName" id="">
                    </td>
                    <td class="mcno">
                        <input class="form-control" type="text"  name="mcontactNumber"id="">
                    </td>
                    <td>
                        <button class="btn btn-success addsingle">Add</button>
                    </td>
                    <?php
                    }
                    ?>
                </tr>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="mcancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
    </div>
    <!-- modal popup -->
    <script>
    $(document).ready(function(){
        $('#myBtn').click(function(){
                $('#myModal').modal();
                
        
                $.ajax({
                type:"GET",
                url:"getmaxid.php",
                success: function(data){
                    $('#iddd').text(parseInt(JSON.parse(data)[0].id)+1)
                }
                
                
            })            })
    })
    </script>
    <script>
    
    $(document).ready(function(){
        $(document).on('click','.addsingle',function(){
            var currentRow = $(this).closest('tr')
            var nid = currentRow.find('.mid').text();
            var nfname = currentRow.find('.mfname').children().val();
            var nlname = currentRow.find('.mlname').children().val();
            var ncno = currentRow.find('.mcno').children().val();
            // console.log(nid, nfname, nlname, ncno);

            $.ajax({
                type:"POST",
                url:"addsingle.php",
                data: {
                    ajfname:nfname,
                    ajlname:nlname,
                    ajcno:ncno
                },
                success: function(data){
                    
                    console.log("success");
                    $.ajax({
                type:"GET",
                url:"getlastrecord.php",
                success: function(data){
                    $('#mcancel').trigger('click');
                    console.log(parseInt(JSON.parse(data)[0].id));
                    console.log(JSON.parse(data)[0].firstName);
                    $('#maintbody').append(`<tr>
                <td class="id">`+ parseInt(JSON.parse(data)[0].id) +`</td>
                <td class="fName">`+ JSON.parse(data)[0].firstName +`</td>
                <td class="lName">`+ JSON.parse(data)[0].lastName +`</td>
                <td class="contactNo">`+ JSON.parse(data)[0].contactNumber +`</td>
                <td>
                    <button class="btn btn-success confirm" style="display:none">Done</button>
                    <button class="btn btn-danger delete" data-id="`+  parseInt(JSON.parse(data)[0].id) +`" data-key="">Delete</button>
                    <button class="btn btn-info edit" style="margin-left:4px">Edit</button>
                    <button class="btn btn-warning cancel" style="display:none;margin-left:4px">Cancel</button>
                </td>
            </tr>`)
                    
                }
            })
                }
                
                
            })

            
            
        })

    })
    

    </script>


    <!-- delete,edit, and save button function -->
    <script>
        var fnv;
        var lnv;
        var cnv;
        var idv;
        $(document).ready(function(){

            $(document).on('click','.delete',function(){
                // console.log( $('tbody').find('tr').eq($(this).attr("data-key")))
                var self = $(this)
                $.ajax({
                type: "POST",
                url: "delete.php",
                data: {id:$(this).attr("data-id")},
                success: function(data){
                    self.parent().parent().remove()
                    
                }
                });
            })
        })
        $(document).ready(function(){
            $(document).on('click','.edit',function(){
                var currentRow = $(this).closest('tr');
                // show other buttons that not selected
                $('.confirm').hide();
                $('.delete').show();
                $('.edit').show();
                $('.cancel').hide();
                // disable other buttons that are not selected
                $('.delete').prop('disabled',true)
                $('.edit').prop('disabled',true)
                // show the done and cancel button
                currentRow.find('.confirm').css({'display':'block','float':'left'});
                currentRow.find('.delete').css({'display':'none','float':'left'});
                currentRow.find('.edit').css({'display':'none','float':'left'});
                currentRow.find('.cancel').css({'display':'block','float':'left'})
                idv = currentRow.find('.id').text();
                //get the old values then insert textbox
                fnv = currentRow.find('.fName').text();
                currentRow.find('.fName').html('<input value="'+fnv+'"></input>');

                lnv = currentRow.find('.lName').text();
                currentRow.find('.lName').html('<input value="'+lnv+'"></input>');

                cnv = currentRow.find('.contactNo').text();
                currentRow.find('.contactNo').html('<input type="number" value="'+cnv+'"></input>');

                
            })
        })
        $(document).ready(function(){
            $(document).on('click','.cancel',function(){
                // disabled the buttons that not selected
                $('.delete').prop('disabled',false)
                $('.edit').prop('disabled',false)
                var currentRow = $(this).closest('tr');
                //set all button to show delete and edit button
                $('.confirm').hide();
                $('.delete').show();
                $('.edit').show();
                $('.cancel').hide();
                //set the selected row to done and cancel
                currentRow.find('.fName').html(fnv);
                currentRow.find('.lName').html(lnv);
                currentRow.find('.contactNo').html(cnv);

                //wala lang
                currentRow.find('.lName').children().val();
                
                currentRow.find('.contactNo').children().val();
     

            })
        })

        //saving function
        $(document).ready(function(){
            $(document).on('click','.confirm',function(){
                //get the new values
                var nfn = $(this).closest('tr').find('.fName').children().val();
                var nln = $(this).closest('tr').find('.lName').children().val();
                var ncn = $(this).closest('tr').find('.contactNo').children().val();


                //sends the new values to save.php
                var self = $(this)
                $.ajax({
                    url:"save.php",
                    type:"POST",
                    data: { nid:idv,
                            nfirstName:nfn,
                            nlastName:nln,
                            ncontactNo:ncn
                            },
                    success: function(data){
                            //static update of records in table
                            self.closest('tr').find('.fName').html(nfn);
                            self.closest('tr').find('.lName').html(nln);
                            self.closest('tr').find('.contactNo').html(ncn);
                            //turning design to defalut
                            $('.delete').prop('disabled',false)
                            $('.edit').prop('disabled',false)
                            $('.confirm').hide();
                            $('.delete').show();
                            $('.edit').show();
                            $('.cancel').hide();
                            //displaying output in console.log
                            console.log(self.closest('tr').find('.fName').html());
                            console.log(self.closest('tr').find('.lName').html());
                            console.log(self.closest('tr').find('.contactNo').html());
                            console.log("DataUpdated");
                        
                        
                    }
                    
                })


            })
        })


        
    </script>
</body>
</html>