<!DOCTYPE html>
<html>
<head>
	<title>GRIP BANK</title>
	<link rel="stylesheet" href="css/style.css">
  	<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="nav">
<nav>
		<label class="logo">GRIP BANK</label>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Create User</a></li>
			<li><a href="transfermoney.php">Money Transfer</a></li>
			<li><a href="Thistory.php">User History</a></li>
		</ul>
	</nav>
</div>

	<div class="container" style="">
		<div class="card">
			<div class="inner-box">
				<div class="card-front">
					<img src="user1.png" class="userimg" alt="user">
					<h2 >CREATE USER</h2>
					<form action="createuser.php" method="post">
						<input type="text" name="name"class="input-box"placeholder="Your Name"required>
						<input type="email" name="email"class="input-box"placeholder="Your Email Id"required>
						<input type="text" name="balance"class="input-box"placeholder="Balance "required>
						<button type="submit"class="submit-btn"name="submit">CREATE</button>
						<button type="reset"class="reset-btn" name="reset">RESET</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
include 'conn.php';
if(isset($_POST['submit'])){

	$username=$_POST['name'];
	$email=$_POST['email'];
	$balance=$_POST['balance'];

	$q = "select * from createuser where name= '$username' && email ='$email' && balance= '$balance'";

	$result = mysqli_query($con, $q);
	$num = mysqli_num_rows($result);

	if($num == 1){
		?>
		<script>
			alert("duplicate data");
		</script>
	<?php
	}
	else{
		$q="insert into createuser(name, email, balance) values('$username','$email','$balance')";
	$query=mysqli_query($con,$q);
	if($query){
		?>
		<script>
			alert("data inserted properly");
		</script>
		<?php
	}else{
		?>
		<script>
			alert("data not inserted");
		</script>
		<?php
	}
}
}
?>
