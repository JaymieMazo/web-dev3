<?php
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";
session_start();

for ($i = 0; $i < $_POST['adnquan']; $i++) {
    echo ($i);
    echo "<br>";
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("
        INSERT INTO medias(
        MediaTypeId,
        BranchId,
        Title,
        Author,
        Writer,
        YearPub,
        Location,
        FineLost,
        FineLate,
        CreatedDate,
        UpdatedByCode
        ) VALUES (
        :mediatype,
        :branch,
        :title,
        :author,
        :writer,
        :yearpub,
        :location,
        :finelost,
        :finelate,
        NOW(),
        :usercode
        ) ");
        $stmt->bindValue(':mediatype', $_POST['adnmediatyp'], PDO::PARAM_INT);
        $stmt->bindValue(':branch', $_POST['adnmedbranch'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $_POST['adntitle'], PDO::PARAM_STR);
        $stmt->bindValue(':author', $_POST['adnauthor'], PDO::PARAM_STR);
        $stmt->bindValue(':writer', $_POST['adnwriter'], PDO::PARAM_STR);
        $stmt->bindValue(':yearpub', $_POST['adnmedyrpub'], PDO::PARAM_STR);
        $stmt->bindValue(':location', $_POST['adnmedlocation'], PDO::PARAM_STR);
        $stmt->bindValue(':finelost', $_POST['adnmedflost'], PDO::PARAM_INT);
        $stmt->bindValue(':finelate', $_POST['adnflate'], PDO::PARAM_INT);
        $stmt->bindValue(':usercode', $_SESSION['employeecode'], PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>alert('Add Success!')</script>";
        header("location:../employee_page.php");
        // $getstmt = $stmt->fetchAll();
        // echo ($stmt);
        // echo json_encode($getstmt);
    } catch (\Throwable $th) {
        throw $th;
    }
    // try {
    //     $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //     $stmt = $pdo->prepare('
    // INSERT INTO medias(
    // MediaTypeId,
    // BranchId,
    // Title,
    // Author,
    // Writer,
    // YearPub,
    // Location,
    // FineLost,
    // FineLate,
    // CreatedDate,
    // UpdatedByCode
    // ) VALUES (
    // :mediatype,
    // :branch,
    // :title,
    // :author,
    // :writer,
    // :yearpub,
    // :location,
    // :finelost,
    // :finelate,
    // NOW(),
    // 39360
    // ) ');
    // $stmt->bindValue(':mediatype',$_POST['adnmediatyp'],PDO::PARAM_INT);
    // $stmt->bindValue(':BranchId',$_POST['adnmedbranch'],PDO::PARAM_INT);
    // $stmt->bindValue(':Title',$_POST['adntitle'],PDO::PARAM_STR);
    // $stmt->bindValue(':Author',$_POST['adnauthor'],PDO::PARAM_STR);
    // $stmt->bindValue(':Writer',$_POST['adnwriter'],PDO::PARAM_STR);
    // $stmt->bindValue(':YearPub',$_POST['adnmedyrpub'],PDO::PARAM_STR);
    // $stmt->bindValue(':Location',$_POST['adnmedlocation'],PDO::PARAM_STR);
    // $stmt->bindValue(':FineLost',$_POST['adnmedflost'],PDO::PARAM_INT);
    // $stmt->bindValue(':finelate',$_POST['adnflate'],PDO::PARAM_INT);

    //     $stmt->execute();
    //     $getstmt = $stmt->fetchAll();
    //     echo($stmt);
    //     echo json_encode($getstmt);
    // } catch (PDOException $th) {
    //     $th->getMessage();
    // }
}
?>
<script>
    $.toast({
    text: "Media Added.", // Text that is to be shown in the toast
    heading: 'Success', // Optional heading to be shown on the toast
    icon: 'success', // Type of toast icon
    showHideTransition: 'slide', // fade, slide or plain
    allowToastClose: true, // Boolean value true or false
    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
    
    
    
    textAlign: 'left',  // Text alignment i.e. left, right or center
    loader: true,  // Whether to show loader or not. True by default
    loaderBg: '#9EC600',  // Background color of the toast loader
    beforeShow: function () {}, // will be triggered before the toast is shown
    afterShown: function () {}, // will be triggered after the toat has been shown
    beforeHide: function () {}, // will be triggered before the toast gets hidden
    afterHidden: function () {}  // will be triggered after the toast has been hidden
});
</script>
