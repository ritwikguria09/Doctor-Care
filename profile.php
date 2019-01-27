<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$phn = $_SESSION['phn'];
if($phn)
	{
		$newphn = $phn;
	}
else
	{
		session_destroy();
		header("location:./index.php");
		exit();
	}
?>

<!DOCTUPE html>
<html>
	<head>
		<title>Doctor care</title>
		<style>
			div.container {
				width: 100%;
				height:100%;
			}

			header {
				position: fixed;
				top: 0;
				right: 0;
				left: 0;
				width : 100%;
				padding: 0.5em;
				color: white;
				background-color: 24737F;
				clear: left;
				text-align: left;
			}
			
			footer {
				position: fixed;
				bottom: 0;
				right: 0;
				left: 0;
				padding: 0.5em;
				width : 100%;
				color: white;
				background-color: 24737F;
				clear: left;
				text-align: center;
			}
			article {
				margin-right: 0%;
				padding: 1em;
				overflow: hidden;
			}
			input[type=button], input[type=submit], input[type=reset] {
				background-color: #4CAF50;
				border: none;
				color: white;
				padding: 16px 32px;
				text-decoration: none;
				margin: 4px 2px;
				width: 100%;
				cursor: pointer;
			}
			input[type=text], [type=password], [type=date], [type=number_format] {
				width: 300px;
				padding: 8px 15px;
				margin: 8px 0;
				box-sizing: border-box;
			}
			fieldset {
				border:1px solid #999;
				border-radius:8px;
				box-shadow:0 0 10px #999;
				padding: 1em;
				width: 40%;
			}
			label {
				width:50%;
				margin-right:0.5em;
				padding-top:0.2em;
				text-align:right;
				font-weight:bold;
			}
			p {
				font-size: 160%;
			}
			
			.fnt {
				font-size: 90%;
				color : red;
				
			}
			.img-circle {
				border-radius: 50%;
			}
			ul {
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: 24737F;
			}

			li {
				border-right: 1px solid #bbb;
				float: right;
			}
			
			li:nth-child(2) {
				border-right: none;
			}

			}
			
			li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			li a:hover:not(.active) {
				background-color: #111;
			}

			.active {
				background-color: #085c7a;
			}
		</style>
	</head>
<body>
	<body>
		<div class="container">
			<header>
				<?php
					require("connect.php");
					$qry= "select * from user where phn=$newphn";
					$result = $conn->query($qry);
					$norows = $result->num_rows;
					if($norows == 1)
					{
						$row = $result->fetch_assoc();
						$name = $row['name'];
						$newphn = $row['phn'];
					}
						$form='
						<ul>
							<li style="float: left"><img class="img-circle" height="80" width="80" src="data:image;base64,'.$row['img'].'"></li>
							<li style="float: left"><b style="font-size: 200%">Doctor care, </b></br>'.$name.','.$phn.'</li>
							<li><a href="./logout.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Logout</a></li>
							<li><a href="./history.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">History</a></li>
							<li><a class="active" href="./profile.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Profile</a></li>
							<li><a href="./home.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Home</a></li>
						</ul>';
					echo $form;
				?>
			</header>
			<nav>
			</nav>
			<article>
				<center>
				</br></br></br></br></br>
				<?php
					$qry= "select * from user where phn=$newphn";
					$result = $conn->query($qry);
					$norows = $result->num_rows;
					if($norows == 1)
					{
						$row = $result->fetch_assoc();
						$getname = $row['name'];
						$newphn = $row['phn'];
						$getgender = $row['gender'];
						$getdob = $row['dob'];
						$getwt = $row['weight'];
						$getht = $row['height'];
					}
					$form='
						<form action="./profile.php" method="post">
							<fieldset>
							<legend><img class="img-circle" height="50" width="50" src="data:image;base64,'.$row['img'].'"></legend>
								<table>
									<tr>
										<td align="right"><label>Phone No :</label></td>
										<td><input type="number_format" name="phn" value='.$newphn.' placeholder="10 digit mobile no" style="background-color:#dbdbdb" readonly></td>
									</tr>
									<tr>
										<td align="right"><label>Full Name :</label></td>
										<td><input type="text" name="name" value="'.$getname.'" placeholder="Name"></td>
									</tr>
									<tr>
										<td align="right"><label>Gender:</label></td>
										<td> <input type="radio" name="gender" value="Male" id="Male"><b>Male  </b><input type="radio" name="gender" value="Female" id="Female"><b>Female   </b><input type="radio" name="gender" value="Other" id="Other"><b>Other   </b></td>
									</tr>
									<tr>
										<td align="right" nowrap><label>Data of Birth :</label></td>
										<td><input type="date" name="dob" value="'.$getdob.'"></td>
									</tr>
									<tr>
										<td align="right"><label>Height :</label></td>
										<td><input type="number_format" name="ht" value="'.$getht.'" placeholder="in cm"></td>
									</tr>
									<tr>
										<td align="right"><label>Weight :</label></td>
										<td><input type="number_format" name="wt" value="'.$getwt.'" placeholder="in Kg"></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" name="btn" value="Update"></td>
									</tr>
								</table>
							</fieldset>
						</form>
						<script>
							document.getElementById("'.$getgender.'").checked = true;
						</script>';
						if(isset($_POST['btn']))
						{
							echo '<img src="data:image;base64,'.$image.'">';
							$uname = $_POST['name'];
							$ugender = $_POST['gender'];
							$udob = $_POST['dob'];
							$uht = $_POST['ht'];
							$uwt = $_POST['wt'];
							if($uname)
							{
								$sql = "update user set name='$uname', gender='$ugender', dob='$udob',weight=$uwt,height=$uht where phn=$newphn";
								if($conn->query($sql)== TRUE)
								{
									$msg = "Sucessfull .";
									echo "$form<p>$msg</p>";
								}
								else
								{
									$msg = "**There is some problem ! Try letter on .";
									echo "$form<p class='fnt'>$msg</p>";
								}
							}
							else
							{
								$msg = "Name is empty";
								echo "$form<p class='fnt'>$msg</p>";
								
							}
						}
						else
						{
							echo "$form";
						}
					?>
				</center>
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>