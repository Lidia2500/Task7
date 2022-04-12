<?php


require 'dbConnection.php';
require 'functions.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title   = Clean($_POST['title']);
    $content = Clean($_POST['content']);
    $startdate  = Clean($_POST['startdate']);
    $enddate  = Clean($_POST['enddate']);

      $errors = [];

   
   
    if (empty($title)) {
        $errors['title'] = "Field Required";
    };
    
    if (empty($content)) {
        $errors['content'] = "Field Required";
    }  elseif (strlen($content) < 50) {
        $errors['content'] = "Length Must be >= 50 chars";
    }

            $month = 2;
             $day = 29;
            $year = 2016;

    if (empty($startdata)) {
        $errors['startdate'] = "Field Required";
        var_dump(checkdate($month, $day, $year));
    
    }
     
            
        if (empty($enddata)) {
            $errors['enddate'] = "Field Required";
        var_dump(checkdate($month, $day, $year));}

    
            if (empty($_FILES['image']['name'])) {
       
                $errors['Image']   = "Field Required";
           
           }else{
       
               $imgName  = $_FILES['image']['name'];
               $imgTemp  = $_FILES['image']['tmp_name'];
               $imgType  = $_FILES['image']['type'];   
       
               $nameArray =  explode('.', $imgName);
               $imgExtension =  strtolower(end($nameArray));
               $imgFinalName = time() . rand() . '.' . $imgExtension;
               $allowedExt = ['png', 'jpg'];
       
               if (!in_array($imgExtension, $allowedExt)) {
                   $errors['Image']   = "Not Allowed Extension";
               }
       
           }
       


    if (count($errors) > 0) {
       
        foreach ($errors as $key => $value) {
           
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        
        $disPath = './uploads/' . $imgFinalName;

        if (move_uploaded_file($imgTemp, $disPath)) {

      
$sql = "insert into blogdb (title,content,startdate,enddate) values ('$title','$content','$data','$startdate','$enddate')";


        $op  =  mysqli_query($con,$sql);

        mysqli_close($con);

        if($op){
            echo 'Raw Inserted';
        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }
    }else{
        echo 'Errot Try Again ... ';
    }

    }
}
     
      
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>todo list</h2>

        <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control" required id="exampleInputtitle" aria-describedby="" name="title" placeholder="Enter title">
            </div>

            

            <div class="form-group">
                <label for="exampleInputcontent">content</label>
                <input type="text" class="form-control" required id="exampleInputcontent" aria-describedby="emailHelp" name="content" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputstarydate">start date</label>
                <input type="date" class="form-control" required id="exampleInputdate" name="startdate" placeholder="enter date">
            </div>

            <div class="form-group">
                <label for="exampleInputenddate">end date</label>
                <input type="date" class="form-control" required id="exampleInputdate" name="enddate" placeholder="enter end-date">
            </div>



            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>




            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</body>

</html>