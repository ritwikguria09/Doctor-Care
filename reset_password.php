<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$reset = $_SESSION['reset'];
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
					<h3>Register Your name with us<h3>
					<?php
						if($phn)
						{
							header("location:./home.php");
							exit();
						}
						else
							if($reset)
							{
								if($_POST['btn'])
								{
									$getpass = $_POST['pass'];
									$getrepass = $_POST['repass'];
									if($getpass == $getrepass)
									{
										require("connect.php");
										$md5pass = md5($getpass);
										$sql = "update user set password='$md5pass' where phn='$reset'";
										if($conn->query($sql)== TRUE)
										{
											session_destroy();
											header("location:./index.php");
											exit();
										}
										else
										{
											$errormsg = "** Thear is some problem $form";
										}
									}
									else
									{
										$errormsg = "** Retype password do not match $form";
									}
									
								}
								else
								{
									
								}
								$form = "<p>$errormsg</p>
								<form action='./reset_password.php' method='post'>
									<fieldset>
										<table>
											<tr>
												<td align='right'><label>New Password:</label></td>
												<td><input type='password' name='pass' placeholder='Password'></td>
											</tr>
											<tr>
												<td align='right'>Retype Password:</label></td>
												<td><input type='password' name='repass' placeholder='Retype same Password'></td>
											</tr>
											<tr>
												<td></td>
												<td><input type='submit' name='btn' value='Reset Password'></td>
											</tr>
										</table>
									</fieldset>
								</form>";
								
								echo $form;
							}
							else
							{
								header("location:./index.php");
								exit();
							}
						
					?>
				</center> 
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>