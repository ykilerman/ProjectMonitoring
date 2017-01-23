<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    include "connection.php";
    $now = DateTime::createFromFormat('U.u',microtime(true));

        $name = $now->format('YmdHisu');
        $imageActivity ="Activity".$name;
        $imageIncome ="Income".$name;
        $imageExpense ="Expense".$name;

        $pathActivity = "../web/system/storage/app/public/images/evidence/$imageActivity.jpg";
        $pathIncome = "../web/system/storage/app/public/images/evidence/$imageIncome.jpg";
        $pathExpense = "../web/system/storage/app/public/images/evidence/$imageExpense.jpg";

        $Highlight = $_POST['Highlight'];
        $Activity = $_POST['Activity'];
        $Income = $_POST['Income'];
        $Expense =$_POST['Expense'];
        $id=$_POST['id'];
        $complate=$_POST['complate'];

    if (isset($_POST['imageActivity'])&&isset($_POST['imageIncome'])&&isset($_POST['imageExpense'])) {



        $sql = "INSERT INTO reports(project_id,highlight,activity,activity_path,income,income_path,expense,expense_path)
        VALUES ('$id','$Highlight','$Activity','$imageActivity.jpg','$Income','$imageIncome.jpg','$Expense','$imageExpense.jpg')";

        if (mysqli_query($con, $sql)) {
            mysqli_query($con,"UPDATE projects SET percent='$complate' WHERE id=$id");

        $imageActivity = $_POST['imageActivity'];
        $imageIncome = $_POST['imageIncome'];
        $imageExpense = $_POST['imageExpense'];
        file_put_contents($pathActivity, base64_decode($imageActivity));
        file_put_contents($pathIncome, base64_decode($imageIncome));
        file_put_contents($pathExpense, base64_decode($imageExpense));

            echo "Success";
            exit;
        }
        else{
            echo "Failed";
            exit;
        }
    }else {
        echo "no image selected";
    }
}else{
    echo "can't access this page with your method";
}

 ?>
