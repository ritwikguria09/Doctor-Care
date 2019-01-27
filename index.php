
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
				padding: 16px 32px;
				text-decoration: none;
				margin: 4px 2px;
				width: 100%;
				cursor: pointer;
			}
			input[type=text], [type=password] {
				width: 300px;
				padding: 12px 20px;
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
					<h3>Please Sign in or <a href="register.php">Register</a><h3>
					<?php
					$form = "<form action='index.php' method='post'>
								<fieldset>
									<table>
										<tr>
											<td><label>Username:</label></td></br>
											<td><input type='text' name='user' placeholder='10 digit mobile no'></td>
										</tr>
										<tr>
											<td><label>Password:</label></td>
											<td><input type='password' name='pass' placeholder='Password'></td>
										</tr>
										<tr>
											<td></td>
											<td><input type='submit' name='loginbtn' value='Sign in'></td>
										</tr>
										<tr>
										<td></td>
										<td align='right'><a href='forget_password.php'><h6>Forgrt password ? </h6></a></td>
										</tr>
									</table>
								</fieldset>
							</form>
							<a href='register.php'><h4>Create an Account</h4></a>";
					if($phn)
					{
						header("location:./home.php");
						exit();
					}
					if($_POST['loginbtn'])
					{
						$user = $_POST['user'];
						$password = $_POST['pass'];
						if($user)
						{
							if($password)
							{
								require("connect.php");
								
								$password = md5($password);
								//make sure login info correct
								$sql = "select * from user where phn = '$user'";
								$result = $conn->query($sql);
								$numrows = $result->num_rows;
								if($numrows == 1)
								{
									$row = $result->fetch_assoc();
									$dbphn = $row['phn'];
									$dbpass = $row['password'];
									$dbname = $row['name'];
									$dbactive = $row['active'];
									
									if($password == $dbpass)
									{
										if($dbactive == 1)
										{
											// Username & Password match ... go to home.
											session_destroy();
											session_start();
											$phn = $_SESSION['phn'];
											$_SESSION['phn'] = $dbphn;
											header("location:./home.php");
											exit();
										}
										else
										{
											echo "<p>** You need to active your account.</p> $form";
										}
									}
									else
									{
										echo "<p>** You did not enter correct password.</p> $form";
									}
								}
								else
								{
									echo "<p>** usename dos not exist pleas register!</p> $form";
								}
								$conn->close();
							}
							else
							{
								echo "<p>** You mudt enter yuor Password.</p> $form";
							}
						}
						else
						{
							echo "<p>** You mast enter your Username.</p> $form";
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