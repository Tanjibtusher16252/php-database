<!DOCTYPE html>
<html>
<head>
	<title>Form Submission </title>
</head>
<body>

	<h1>Form Submission </h1>
     
	<?php
		$firstNameErr = $lastNameErr = $genderErr= $dobErr= $religionErr=  $preaddressErr= $paraddressErr= $phoneErr= $emailErr= $pweblinkErr= $usernameErr= $passwordErr= "";
		$firstName = ""; 
		$lastName = ""; 
		$gender="";
        $dob="";
        $religion="";
        $preaddress="";
        $paraddress="";
        $phone="";
        $email=""; 
        $pweblink="";
        $username="";
        $password="";

         


		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST['fname'])) {
				$firstNameErr = "Field can not be empty";
			}
			else {
				$firstName = $_POST['fname'];
                
			}

			if(empty($_POST['lname'])) {
				$lastNameErr = "Field can not be empty";
			}
			else {
				$lastName = $_POST['lname'];
			}
            if(isset($_POST['gender']))
            {
                $gender = $_POST['gender'];              
              if ($gender == "male")
                {
                    $gender = "male";

                }
                else if($gender == "female")
                {
                    $gender = "female";
                }
                else
                {
                    $gender="other";
                }
            }
            if(empty($_POST['dob'])) {
				$dobErr = "Field can not be empty";
			}
			else {
				$dob = $_POST['dob'];
                 
			}


            if(empty($_POST['religion'])) {
				$religionErr = "Field can not be empty";
			}
			else {
				$religion = $_POST['religion'];
			}
            if(empty($_POST['preaddress'])) {
				$preaddressErr = "Field can not be empty";
			}
			else {
				$preaddress = $_POST['preaddress'];
                
			}
            if(empty($_POST['paraddress'])) {
				$paraddressErr = "Field can not be empty";
			}
			else {
				$paraddress = $_POST['paraddress'];
                
			}
            if(empty($_POST['phone'])) {
				$phoneErr = "Field can not be empty";
			}
			else {
				$phone = $_POST['phone'];    
			}
            if(empty($_POST['email'])) 
            {
                $emailErr = "Field can not be empty";
            }
            else
            {
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $emailErr = "Invalid Email!";
                }
            }
            if(empty($_POST['pweblink'])) {
				$pweblinkErr = "Field can not be empty";
			}
			else {
				$pweblink = $_POST['pweblink'];    
			}
            if(empty($_POST['username'])) {
				$usernameErr = "Field can not be empty";
			}
			else {
				$username = $_POST['username'];
			}
            if(empty($_POST['password'])) {
				$passwordErr = "Please fill up the password properly";
			}
			else {
				$password = $_POST['password'];
			}
            if($count>=12){


				$host = "localhost";
				$user = "root";
				$pass = "";
				$db = "wtm";

				
				$conn1 = new mysqli($host, $user, $pass, $db);

				if($conn1->connect_error) {
					echo "Database Connection Failed!";
					echo "<br>";
					echo $conn1->connect_error;
				}
				else {
					echo "Database Connection Successful!";
					


					$stmt1 = $conn1->prepare("insert into users (firstName,lastName,gender,dob,religion,preaddress,paraddress,phone,email,pweblink,username,password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
					$stmt1->bind_param("ssssssssssss", $firstName,$lastName,$gender,$dob,$religion,$preaddress,$paraddress,$phone,$email,$pweblink,$username,$password);
					
					$status = $stmt1->execute();

					if($status) {
						echo "Data Insertion Successful.";
                        header("Location: login.php");
					}
					else {
						echo "Failed to Insert Data.";
						echo "<br>";
						echo $conn1->error;
					}
				}

				$conn1->close();
		}
        
	?>
     

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
		    <legend>Basic Information :</legend>
			<br>
		          <label for="fname">First Name<span style="color: red">*</span> :</label>
		          <input type="text" name="fname" id="fname">
                   
                  <span style="color: red"><?php echo $firstNameErr; ?></span>
                  <br>
                  <label for="fname">Last Name<span style="color: red">*</span> :</label>
		          <input type="text" name="fname" id="fname">
                  <span style="color: red"><?php echo $lastNameErr; ?></span>

		    <br>

		          <label for="gender">Gender<span style="color: red">*</span> :</label>
		          <input type="radio" id="male" name="gender" value="male">
                  <label for="male">Male </label>
                  <input type="radio" id="female" name="gender" value="female">
                  <label for="female">Female </label>
                 <input type="radio" id="other" name="gender" value="other">
                 <label for="other">Other </label>
                 <span style="color: red"><?php echo $genderErr; ?></span>
             

                 

		    <br>

			<label for="birthdaytime">DoB(date and time)<span style="color: red">*</span> :</label>
            <input type="datetime-local" id="birthdaytime" name="birthdaytime"> 
            <span style="color: red"><?php echo $dobErr; ?></span>

			<br>   

			<label for="religion">Religion<span style="color: red">*</span> :</label>
			<select id="religion" name="religion">
			  <option value="Muslim">Muslim</option>
			  <option value="Hindu">Hindu</option>
              <option value="Christianity">Christianity</option>
              <option value="Buddhism">Buddhism</option>
              <option value="Sikhism">Sikhism</option>
			  <option value="others">Other</option>			  
			</select>
            <span style="color: red"><?php echo $religionErr; ?></span>

			

		    <br>


		</fieldset>
		<br>
		<fieldset>
			<legend>Contact Information<span style="color: red">*</span>: </legend>

			<label for="preaddress">Present Address <span style="color: red">*</span>:</label>
			<input type="text" name="preaddress" id="preaddress">      
            <span style="color: red"><?php echo $preaddressErr; ?></span>
            

	  <br>
	  
			<label for="paraddress">Permanent Address<span style="color: red">*</span> :</label>
			<input type="text" name="paraddress" id="paraddress">
            <span style="color: red"><?php echo $paraddressErr; ?></span>
	  <br>

	  <label for="phone"> Phone number<span style="color: red">*</span> :</label>
	  <input type="tel" id="phone" name="phone" >
      <span style="color: red"><?php echo $phoneErr; ?></span>

	  <br>

	  <label for="email"> Email<span style="color: red">*</span> :</label>
      <input type="email" id="email" name="email">
      <span style="color: red"><?php echo $emailErr; ?></span>	

      <br>

	  <label for="pweblink">Personal website link<span style="color: red">*</span> :</label>
      <input type="url" id="pweblink" name="pweblink">
      <span style="color: red"><?php echo $pweblinkErr; ?></span>
      
	  <br>


	</fieldset>
    <br>
		<fieldset>
			<legend>Account Information</legend>

			<br>
        <label for="username">Username<span style="color: red">*</span> :</label>
		<input type="text" name="username" id="username" value="<?php echo $username ?>">
        <span style="color: red"><?php echo $usernameErr; ?></span>	 
		
		<br>
        <label for="password">Password<span style="color: red">*</span> :</label>
		<input type="password" name="password" id="pass" value="<?php echo $password ?>">
        <span style="color: red"><?php echo $passwordErr; ?></span>		 


	</fieldset>


	

		<br>

		<input type="submit" value="Submit">


	</form>

</body>
</html>