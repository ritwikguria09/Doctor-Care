<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$phn = $_SESSION['phn'];
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
				width : 100%;
				top: 0;
				right: 0;
				left: 0;
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
				padding: 16px 32px;
				text-decoration: none;
				margin: 4px 2px;
				width: 100%;
				cursor: pointer;
			}
			input[type=text], [type=password], [type=number_format], [type=date] {
				width: 300px;
				padding: 5px 15px;
				margin: 3px 0;
				box-sizing: border-box;
			}
			fieldset {
				border:1px solid #999;
				border-radius:8px;
				box-shadow:0 0 10px #999;
				padding: 1em;
				width: 50%;
			}
			label {
				width:50%;
				margin-right: 0.5em;
				padding-top:0.2em;
				text-align: right;
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
					<h3>Reset your password<h3>
					<?php
						if($phn)
						{
							header("location:./home.php");
							exit();
						}
						if($_POST['btn'])
						{
							$getphn = $_POST['phn'];
							$getdob = $_POST['dob'];
							if($getphn)
							{
								if($getdob)
								{
									require("connect.php");
									$sql = "select * from user where phn='$getphn' and dob='$getdob'";
									$result = $conn->query($sql);
									if($result->num_rows == 1)
									{
										$row = $result->fetch_assoc();
										$digits = 4;
										$code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
										$sql = "update user set code='$code'";
										if($conn->query($sql)== TRUE)
										{
											session_destroy();
											session_start();
											$f_phn = $_SESSION['f_phn'];
											$f_code = $_SESSION['f_code'];
											$_SESSION['f_phn'] = $getphn;
											$_SESSION['f_code'] = $code;
											header("location:./otp.php");
											exit();
										}
										else
										{
											echo "<p>** Thear is some problem</p>$form";
										}
									}
									else
									{
										echo "<p>** phn and date of birth do not match </p>$form";
									}
								}
								else
								{
									echo "<p>** You must enter date of birth</p>$form";
								}
								
							}
							else
							{
								echo "<p>** You mast enter your phn no</p> $form";
							}
							
						}
						else
						{
							
						}
						$form = "
						<form action='./forget_password.php' method='post'>
							<fieldset>
								<table>
									<tr>
										<td align='right'><label>Phone No :</label></td>
										<td><input type='number_format' name='phn' value='$getphn' placeholder='10 digit mobile no'></td>
									</tr>
									<tr>
										<td align='right'><label>Data of Birth :</label></td>
										<td><input type='date' name='dob'></td>
									</tr>
									<tr>
										<td></td>
										<td><input type='submit' name='btn' value='Send OTP'></td>
									</tr>
								</table>
							</fieldset>
						</form>";
						
						echo $form;
						
					?>
				</center> 
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>