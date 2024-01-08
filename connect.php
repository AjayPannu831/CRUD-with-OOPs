<?php
class DbConfig{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'form';

    public $conn;

    public function __construct(){
        
            $this->conn = new mysqli($this->server,$this->user,$this->password,$this->database);
            if(!$this->conn){
                echo 'Cannot connect to database';
            }
        }
    

		
		// Insert customer data into customer table
		public function insertData()
		{
			$fname = $this->conn->real_escape_string($_POST['fname']);
            $lname = $this->conn->real_escape_string($_POST['lname']);
			$email = $this->conn->real_escape_string($_POST['email']);
			$password = $this->conn->real_escape_string(($_POST['password']));
			$cpassword = $this->conn->real_escape_string(($_POST['cpassword']));
            $gender = $this->conn->real_escape_string($_POST['Gender']);
            $dob = $this->conn->real_escape_string($_POST['dob']);
            $image = $this->conn->real_escape_string($_FILES['image']['name']);
                $target = "uploads/" . basename($image);

                // Move the uploaded image to the 'uploads' directory
                move_uploaded_file($_FILES['image']['tmp_name'], $target);

            $sql = "INSERT INTO `stu`(`First Name`, `Last Name`, `email`, `password`,`confirm`, `image`, `Gender`, `DOB`) VALUES ('$fname','$lname','$email','$password','$cpassword','$image','$gender','$dob')";
			$result = $this->conn->query($sql);
			if ($result) {
			    echo "<script>confirm('Data entered successfully.');</script>";
                echo "<script>window.location.href='fetch.php';</script>";
			}else{
			    echo 'Data error';
			}
		}
		// Fetch customer records for show listing
		public function FetchData()
		{
		    $sql = "SELECT * FROM stu";
		    $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}
		// // Fetch single data for edit from customer table
		public function displayId($id)
		{
		    $sql = "SELECT * FROM stu WHERE id = '$id'";
		    $result = $this->conn->query($sql);
		    if ($result->num_rows > 0) {
                $data = array();
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
			return $data;
		    }else{
			echo "Record not found";
		    }
		}
		// // Update customer data into customer table
		public function updateRecord()
		{
           
		    $id = $this->conn->real_escape_string($_POST['id']);
            $fname = $this->conn->real_escape_string($_POST['fname']);
            $lname = $this->conn->real_escape_string($_POST['lname']);
			$email = $this->conn->real_escape_string($_POST['email']);
			$password = $this->conn->real_escape_string(($_POST['password']));
			$cpassword = $this->conn->real_escape_string(($_POST['cpassword']));

            $gender = $this->conn->real_escape_string($_POST['Gender']);
            $dob = $this->conn->real_escape_string($_POST['dob']);
            $image = $this->conn->real_escape_string($_FILES['image']['name']);
            $target = "uploads/" . basename($image);
        
            // Move the uploaded image to the 'uploads' directory
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $sql = "UPDATE `stu` SET `id`='$id',`First Name`='$fname',`Last Name`='$lname',`email`='$email',`password`='$password',`confirm`= '$cpassword',`image`='$image',`Gender`='$gender',`DOB`='$dob' WHERE id = '$id'";
                $result = $this->conn->query($sql);
           
                if ($result) {
                    echo "<script>confirm('Data updated successfully.');</script>";
                    echo "<script>window.location.href='fetch.php';</script>";
                }else{
                    echo "Registration updated failed try again!";
                }
		}
		// // Delete customer data from customer table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM `stu` WHERE id = '$id'";
		    $sql = $this->conn->query($query);
		    if ($sql==true) {
                echo '<script>confirm("delete_record");</script>';
                echo '<script>window.location.href="fetch.php";</script>';
		    }else{
			    echo "Record does not delete try again";
		    }
		}
	}



?>