<?php
  
  include 'database.php';

  $result = mysqli_query($db,"select * from students");



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Php CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row mt-5">
    <div class="col-sm-8 offset-2">
<span class="text-center"><h2>All Student</h2>  </span>
<span class="float-right"><a href="index.php" class="btn btn-primary mb-2">Add New</a></span>
         
  <table class="table mt-2">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          while ($data = mysqli_fetch_object($result)) {

            
      ?>
      <tr>
        <td><?= $data->id?></td>
        <td><?= $data->name?></td>
        <td><?= $data->email?></td>
        <td><?= $data->contact?></td>
        <td><img src="image/<?= $data->image?>" alt="pic" width="50px"> </td>
        <td>
          <a href="edit.php?id=<?= base64_encode($data->id)?>" class="btn btn-primary">Edit</a>
          <a href="delete.php?id=<?= base64_encode($data->id) ?>"class="btn btn-danger">Delete</a>
        </td>
       
      </tr>
      <?php 
    }

    ?>
    </tbody>
  </table>

    </div>
  </div>
</div>

</body>
</html>
