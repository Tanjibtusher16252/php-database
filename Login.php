<php 
?>
<DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php 

$usernameErr= $passwordErr="";
$username="";
$password="";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['username'])) {
        $usernameErr = "Please fill up the last user name properly";
    }
    else {
        $username = $_POST['username'];
    }
    if(empty($_POST['pass'])) {
        $passwordErr = "Please fill up the Password properly";
    }
    else {
        $password = $_POST['pass'];
    }

    if($count==2){
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

		

		echo "<br>";
		echo "Where Statement";
		echo "<br>";
		
		$stmt1 = $conn1->prepare("select password from user where username=?");
		$stmt1->bind_param("s", $username);
		
		$stmt1->execute();
		$res2 = $stmt1->get_result();
		$user = $res2->fetch_assoc();

        if($user['password']==$password){

		
				echo "<br>";
				echo "username: " . $username;
				echo "<br>";
				echo "password: " . $user['password'];
				echo "<br>";
				echo "<br>";
				echo "Successfull";
                
        }
        else{
            echo "unsuccessfull";
        }
	}

	$conn1->close();

}

    
    



?>

<h1> Login page:</h1>

    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <label for="username">Username<span style="color: red">*</span> </label>
    <input type="text" name="username" id="username" value="<?php echo $username ?>">
	<span style="color: red"><?php echo $usernameErr; ?></span>
		
	<br>
    <label for="password">Password<span style="color: red">*</span> </label>
	<input type="password" name="pass" id="pass" value="<?php echo $password ?>"> 
	<span style="color: red"><?php echo $passwordErr; ?></span>
		
	<br>
    <input type="submit" value="Submit">
</form>
    
</body>

</html>