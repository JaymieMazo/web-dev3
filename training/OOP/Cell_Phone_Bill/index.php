<?php
spl_autoload_register(function ($class) {

    if (file_exists($class . '.php')) {
        require $class . '.php';
    }
});

interface validate
{
    public function compute();
}
class Telecom
{

    public $bill;
    public $mins;
    public $mins2;


    public function __construct($bill, $mins, $mins2)
    {
        $this->bill = $bill;
        $this->mins = $mins;
        $this->mins2 = $mins2;
    }
}

// $inst = new Regular(10,110,112);
// $inst->compute();

// $inst2 = new Premium(25,110,112);
// $inst2->compute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecom</title>
    <link rel="stylesheet" href="../../bootstraps/bootstrap4/dist/css/bootstrap.min.css">
    <script src="asset/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="cp_bill.js"></script> -->
</head>

<body>
    <div class="container-fluid" id="divmain">
        <center>

            <form action="" method="POST">
                <div class="container m-5" style="width:25%">
                    <div>
                        <div class="input-group mb-3" id="divcard">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Card No: </span>
                            </div>
                            <input type="number" name="pm" class="form-control" id="inpcard">

                        </div>
                        <!-- type -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Type: </span>
                            </div>
                            <input type="text" name="type" class="form-control" id="inptype" >
                        </div>
                        <!-- bill -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Bill: </span>
                            </div>
                            <input type="text" name="bill" class="form-control" id="inpbill" >

                        </div>
                        <!-- hours AM -->
                        <div class="input-group mb-3" id="divam">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hours(AM): </span>
                            </div>
                            <input type="number" name="am" class="form-control" id="inpam">

                        </div>
                        <!-- hours PM -->
                        <div class="input-group mb-3" id="divpm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hours(PM): </span>
                            </div>
                            <input type="number" name="pm" class="form-control" id="inppm">

                        </div>

                        <div class="input-group mb-3">
                            <button type="sumbit" class="btn btn-success form-control" id="btnsubmit">Submit</button>
                        </div>

                    </div>

                </div>
            </form>
        </center>
        <script>
            $(document).on('keyup', '#inpcard', function() {

                var service = $('#inpcard').val();

                switch (service) {
                    case "1": {
                        // $('#btnsubmit').removeAttr('disabled');
                        $('#inptype').val("Regular");
                        $('#inpbill').val("10");
                        $('#inpbill').attr('value', 10);
                        $('#divam').find('span').text("Total Hours: ");
                        $('#divpm').css('display', 'none');
                        $('#divmain').css('display', 'block');
                        break;
                    }

                    case "2": {
                        // $('#btnsubmit').removeAttr('disabled');
                        $('#inptype').val("Premium");
                        $('#inpbill').val("25");
                        $('#inpbill').attr('value', 25);
                        $('#divmain').css('display', 'block');
                        $('#divpm').css('display', 'flex');
                        $('#divam').css('display', 'flex');
                        break;
                    }
                    default: {
                        alert("No account found!");
                        break;
                    }
                }
            })
        </script>
        <?php
        if (isset($_POST)) {
            if ($_POST['type'] == 'Regular') {
                $reg = new Regular($_POST['bill'], $_POST['am'], $_POST['pm']);
                $reg->compute();
            } else if ($_POST['type'] == 'Premium'){
                $prem = new Premium($_POST['bill'], $_POST['am'], $_POST['pm']);
                $prem->compute();
            }
        }

        ?>
    </div>
</body>

</html>