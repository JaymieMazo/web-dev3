<?php
session_start();
if (isset($_SESSION)) {

  if ($_SESSION['userwebpass'] == "passthrough") {
      echo "userlevell";
    echo "<div>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</div>";
    echo "</pre>";
  } else {
    header("Location:index.php");
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MMS</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="../bootstraps/bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="employee_page.css?version=5">
  <link rel="stylesheet" href="media/mediamodal.css">
  <link rel="stylesheet" href="alert.css">
  <link rel="stylesheet" href="addmedia/addmediabody.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="media/request/requestmodal.css">
  <link rel="stylesheet" href="../bootstraps/toast/dist/jquery.toast.min.css">
  <link rel="stylesheet" href="media/fine/finemodal.css">
  <link rel="stylesheet" href="media/record/recordsmodal.css">
  <link rel="stylesheet" href="media/charts/chart.css">



  <script src="asset/js/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="navbar.js"></script>
  <script src="filterfunction.js"></script>
  <script src="media/mediamodal.js"></script>
  <script src="media/addmedia/addmedia.js"></script>
  <script src="media/restore/restoremedia.js"></script>
  <script src="media/request/details.js"></script>
  <script src="Myaccount/mycart.js"></script>
  <script src="media/return/return.js"></script>
  <script src="Myaccount/accounts.js"></script>
  <script src="media/fine/fine.js"></script>
  <script src="account/loadselect.js"></script>
  <script src="account/addacount.js"></script>
  <script src="Myaccount/myaccount.js"></script>
  <script src="media/report/report.js"></script>
  <script src="levelcontrol.js"></script>
  <script src="userlevel/userlevel.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="media/charts/chart.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../bootstraps/toast/dist/jquery.toast.min.js"></script>

  <script></script>
  <!-- <script src="Myaccount/myaccount.js"></script> -->
  <!-- <script src="filter.js"></script> -->
  <!-- <script src="filter.js"></script> -->
  <style>
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body class="container-fluid" style="background-color:rgb(219, 219, 219);overflow-x: hidden;padding:0;">
  <div class="header container">
    <div class="logo">
      <img src="books.png" alt="books" href="http://localhost/mms/employee_page.php">
    </div>
    <div class="websitename">
      <a>Media Management System</a>
    </div>
    <div class="search_engine ">
      <!-- <button class="btn btn-secondary search"><i class="fas fa-search" ></i></button>   -->
      <!-- <input type="text"> -->
      <form action="employee_login.php" method="POST" class="logoutform">
        <a><button class="logout" type="exit" name="exit" id="exit">Log out</button><i class="far fa-user-circle"></i></a>
      </form>
    </div>
  </div>

  <div class="navi ">

    <div class="navicon">
      <a href="#" class="maincont mainsub" id="nav-library"><i class="fas fa-list-alt i_paddingright"></i> Library</a>
      <a href="#" class="maincont mainsub" id="nav-transaction"><i class="fas fa-cash-register i_paddingright"></i> Transaction</a>
      <a href="#" class="maincont mainsub" id="accbtn"><i class="fas fa-user i_paddingright"></i> Accounts</a>
      <div class="dropdownn" id="navbuttonaddnew">
        <button class="dropbutton maincont mainsub">
          <i class="fas fa-plus-circle i_paddingright"></i>
          Add New
        </button>


      </div>
      <a href="#" class="maincont mainsub" id="managemed"><i class="fas fa-user-cog i_paddingright"></i> Manage Media</a>
      <a href="#" class="maincont mainsub" id="medreoort"><i class="fas fa-user-cog i_paddingright"></i> Reports</a>

    </div>

  </div>

  <div class="header2nd" style="position:absolute;left:50%;">
    <div class="drop-contents" style="position:relative;left:-50%;margin-left:0;z-index:1; ">
      <hr>
      <!-- subcontent for add new items -->
      <a href="#" class="subcont" id="subnav-addaccount"><i class="fas fa-user i_paddingright"></i>Add Account</a>
      <a href="#" class="subcont" id="nav-addmedia"><i class="fas fa-book i_paddingright"></i>Add Media</a>
      <!-- subcontent for accounts -->
      <a href="#" class="subcont1" id="subnav-myaccount"><i class="fas fa-user i_paddingright"></i>MyAccount</a>
      <a href="#" class="subcont1" id="subnav-custoemeraccount"><i class="fas fa-user i_paddingright"></i>Customer Account</a>
      <a href="#" class="subcont1" id="subnav-employeeaccount"><i class="fas fa-user-tie i_paddingright"></i>Employee Account</a>
      <!-- subcontent for manage media -->
      <a href="#" class="subcont2" id="subnav-restoremedia"><i class="fas fa-undo-alt i_paddingright"></i> Medias On Hold</a>
      <!-- <a href="#" class="subcont2" id="subnav-report"><i class="fas fa-clipboard i_paddingright"></i></i>Others</a> -->
      <!-- subcontent for transation -->
      <a href="#" class="subcont3" id="subnav-requestmedia"><i class="fas fa-envelope-open-text i_paddingright"></i> Requests</a>
      <a href="#" class="subcont3" id="subnav-returnmedia"><i class="fas fa-hand-holding i_paddingright"></i>Return Media</a>
      <a href="#" class="subcont3" id="subnav-mediafines"><i class="fas fa-coins i_paddingright"></i>Fines</a>
      <!-- <a href="#" class="subcont3" id="subnav-transacrecprds"><i class="fas fa-clipboard-list i_paddingright"></i></i>Records</a> -->
      <!-- subcontent for reports -->
      <a href="#" class="subcont4" id="subnav-medreport"><i class="fas fa-clipboard-list i_paddingright"></i> Media Report</a>
      <a href="#" class="subcont4" id="subnav-custreport"><i class="fas fa-users i_paddingright"></i></i>Customer Report</a>
      <br>

      <div>
        <button class="btn btn-info" id="btnslideup" style="float:right;margin-right:50%;margin-top:10px;height:40px;width:50px">
          <p>^</p>
        </button>

      </div>
    </div>

  </div>

  <!-- bootstrap nav -->
  <!-- <div class="container-fluid">
    <div class="container">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
        </li>
      </ul>
    </div>

    <div class="tab-content ">
      <div id="home" class="container tab-pane active"><br>
        <h3>HOME</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <div id="menu1" class="container tab-pane fade"><br>
        <h3>Menu 1</h3>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      <div id="menu2" class="container tab-pane fade"><br>
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
    </div>
  </div> -->




  <!-- mainbody -->
  <div class="modalimage" style="height:0px">
  </div>

  <div class=" mainbody container mainmain">
    <div class="filter" style="position:relative">
      <div style="float:left;padding-right:50px;width:200px;">
        <label id="selTypeId" for="selectType">Media Types:</label>
        <select name="selectType" id="selType">
          <option>All</option>
        </select>
      </div>

      <div style="float:left;padding-right:50px">
        <label for="intitle" id="lbltitle">Title:</label>
        <input type="text" placeholder="Title" name="intitle" id="inptitle">
      </div>
      <div style="border-left:2px solid #414141; height:50px; float:left;margin-right:10px;"></div>

      <div style="float:left;padding-right:50px">
        <label for="inauthor" id="lblauthor">Author/Director:</label>
        <input type="text" placeholder="Author" name="inauthor" id="inpauthor">
      </div>
      <div style="border-left:2px solid #414141; height:50px; float:left;margin-right:10px;"></div>
      <div style="float:left;padding-right:50px;width:200px;">
        <label id="selYearlbl" for="selectYear">Year Published</label>
        <select name="selectYear" id="selYear">
          <option>All</option>
        </select>

      </div>

      <div style="padding-right:50px;width:200px;" id="filtermedbranch">
        <label id="selBranchlbl" for="selectbranch">Branch</label>
        <select name="selectbranch" id="selBranch">
          <option>All</option>
        </select>

      </div>



    </div>
    <div class="bookstylediv" style="border-bottom:5px solid black;position:relative">
    </div>




  </div>

  <div class="notify"><span id="notifyType" class=""></span></div>

  <!-- FORM add media -->
  <div class="addmediabody container p-3 mainbody">
    <h1>
      ADD MEDIA
    </h1>

    <form action="mediacrud/addnmedia.php" method="POST" class="needs-validation" novalidate>
      <div>
        <label for="adnmedbranch">Branch</label>
        <select class="form-control" name="adnmedbranch" id="adnmedbranch"></select>
      </div>
      <div>
        <label for="adnmediatyp">Media Types</label>
        <select class="form-control mb-3" name="adnmediatyp" id="adnmediatyp"></select>
      </div>
      <div class="form-group">
        <!-- <label for="adntitle">Title</label> -->
        <input type="text" class="form-control" id="adntitle" placeholder="Title" name="adntitle" required>
      </div>
      <div class="form-group">
        <!-- <label for="adnauthor">Author</label> -->
        <input type="text" class="form-control" id="adnauthor" placeholder="Author/ Director" name="adnauthor" required>
      </div>
      <div class="form-group">
        <!-- <label for="adnwriter">Writer</label> -->
        <input type="text" class="form-control" id="adnwriter" placeholder="Writer" name="adnwriter">
      </div>
      <div class="form-group">
        <!-- <label for="adnmedyrpub">Year Published</label> -->
        <input type="text" class="form-control" id="adnmedyrpub" placeholder="Year" name="adnmedyrpub" required>
      </div>
      <div class="form-group">
        <!-- <label for="adnmedlocation">Media Location</label> -->
        <input type="text" class="form-control" id="adnmedlocation" placeholder="Media Location" name="adnmedlocation" required>
      </div>
      <div class="form-group input-group">
        <!-- <label for="adnmedflost">Fine Lost</label> -->
        <div class="input-group-prepend">
          <span class="input-group-text">₱</span>
        </div>

        <input type="number" class="form-control" id="adnmedflost" placeholder="Fine Lost" name="adnmedflost" required>
      </div>

      <div class="form-group input-group">
        <!-- <label for="adnflate">Fine Late</label> -->
        <div class="input-group-prepend">
          <span class="input-group-text">₱</span>
        </div>
        <input type="number" class="form-control" id="adnflate" placeholder="Fine Late" name="adnflate" required>
      </div>
      <div class="form-group">
        <!-- <label for="adnquan">Quantity</label> -->
        <input type="number" class="form-control" id="adnquan" placeholder="Quantity" name="adnquan" required>
      </div>
      <button type="submit" class="btn btn-success btn-block btnadnmedia">Save</button>
    </form>
  </div>


  <!-- FORM add account -->
  <div class="container mainbody p-3 addaccountform" style="background-color:white;display:none">
    <h1>ADD ACCOUNT</h1>
    <form action="">
      <div>
        <label for="branch">Branch</label>
        <select class="form-control" name="branch" id="adnacbranch"></select>
      </div>

      <div>
        <label for="userlevel">User Level</label>
        <select class="form-control mb-3" name="userlevel" id="adnacuserlvl"></select>
      </div>

      <div class="form-group">
        <input class="form-control" type="text" name="name" id="adnacname" placeholder="Enter Name" required>
      </div>

      <div class="form-group">
        <input class="form-control" type="text" id="adnacaddress" placeholder="Enter Address " required>
      </div>

      <div class="form-group">
        <input class="form-control" type="number" id="adnaccontact" placeholder="Enter Contact Number" required>
      </div>

      <div class="form-group">
        <label for="bday">Birth Date</label>
        <input class="form-control" type="date" name="bday" min="1900-01-01" max="3000-12-31" id="adnacbday" required>
      </div>


      <button type="submit" class="btn btn-success btn-block" id="btnaddnewacc">Save</button>
    </form>
  </div>

  <script>

  </script>

  <!-- FORM restore media -->

  <div class="container mainbody restoremedform" style="background-color:white;display:none">
    <hr>
    <h1>Restore Media</h1>
    <table class="table table-striped tblrestoremedia" style="padding-right:5px;padding-left:5px;text-align:center">
      <thead class="thead-dark">
        <tr>
          <th>Media ID</th>
          <th>Branch</th>
          <th>Status</th>
          <th>Type</th>
          <th>Title</th>
          <th>Author</th>
          <th>YearPub</th>
          <th>Restore</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>



  <!-- myaccountform -->
  <div class="container mainbody myaccountform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>
        My Account
      </h3>
    </div>
    <div class="myaccount-body">

    </div>

    <!-- mycard -->
    <div class="container-fluid" id="mycart-body">
      <hr>
      <h3>My Cart</h3>
      <table class="table table-striped" id="tblmyaccount">
        <thead class="thead-dark">
          <th>No</th>
          <th>Title</th>
          <th>Type</th>
          <th>Author</th>
          <th>Year Published</th>
          <th>Location</th>
          <th>Action</th>

        </thead>
        <tbody>

        </tbody>
      </table>
      <button class="btn btn-success p-3" id="btnmyaccreq"><i class="fas fa-arrow-circle-up"></i> Request</button>
    </div>


    <!-- checked out -->
    <div class="container-fluid" id="mycout-body">
      <hr>
      <h3>My Checked-Out</h3>
      <table class="table table-striped" style="padding-right:5px;padding-left:5px;text-align:center" id="tblmychecked">
        <thead class="thead-dark">
          <th>No</th>
          <th>Record ID</th>
          <th>Title</th>
          <th>Date Issued</th>
          <th>Date Due</th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>



    <!-- fines -->
    <div class="container-fluid" id="myfines-body">
      <hr>
      <h3>My Fines</h3>
      <table class="table table-striped" style="padding-right:5px;padding-left:5px;text-align:center" id="tblmyfines">
        <thead class="thead-dark">
          <th>No</th>
          <th>Record ID</th>
          <th>Title</th>
          <th>Date Issued</th>
          <th>Date Due</th>
          <th>Fine</th>
        </thead>
        <tbody>

        </tbody>
      </table>

    </div>

  </div>





  <!-- requestform -->
  <div class="container mainbody requestform" style="background-color:white;display:none">

    <div class="container-fluid">
      <hr>
      <h3>
        Requests
      </h3>
      <table class="table table-striped tblrequestmedia" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <tr>
            <th>Record ID</th>
            <th>Borrower ID</th>
            <th>Remarks</th>
            <th>Details</th>

          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>

  </div>



  <!-- return media form -->
  <div class="container mainbody returnmediaform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>Return Media</h3>
      <div class=" input-group" style="height:40px;margin: 10px 10px;width:97%">
        <div class="input-group-prepend">
          <span class="input-group-text">RecordId</span>
        </div>
        <input class="form-control modalinp" id="impretmed"></input>
        <!-- <button class="btn btn-success btnretmed"><i class="fas fa-search" style="color:white"></i></button> -->
      </div>

      <table class="table table-striped tblreturnmedia" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>RecordId</th>
          <th>MediaId</th>
          <th>Title</th>
          <th>Status</th>
          <th>Date Issued</th>
          <th>Date Due</th>
          <th>Fine</th>
          <th>Action</th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>



  <!-- Customer Account Form -->
  <div class="container mainbody accountscustaccform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h1>Customer Accounts</h1>
      <div class=" input-group" style="height:40px;margin: 10px 10px;width:97%">
        <div class="input-group-prepend">
          <span class="input-group-text">Card Number</span>
        </div>
        <input class="form-control modalinp" id="inpcustomercard"></input>
        <!-- <button class="btn btn-success btnretmed"><i class="fas fa-search" style="color:white"></i></button> -->
      </div>


      <table class="table table-striped tblcusacc" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Card Number</th>
          <th>Branch</th>
          <th>Type</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact No.</th>
          <th>Birth Date</th>
          <th>Username</th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>


  <!-- Employee Account Form -->
  <div class="container mainbody accountsempaccform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h1>Employee Account</h1>
      <div class=" input-group" style="height:40px;margin: 10px 10px;width:97%">
        <div class="input-group-prepend">
          <span class="input-group-text">Card Number</span>
        </div>
        <input class="form-control modalinp" id="impempacccard"></input>
        <!-- <button class="btn btn-success btnretmed"><i class="fas fa-search" style="color:white"></i></button> -->
      </div>
      <table class="table table-striped tblempacc" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Card Number</th>
          <th>Branch</th>
          <th>Type</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact No.</th>
          <th>Birth Date</th>
          <th>Username</th>

        </thead>
        <tbody>

        </tbody>
      </table>


    </div>
  </div>


  <!-- fine -->
  <div class="container mainbody transactionfinesform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>Fines</h3>
      <div class=" input-group" style="height:40px;margin: 10px 10px;width:97%">
        <div class="input-group-prepend">
          <span class="input-group-text">Card Number</span>
        </div>
        <input class="form-control modalinp" id="inpsearchfine"></input>
        <!-- <button class="btn btn-success btnretmed"><i class="fas fa-search" style="color:white"></i></button> -->
      </div>
      <table class="table table-striped tblfine" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Record iD</th>
          <th>Title</th>
          <th>Borrower Card No.</th>
          <th>Date Issued</th>
          <th>Date Due</th>
          <th>Fine</th>
          <th>Action</th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>

  </div>


  <!-- records -->
  <div class="container mainbody transactionrecordsform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>Records</h3>
      <div class="input-group-prepend" style="height:40px;margin: 10px 10px;width:97%">
        <span class="input-group-text">Record ID</span>

        <input type="text" class="form-control modalinp" id="inprecordseachrecordid">
      </div>

      <table class="table table-striped tblrecords" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Record ID</th>
          <th>Borrower Card No</th>
          <th>Remarks</th>
          <th>Details</th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>


  <!-- report -->
  <!-- <script>
    window.onload = function() {
      var series = [{
              label: "Organic",
              y: 36
            },
            {
              label: "Email Marketing",
              y: 31
            },
            {
              label: "Referrals",
              y: 7
            },
            {
              label: "Twitter",
              y: 7
            },
            {
              label: "Facebook",
              y: 6
            },
            {
              label: "Google",
              y: 10
            },
            {
              label: "Others",
              y: 3
            }
          ]
      var options = {
        title: {
          text: "Website Traffic Source"
        },
        data: [{
          type: "pie",
          startAngle: 45,
          showInLegend: "true",
          legendText: "{label}",
          indexLabel: "{label} ({y})",
          yValueFormatString: "#,##0.#" % "",
          dataPoints: []
          
        }]
      };
      options.dataPoints = series;
      $("#chartContainer").CanvasJSChart(options);
    }
  </script> -->







  <div class="container mainbody reportsform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>Media Report</h3>
      <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
      <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
      <br>
      <br> -->
      <div>
        <figure class="highcharts-figure">
          <div id="container" name="container"></div>
        </figure>
      </div>
      <hr>
      <h3>Filter Report By Date</h3>
      <div class="form-group" style="width:50%;float:left">
        <label>From:</label>
        <input type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control" id="reportdatefrom">
      </div>
      <div class="form-group" style="width:50%;float:left">
        <label>To:</label>
        <input type="date" name="bday" min="1000-01-01" max="3000-12-31" class="form-control" id="reportdateto">
      </div>
      <div form-group>
        <!-- <button class="btn btn-success mb-3 mr-3" style="float:right" id="btnsearchfromto">Search</button> -->
      </div>
      <table class="table table-striped tblreports" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Top</th>
          <th>Title</th>
          <th>Total In and Out</th>
        </thead>
        <tbody>

        </tbody>
      </table>
      <hr>
      <div class="container-fluid col text-center">
        <button class="btn btn-info" style="width:10%" id="btnprintfromto"> Print</button>
      </div>
    </div>

  </div>

  <!-- customer masterlist -->
  <div class="container mainbody custmasterlistform" style="background-color:white;display:none">
    <div class="container-fluid">
      <hr>
      <h3>Customer Master List</h3>
      <table class="table table-striped tblcusacc" style="padding-right:5px;padding-left:5px;text-align:center">
        <thead class="thead-dark">
          <th>Card Number</th>
          <th>Branch</th>
          <th>Type</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact No.</th>
          <th>Birth Date</th>
          <th>Username</th>
        </thead>
        <tbody>

        </tbody>
      </table>
      <hr>
      <div class="container-fluid col text-center">
        <button class="btn btn-info" style="width:10%" id="btnprintcustmasterlist"> Print</button>
      </div>

    </div>

  </div>


  <!-- bottom border -->
  <div style="height:20px;background-color:gray;">
  </div>



  <script>
    // account > customeraccounts


    // requestmedia function
    $(document).ready(function() {
      $(document).on('click', '#subnav-requestmedia', function() {
        $.ajax({
          type: "POST",
          url: "media/request/requestmedia.php",
          success: function(data) {

            console.log("success");
            $('.requestnewtr').remove();
            var jsdata = JSON.parse(data);
            for (i in jsdata) {
              $('.tblrequestmedia').find('tbody').append(`
            <tr class="requestnewtr">
            <td id="myrecid">${jsdata[i].RecordId}</td>
            <td id="myreqid">${jsdata[i].CardNumber}</td>
            <td>${jsdata[i].Remarks}</td>
            <td><button class="btn btn-info" id="btnrequestinfo">Details</button></td>
            </tr>
            `);
            }

          }
        })
      })
    })


    // myaccountemployee function
  </script>
  <script>
    (function() {

      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    //   $('#adnmedflost').on('change keyup', function() {
    //   var sanitized = $(this).val().replace(/[^0-9]/g, '');
    //   $(this).val(sanitized);
    // });
    // $('#adnflate').on('change keyup', function() {
    //   var sanitized = $(this).val().replace(/[^0-9]/g, '');
    //   $(this).val(sanitized);
    // });
  </script>



  <script>
    $(document).ready(function() {
      $(document).on('click', '#nav-addmedia', function() {
        $('.mainbody').hide();
        $('.addmediabody').show();
      })
    })
  </script>








  <script>
    try {
      var start = 1900;
      var end = new Date().getFullYear();
      for (var year = start; year <= end; year++) {
        $('#selYear').append('<option>' + year + '</option>');
      }
    } catch (error) {

    }
    try {
      $(document).ready(function() {
        var userlevel;
        $.ajax({
          type: "POST",
          url: "userlevel/getsession.php",
          success: function(data) {
            userlevel = data[1];
            // alert(userlevel);
            if (userlevel == 2) {
              // user function
              $(document).on('change', '#selYear', function() {
                // alert('im a user')
                var type = $('#selType').val();
                var year = $('#selYear').val();
                // alert(type + " " + year)
                if (type == "All") {
                  if (year == "All") {
                    $.ajax({
                      type: "POST",
                      url: "userlevel_user/filter/filter_all_author.php",
                      success: function(data) {
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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
                      url: "userlevel_user/filteryear/filter_all_year.php",
                      data: {
                        year: year
                      },
                      success: function(data) {
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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

                } else {
                  $.ajax({
                    type: "POST",
                    url: "userlevel_user/filteryear/filter_all_year_type.php",
                    data: {
                      year: year,
                      type: type

                    },
                    success: function(data) {
                      $('.newdiv').remove();
                      var getdata = JSON.parse(data)
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


            } else {
              // admin function

              $(document).on('change', '#selYear', function() {
                var medtype = $('#selType').val();

                if (medtype == 'All') {
                  var year = $('#selYear').val();
                  if (year == 'All') {
                    $.ajax({
                      type: "GET",
                      url: "filter/filterallyear.php",
                      success: function(data) {
                        // console.log("success");
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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
                      url: "filter/filteryear.php",
                      data: {
                        inputyear: year
                      },
                      success: function(data) {
                        console.log("success");
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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
                } else {
                  var year = $('#selYear').val();
                  if (year == 'All') {
                    $.ajax({
                      type: "POST",
                      url: "filter/filterallyear_type.php",
                      data: {
                        mediatype: medtype,
                      },
                      success: function(data) {
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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
                      url: "filter/filteryear_type.php",
                      data: {
                        mediatype: medtype,
                        mediayear: year
                      },
                      success: function(data) {
                        $('.newdiv').remove();
                        var getdata = JSON.parse(data)
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
                }


              })
            }
          }
        })

      })
    } catch (error) {

    }
  </script>




  <!-- modal -->
  <div id="Mymodal" class="mediamodal">
    <!-- modal content -->
    <div class="media-modal-content">
      <div class="media-modal-header">
        <span class="media-close">&times;</span>
        <h1 id="modalh1"></h1>
      </div>
      <div class="media-modal-body">

      </div>
    </div>
  </div>
  <!-- end of modal -->



  <!-- request modal -->
  <div id="Mymodalreq" class="mediamodalreq">
    <!-- modal content -->
    <div class="media-modal-content-req">
      <div class="media-modal-header-req">
        <span class="media-close-req">&times;</span>
        <h1 id="modalh1req"></h1>
      </div>
      <div class="media-modal-body-req">
        <table class="table table-striped tblrequestmodalmedia" style="padding-right:5px;padding-left:5px;text-align:center">
          <thead class="thead-light">
            <th>No</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>

          </thead>
          <tbody>
          </tbody>
        </table>
        <div class="btn-group m-2">
          <button class="btn btn-success" id="modalacceptrequest" style="border-radius:5px">Accept Request</button>
          <button class="btn btn-danger ml-3" id="modaldeclinerequest" style="border-radius:5px">Decline Request</button>
        </div>

      </div>
    </div>
  </div>
  <!-- endofmodal -->




  <!-- finemodal -->

  <div id="Myfinemodal" class="mediamodalfine">
    <!-- modal content -->
    <div class="media-modal-content-fine">
      <!-- header -->
      <div class="media-modal-header-fine">
        <span class="media-close-fine">&times;</span>
        <h1 id="finemodalh1">Payment</h1>
      </div>
      <!-- body -->
      <div class="media-modal-body-fine">
        <!-- recordid input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Record ID</span>
          </div>
          <input class="form-control modalinp" id="finemodalrecid" disabled></input>
        </div>
        <!-- borrowerid input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Borrower Card No.</span>
          </div>
          <input class="form-control modalinp" id="finemodalborrowerid" disabled></input>
        </div>
        <!-- title input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Title</span>
          </div>
          <input class="form-control modalinp" id="finemodaltitle" disabled></input>
        </div>
        <!-- Total input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Total: ₱</span>
          </div>
          <input class="form-control modalinp" id="finemodaltotal" disabled></input>
        </div>
        <!-- payment input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Payment: ₱</span>
          </div>
          <input type="number" class="form-control modalinp" id="finemodalpayment"></input>
        </div>
        <!-- change input disabled -->
        <div class="finenewdiv input-group" style="height:40px;margin: 10px 10px;width:auto">
          <div class="input-group-prepend">
            <span class="input-group-text">Change: ₱</span>
          </div>
          <input class="form-control modalinp" id="finemodalchange" disabled></input>
        </div>


      </div>
      <div class="container-fluid m-2" style="width:auto">
        <button class="btn btn-success" id="btnpayfine" style="border-radius:5px">Pay</button>
        <button class="btn btn-danger ml-3" id="btncancelpay" style="border-radius:5px;float:right">Cancel</button>
      </div>
    </div>
  </div>

  <!-- end of fine modal -->



  <!-- transaction records modal -->
  <div id="Mymodalrecords" class="transactionrecords">
    <!-- modal content -->
    <div class="media-modal-content-records">
      <div class="media-modal-header-records">
        <span class="media-close-records">&times;</span>
        <h1 id="modalh1records">Record Details</h1>
      </div>
      <div class="media-modal-body-records">
        <table class="table table-striped tbltransactoinrecords" style="padding-right:5px;padding-left:5px;text-align:center">
          <thead class="thead-light">
            <th>Record ID</th>
            <th>Title</th>
            <th>Date Issued</th>
            <th>Date Due</th>
            <th>Date Returned</th>
            <th>Fine</th>

          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- end of transaction records modal -->


  <!-- highchart javascript -->
  <script>
    $(document).ready(function() {

      var dataFromDB = null;
      var series = [{
        name: 'Percentage',
        colorByPoint: true,
        data: []
      }];
      $.ajax({
        type: "POST",
        url: "media/charts/loadchart.php",
        data: {
          to: null,
          from: null
        },
        success: (data) => {
          dataFromDB = JSON.parse(data);
          for (i in dataFromDB) {
            series[0].data.push({
              name: (dataFromDB[i].Title),
              y: (parseInt(dataFromDB[i].percent)),
              selected: i == 0 ? true : false,
              sliced: i == 0 ? true : false,
            })
          }

        }
      })
      $.ajax({
        type: "POST",
        url: "media/charts/loadchart.php",
        data: {
          from: null,
          to: null
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
          var today = new Date();
          var datestrt = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();
          datestrt = yyyy + '-' + mm + '-' + '01'; 
          today = yyyy + '-' + mm + '-' + dd;

          // document.write(today);
          $('#reportdatefrom').val(datestrt);
          $('#reportdateto').val(today);
        }
      })





      setTimeout(() => {


        var chartdata = {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          title: {
            text: 'Top Medias'
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

        chartdata.series = series;


        $('#container').highcharts(chartdata);
        // console.log(chartdata)
      }, 500)
    })


    // Highcharts.chart('container', {
    //   chart: {
    //     plotBackgroundColor: null,
    //     plotBorderWidth: null,
    //     plotShadow: false,
    //     type: 'pie'
    //   },
    //   title: {
    //     text: 'Browser market shares in January, 2018'
    //   },
    //   tooltip: {
    //     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    //   },
    //   accessibility: {
    //     point: {
    //       valueSuffix: '%'
    //     }
    //   },
    //   plotOptions: {
    //     pie: {
    //       allowPointSelect: true,
    //       cursor: 'pointer',
    //       dataLabels: {
    //         enabled: false
    //       },
    //       showInLegend: true
    //     }
    //   },
    //   series: [{
    //     name: 'Brands',
    //     colorByPoint: true,
    //     data: [{
    //       name: 'Chrome',
    //       y: 61.41,
    //       // sliced: true,
    //       // selected: true
    //     }, {
    //       name: 'Internet Explorer',
    //       y: 11.84
    //     }, {
    //       name: 'Firefox',
    //       y: 10.85
    //     }, {
    //       name: 'Edge',
    //       y: 4.67
    //     }, {
    //       name: 'Safari',
    //       y: 4.18
    //     }, {
    //       name: 'Other',
    //       y: 7.05
    //     }]
    //   }]
    // });
  </script>

</body>

</html>






<!-- authenticate if loggedin -->