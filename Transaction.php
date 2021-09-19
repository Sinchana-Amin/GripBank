<?php
include 'conn.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $selectquery = "SELECT * from createuser where id=$from";
    $query = mysqli_query($con,$selectquery);
    $num1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $selectquery = "SELECT * from createuser where id=$to";
    $query = mysqli_query($con,$selectquery);
    $num2 = mysqli_fetch_array($query);
    

    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $num1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $num1['balance'] - $amount;
                $selectquery = "UPDATE createuser set balance=$newbalance where id=$from";
                mysqli_query($con,$selectquery);
             

                // adding amount to reciever's account
                $newbalance = $num2['balance'] + $amount;
                $selectquery = "UPDATE createuser set balance=$newbalance where id=$to";
                mysqli_query($con,$selectquery);
                $sender = $num1['name'];
                $receiver = $num2['name'];
                $selectquery = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($con,$selectquery);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='Thistory.php';
                           </script>";
                    
                }
                else{
                	echo "<script> alert('Transaction Failed');
                           </script>";
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>GRIP BANK</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
		<div class="nav">
	    <nav>
		<label class="logo">GRIP BANK</label>
		<ul>
			<li><a class=""href="index.php">Home</a></li>
			<li><a href="createuser.php">Create User</a></li>
			<li><a href="transfermoney.php">Money Transfer</a></li>
			<li><a href="Thistory.php">User History</a></li>
		</ul>
	</nav> 
	</div>
	<div class="outerclass" style="background-color :#02011a;">
		<h2 class="heading" style="color : white;">TRANSACTION</h2>

	<div class="table">
		<center>
		<table border="1" cellspacing="0" cellpadding="10" style="text-align: center,color: white">
			<tr class="row" style="color : white;">
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Balance</th>
			</tr>
			<?php
				include 'conn.php';
					$ids=$_GET['id'];

				$selectquery = " select * from createuser where id='$ids'";
				$query = mysqli_query($con,$selectquery);
				$nums = mysqli_num_rows($query);
				if(!$nums)
                {
                    echo "Error : ".$query."<br>".mysqli_error($con);
                }

				while ($res = mysqli_fetch_array($query)){
			?>
			<tr class="row" style="color : white;">
				<td><?php echo $res['id'];?></td>
				<td><?php echo $res['name'];?></td>
				<td><?php echo $res['email'];?></td>
				<td><?php echo $res['balance'];?></td>
			</tr>
		<?php
		}
		?>
		</table>
		
		<form action="" method="POST" style="color : white;">
		<label style="font-size:25px">Transfer To:</label>
		<?php
		include 'conn.php';
		$ids=$_GET['id'];
		$selectquery = " select * from createuser where id!='$ids'";
		$query = mysqli_query($con,$selectquery);
		?>

		<select name="to" style="margin:15% 1%">
		<option name="">--Select--</option>
				<?php
					while ($res = mysqli_fetch_array($query)){
				?>
					<option name="" value="<?php echo $res['id'];?>">
					<?php echo $res['name']?>-Balance:(<?php echo $res['balance']?>)
					</option>
				<?php
					}
				?>
		</select>
		<label style="font-size:25px">Amount:</label>

		<input type="number" id="mybtn" name="amount" class="amount" placeholder="enter amount" style="margin:15% 1%">

		<button class="" name="submit" type="submit" id="myBtn"style="width:10%">Transfer</button>
		 <p style="margin-top: -7%">&copy 2021. Made by <b>S.Sinchana</b> <br>The Sparks Foundation</p>
		<!-- <input type="button" name="",id="mybtn", value="Transact" style="width:10%" onclick="document.location.href='transactionhistory.php'"/> -->
         </form>                           
	</center>

	</div>
</div>

</body>
</html>



