<?php
#echo $nums; to display num of rows

#$res = mysqli_fetch_array($query);
#echo $res[2]; displays single single attribute of row everytime when we refresh
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<?php include 'links.php'; ?>
	<?php include 'css/style1.css';?>
</head>
<body>
	<div class="main-div">
		<h1 class="text_effects" style="font-size: 30px">TRANSFER &nbsp;&nbsp;MONEY</h1>

		<div class="center-div">
			<div class="table-responsive">
				<table>
					<thread>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Balance</th>
							<th colspan="2">Transaction</th>
							<th colspan="2">Operation</th>
						</tr>
					</thread>
					<tbody>
						<?php
							include 'conn.php';

							$selectquery = " select * from createuser ";

							$query = mysqli_query($con,$selectquery);

							$nums = mysqli_num_rows($query);

							while ($res = mysqli_fetch_array($query)){
								?>
								<tr>
									<td><?php echo $res['id'] ?></td>
									<td><?php echo $res['name'] ?></td>
									<td><span class="email-style"><?php echo $res['email'] ?></span></td>
									<td><?php echo $res['balance'] ?></td>
									<!-- <td><input type="button" name="submit" value="Transact" id="btnsubmit"onclick="document.location.href='Transaction.php?id=<?php  echo $res['id'];?>'"/>
									</td> --><!-- Transaction.php -->
									 <td><a href="Transaction.php?id= <?php echo $res['id'] ;?>"> <button type="button" class="btn" style="background-color : white; color:#1256c4;"><b>Transact</b></button></a></td> 

									<td><a href="update.php?id=<?php echo $res['id'];?>" data-toggle="tooltip" data-placement="bottom" title="UPDATE"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
									<td><a href="delete.php?id=<?php echo $res['id'];?>" data-toggle="tooltip" data-placement="bottom" title="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
								</tr>
							<?php	
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>