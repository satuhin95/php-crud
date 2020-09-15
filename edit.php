<?php
include 'database.php';

if (isset($_GET['id'])) {

  $id = base64_decode($_GET['id']);


  $result = mysqli_query($db,"select * from students where id='$id'");

  $data = mysqli_fetch_object($result); 
}
if (isset($_POST['submit'])) {


  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];


  $old = $_POST['old_img'];


  $imgname =  $_FILES['image']['name'];
  $tmpname =  $_FILES['image']['tmp_name'];

  $imgname = explode('.', $imgname);
  $img_ext = end($imgname);
  $imgname = rand(9999,99999).date('Ymd.').$img_ext ;


  $sql="UPDATE `students` SET name='$name',email='$email',contact='$contact',image='$imgname' where id='$id' ";
  $result=  mysqli_query( $db, $sql);

  
  if ($result) {
    move_uploaded_file($tmpname, 'image/'.$imgname);
    unlink($old);
    header("location: view.php");
  }


}





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Php Crud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <span class="text-center"><h1>Php Crud Practice</h1></span>
        <hr/>
        <span class="float-left"><h2>Edit Student</h2> </span>
        <span class="float-right"><a href="view.php" class="btn btn-primary mb-2">View</a></span>

        <div class=" pt-5">
          <form action="<?= $_SERVER['PHP_SELF']?>" class="mt-2" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->id ?>">
            <div class="form-group">
              <label>Name</label>
              <input type="name" name="name" class="form-control" value="<?= $data->name?>" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="<?= $data->email?>" >
            </div>
            <div class="form-group">
              <label>Contact</label>
              <input type="text" name="contact" class="form-control" value="<?= $data->contact?>" >

            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="image" class="form-control"  >
              Old Image:<img src="image/<?= $data->image?>" width="50px">
              <input type="hidden" name="old_img" value="<?= $data->image?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
