<?php
session_start();
if ($_SESSION['webpass'] != 'passthrough'){
    $_SESSION['webpass'] = 'invalid';
}
if (isset($_SESSION)) {
  
  if ($_SESSION['webpass'] == "passthrough")  {
    //   echo $_SESSION;
    header("Location:employee_page.php");
    exit();
  } else {
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script>src="https://code.jquery.com/jquery-3.5.1.min.js"</script>
<link rel="stylesheet" href="customer_signup.css">

<link rel="stylesheet" href="date_picker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="login_page.css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script>src="https://code.jquery.com/jquery-3.5.1.min.js"</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .animate{
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s;
        }
        @keyframes animatezoom{
            from {-webkit-transform: scale(0)} to {-webkit-transform:scale(1)}
        }
        @keyframes animatezoom{
            from {transform: scale(0)} to {transform:scale(1)}
        }
</style>
</head>
<body>
<div class="bg-image">
    <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1" style="background-color:white;display:none">
                    <h3>Login as Customer</h3>
                    <form action ='customer_login.php' method='POST'>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username *" name = "c_uname" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password *" name = "c_pass" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btnSubmit" value="Login" id="customerlogin" />
                        </div>
                        <div class="form-group">                        
                            <!-- <a href="#" >Forget Password?</a><br> -->
                            <a onclick="document.getElementById('id01').style.display='block'" class="ForgetPwd">Get a Library Card</a> 
                            <div id="id01" class="modal animate" style="width:100%;height:100%">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                </form>
                                <form class="modal-content" style="padding:0% 10% 10% 10%" >
                                    <div class="container" >
                                        <h1>Sign Up</h1>
                                        <p>Please fill in this form.</p>
                                        <hr>
                                        <input type="text" placeholder="Enter Name" name="fname" id="cname"required>
                                        <input type="text" placeholder="Enter Address" name="address" id="caddress"required>
                                        <input type="text" placeholder="Enter Contact No" name="contactno" id="ccontactno"required>
                                        <label for="bday">Enter your Birthday:</label><br>
                                        <input type="date" placeholder="Enter Birthday" name="bday" id="cbday" required>
                                        <hr>
                                        <div class="clearfix">
                                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" id="modalcancel">Cancel</button>
                                            <button type="button" class="signupbtn">Sign Up</button>
                                            </form>
                    
                                        </div>
                                    </div>
  
  
                            </div>
                            <script>
                                var modal = document.getElementById('id01');
                                window.onclick = function(event) {
                                if (event.target == modal) {
                                modal.style.display = "none";
                                }
                                }
                            </script>
                        </div>
                    
                    
                </div>
                <div class="col-md-6 login-form-2 container" style="background-color:#414141">
                    <h3 class="font-weight-bold">Login</h3>
                    <form action = "employee_login.php" method="POST"> 
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username *" name="e_uname" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password *" name="e_pass" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" id="employeelogin" />
                        </div>
                        <div class="form-group">

                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>
    
$(document).ready(function(){
    // get the inputs in signup
    $(document).on('click','.signupbtn',function(){
        var a = $('#cname').val();
        var b = $('#caddress').val();
        var c = $('#ccontactno').val();
        var d = $('#cbday').val();
        var dsplit = d.split('-');
        var username = "";
        var asplit = a.split(' ');
        var maxcid ="";
        var cardNo ="";
        var p ="";
        //generate password
        var result = '';
        var characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i <= 5; i++){
            result += characters.charAt(Math.floor(Math.random()*charactersLength));
        }
        p = result;
        
        

        if(a!="" && b!="" && c!="" && d!=""){
            // get max CustomerId
            $.ajax({
            type:"GET",
            url:"getmaxcustomerid.php",
            success: function(data){
                myid = parseInt(JSON.parse(data)[0].cid)+1;
                maxcid=myid;
                username=asplit[0]+maxcid;
                console.log(username);
                console.log(p);
                console.log(a+b+c+d);
                cardNo=('C'+dsplit[0].slice(-2)+dsplit[1]+myid);
                console.log(cardNo)
                $.ajax({
                type:"POST",
                url:"insertcustomier_query.php",
                data: {
                    customerCard:cardNo,
                    customerName:a,
                    customerAddress:b,
                    customerContactNo:c,
                    customerBirthDate:d,
                    customerUsername:username,
                    customerPassword:p
                },
                success: function(data){
                    console.log("Success");
                }
                })
                $('#modalcancel').trigger('click');
                // console.log(parseInt(JSON.parse(data)[0].cid)+1);
            }
        })
        
            
        }
        




    })
})

</script>
</body>
</html>


<!-- authenticate if loggedin -->
