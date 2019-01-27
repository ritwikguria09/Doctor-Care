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
				color: whitw;
				font-size: 160%;
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
			.t table {
				border-collapse: collapse;
				width: 100%;
			}

			.t th, td {
				text-align: left;
				padding: 8px;
			}

			.t tr:nth-child(even){background-color: #f2f2f2}

			.t th {
				background-color: #4CAF50;
				color: white;
			}
		</style>
	</head>
<body>
	<body>
		<div class="container">
			<header>
				
				<?php
					require("./connect.php");
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
							<li><a class="active" href="./history.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">History</a></li>
							<li><a href="./profile.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Profile</a></li>
							<li><a href="./home.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Home</a></li>
						</ul>';
					echo $form;
				?>
			</header>
			<nav>
			</nav>
			<article>
				<center>
					<br><br><br><br><br>
					<?php
						$sql="select * from history where phn='$newphn'";
						$result = $conn->query($sql);
						if($result->num_rows == 0)
						{
							echo "You dont have any history";
						}
						else
						{
							$frm1='<table class="t">
									<tr style="padding: 12px">
											<th>Problem Regarding</th>
											<th>Description</th>
											<th>Description</th>
											<th>Medicine With Power</th>
										</tr>';
										echo $frm1;
							while($row=$result->fetch_assoc())
							{
								$id=$row['disease_id'];
								$sql="select * from disease where id='$id'";
								$result2 = $conn->query($sql);
								if($result2->num_rows==1)
								{
									$row2=$result2->fetch_assoc();
									$stp1=$row2['step1'];
									$stp2=$row2['step2'];
									$stp3=$row2['step3'];
									$mdcn=$row2['medicine'];
									$frm='
										<tr>
											<td>'.$stp1.'</td>
											<td>'.$stp2.'</td>
											<td>'.$stp3.'</td>
											<td>'.$mdcn.'</td>
										</tr>';
									echo $frm;
								}
							}
							$frm2 = '</table>';
							echo $frm2;
						}
					?>
				</center>
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>