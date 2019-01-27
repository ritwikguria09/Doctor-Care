<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$phn = $_SESSION['phn'];
$r_phn = $_SESSION['r_phn'];
$r_code = $_SESSION['r_code'];
$f_phn = $_SESSION['f_phn'];
$f_code = $_SESSION['f_code'];
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
				text-align: center;
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
				padding: 8px 15px;
				text-decoration: none;
				margin: 4px 2px;
				cursor: pointer;
			}
			input[type=text], [type=password] {
				width: 100%;
				padding: 5px 30px;
				margin: 4px 0;
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
				float:left;
				width:50%;
				margin-right:0.5em;
				padding-top:0.2em;
				text-align:right;
				font-weight:bold;
			}
			p {
				color: red;
				font-size: 80%;
			}
		</style>
	</head>
<body>
	<body>
		<div class="container">

			<header>
			   <h1>Doctor Care</h1>
			</header>
			<article>
			<center>
				</br></br></br></br></br>
				<?php
					if($phn)
					{
						//goto home page .....
						header("location:./home.php");
						exit();
					}
					else 
						if($r_phn)
						{
							// confurm otp... and go to home page ....
							$form = "<h2>**To login your account you must have to confurm your OTP**<h2>
							</br>
							<form action='otp.php' method='post'>
							<fieldset>
								<table>
									<tr>
										<td><h4>We send a 4-digit password in you mobile no,$r_phn : $r_code<h4></td>
									</tr>
									</br>
									<tr>
										<td nowrap>
											<label>Enter OTP :</lable>
											<input type='password' name='code' placeholder='OTP'>
											<input type='submit' name='btn' value='Submit'>
										</td>
									</tr>
								<table>
							</fieldset>
							</form>";
							if($_POST['btn'])
							{
								$getcode = $_POST['code'];
								if($getcode)
								{
									require("connect.php");
									$sql = "select * from user where phn='$r_phn'";
									$result = $conn->query($sql);
									if($result->num_rows == 1)
									{
										$row = $result->fetch_assoc();
										$dbphn = $row['phn'];
										$dbcode = $row['code'];
										if($dbcode==$getcode && $dbphn==$r_phn)
										{
											$sql = "update user set active=1 where phn=$dbphn";
											if($conn->query($sql)== TRUE)
											{
												session_destroy();
												session_start();
												$phn = $_SESSION['phn'];
												$_SESSION['phn'] = $dbphn;
												header("location:./home.php");
												exit();
											}
											else
											{
												$msg = "** Thear is some problem try again.";
												echo "$form<p>$msg</p>";
											}
										}
										else
										{
											$msg = "** OTP dosnot match try again.";
											echo "$form<p>$msg</p>";	
										}
									}
									else
									{
										session_destroy();
										header("location:./index.php");
										exit();
									}
								}
								else
								{
									$msg = "** Please enter OTP";
									echo "$form<p>$msg</p>";
								}
							}
							else
							{
								echo $form;
							}
						}
						else
							if($f_phn)
							{
								//confurm otp and go to passord reset page .....
								$form = "<h2>**To reset your password you must have to confurm your OTP**<h2>
								</br>
								<form action='otp.php' method='post'>
								<fieldset>
									<table>
										<tr>
											<td><h4>We send a 4-digit password in you mobile no,$f_phn : $f_code<h4></td>
										</tr>
										</br>
										<tr>
											<td nowrap>
												<label>Enter OTP :</lable>
												<input type='password' name='code' placeholder='OTP'>
												<input type='submit' name='btn' value='Submit'>
											</td>
										</tr>
									<table>
								</fieldset>
								</form>";
								if($_POST['btn'])
								{
									$getcode = $_POST['code'];
									if($getcode)
									{
										require("connect.php");
										$sql = "select * from user where phn='$f_phn'";
										$result = $conn->query($sql);
										if($result->num_rows == 1)
										{
											$row = $result->fetch_assoc();
											$dbphn = $row['phn'];
											$dbcode = $row['code'];
											if($dbcode==$getcode && $dbphn==$f_phn)
											{
												session_destroy();
												session_start();
												$reset = $_SESSION['reset'];
												$_SESSION['reset'] = $dbphn;
												header("location:./reset_password.php");
												exit();
											}
											else
											{
												$msg = "** OTP dosnot match try again.";
												echo "$form<p>$msg</p>";	
											}
										}
										else
										{
											session_destroy();
											header("location:./index.php");
											exit();
										}
									}
									else
									{
										$msg = "** Please enter OTP";
										echo "$form<p>$msg</p>";
									}
								}
								else
								{
									echo $form;
								}
							}
				?>
			</center>
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>