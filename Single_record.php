<?php
  
  // Include database file
  include 'connect.php';
  $fetch = new DbConfig();
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  
     
?> 
<!DOCTYPE html>
<html>

<head>
  <!-- Add Bootstrap CSS link here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container mt-4">
        <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
    </div> 
    <div class="container mt-4">
        <table class="table table-bordered table-success">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Confirm Password</th>
                <th scope="col">Image</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                $custom = $fetch->displayId($id); 
                foreach ($custom as $customers) {
                ?>
                <tr scope="row">
                    <td><?php echo $customers['id'] ?></td>
                    <td><?php echo $customers['First Name'] ?></td>
                    <td><?php echo $customers['Last Name'] ?></td>
                    <td><?php echo $customers['email'] ?></td>
                    <td><?php echo $customers['password'] ?></td>
                    <td><?php echo $customers['confirm'] ?></td>

                    <td>
                        <?php 
                         echo '<img src="./uploads/' . $customers['image'] . '"    alt="Profile Image" style="max-width: 50px; max-height: 50px; border: 1px solid #ccc; border-radius: 50%;">';
                        ?>
                    </td>
                    <td><?php echo $customers['Gender'] ?></td>
                    <td><?php echo $customers['DOB'] ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $customers['id']; ?>" class="btn btn-warning">Update</a><br><br>
                        <a href="delete.php?id=<?php echo $customers['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>


  
   