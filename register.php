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
					<h3>Register Your name with us<h3>
					<?php
						if($phn)
						{
							header("location:./home.php");
							exit();
						}
						if($_POST['registerbtn'])
						{
							$getphn = $_POST['phn'];
							$getname = $_POST['name'];
							$getgender = $_POST['gender'];
							$getdob = $_POST['dob'];
							$getpass = $_POST['pass'];
							$getconpass = $_POST['conpass'];
							$getwt = $_POST['wt'];
							$getht = $_POST['ht'];
							
							if($getphn)
							{
								if($getname)
								{
									if($getgender)
									{
										if($getdob)
										{
											if($getpass)
											{
												if($getpass == $getconpass)
												{
													require("./connect.php");
													$sql = "select * from user where phn = '$getphn'";
													$result = $conn->query($sql);
													if($result->num_rows==0)
													{
														$digits = 4;
														$code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
														$md5pass = md5($getpass);
														$image= file_get_contents('image\default.jpg');
														$image= base64_encode($image);
														$sql = "insert into user (phn,name,gender,dob,weight,height,password,active,img,code) values('$getphn','$getname','$getgender','$getdob','$getwt','$getht','$md5pass','0','$image','$code')";
														if($conn->query($sql) === TRUE)
														{
															$sql = "select * from user where phn = '$getphn'";
															$result = $conn->query($sql);
															if($result->num_rows > 0)
															{
																//Now active you account.
																session_destroy();
																session_start();
																$r_phn = $_SESSION['r_phn'];
																$r_code = $_SESSION['r_code'];
																$_SESSION['r_phn'] = $getphn;
																$_SESSION['r_code'] = $code;
																header("location:./otp.php");
																exit();
															}
															else
															{
																$errormsg = "** Thear is some problem pls try letar............... $form";
															}
															
														}
														else
														{
															echo "Error: " . $sql . "<br>" . $conn->error;
															$errormsg = "** Thear is some problem pls try letar(not created). $form";
														}
													}
													else
													{
														$errormsg = "** The no. is already register. please <a href='index.php'>login</a>$form";
													}
													
													$conn->close();
												}
												else
												{
													$errormsg = "** Ritype Password dos not match $form";
												}
											}
											else
											{
												$errormsg = "** Enter You password. $form";
											}
										}
										else
										{
											$errormsg = "** enter you date of birth $form";
										}
									}
									else
									{
										$errormsg = "** Select Gender .$form";
									}
									
								}
								else
								{
									$errormsg = "** You must have enter your name. $form";
								}
								
							}
							else
							{
								$errormsg = "** You mast enter your phn no $form";
							}
							
						}
						else
						{
							
						}
						$form = "<p>$errormsg</p>
						<form action='./register.php' method='post'>
							<fieldset>
								<table>
									<tr>
										<td align='right'><label>Phone No :</label></td>
										<td><input type='number_format' name='phn' value='$getphn' placeholder='10 digit mobile no'></td>
									</tr>
									<tr>
										<td align='right'><label>Full Name :</label></td>
										<td><input type='text' name='name' value='$getname' placeholder='Name'></td>
									</tr>
									<tr>
										<td align='right'><label>Gender:</label></td>
										<td> <input type='radio' name='gender' value='Male'><b>Male  </b><input type='radio' name='gender' value='Female'><b>Female   </b><input type='radio' name='gender' value='Other'><b>Other   </b></td>
									</tr>
									<tr>
										<td align='right'><label>Data of Birth :</label></td>
										<td><input type='date' name='dob'></td>
									</tr>
									<tr>
										<td align='right'><label>Height :</label></td>
										<td><input type='number_format' name='ht' value='$getht' placeholder='in cm                 Optional'></td>
									</tr>
									<tr>
										<td align='right'><label>Weight :</label></td>
										<td><input type='number_format' name='wt' value='$getwt' placeholder='in Kg                 Optional'></td>
									</tr>
									<tr>
										<td align='right'><label>Password :</label></td>
										<td><input type='password' name='pass' value='' placeholder='Password'></td>
									</tr>
									<tr>
										<td><label>Confurm Password :</label></td>
										<td><input type='password' name='conpass' value='' placeholder='Retype Password'></td>
									</tr>
									<tr>
										<td></td>
										<td><input type='submit' name='registerbtn' value='Register'></td>
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