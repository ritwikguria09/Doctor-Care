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
		<script src="js\jquery.js"></script>
			<script>
				$(document).ready(function () {
					$("#searchbox").on('keyup',function () {
						var key = $(this).val();

						$.ajax({
							url:'fetchdata.php',
							type:'GET',
							data:'keyword='+key,
							beforeSend:function () {
								$("#results").slideUp('fast');
							},
							success:function (data) {
								$("#results").html(data);
								$("#results").slideDown('fast');
							}
						});
					});
				});
			</script>
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
				padding: 14px 50px;
				text-decoration: none;
				margin: 4px 2px;
				width: 100%;
				cursor: pointer;
			}
			input[type=search] {
				box-sizing: border-box;
				border: 2px solid #ccc;
				border-radius: 4px;
				font-size: 16px;
				background-color: white;
				background-repeat: no-repeat;
				padding: 12px 20px 12px 40px;
				width: 100%;
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
			th {
				background-color: #4CAF50;
				color: white;
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
							<li><a href="./history.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">History</a></li>
							<li><a href="./profile.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Profile</a></li>
							<li><a class="active" href="./home.php" style="display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none;">Home</a></li>
						</ul>';
					echo $form;
				?>
			</header>
			<nav>
			</nav>
			<article>
				<center>
					<br><br><br><br><br><br><br>
					<?php
					$form = '
						<form action="home.php" method="get">
							<table>
								<tr>
									<td Style="width:500px"><input type="search" name="keyword" placeholder="Search Names" id="searchbox" value="'.$txt.'"></td>
									<td><input type="submit" name="btn" value="Search"></td>
								</tr>
								<tr>
									<td><div id="results"></div></td>
									<td></td>
								</tr>
							</table>';
					if($_GET['btn'])
					{
						$key=$_GET['keyword'];
						$sql = "select id from search where searchtext like '%$key%'";
						$result = $conn->query($sql);
						$num = $result->num_rows;
						if($num == 1)
						{
							$row=$result->fetch_assoc();
							$id = $row['id'];
							$sql = "insert into history (phn,disease_id) values('$newphn','$id')";
							$result = $conn->query($sql);
							echo $form;
							$sql = "select * from disease where id=$id";
							$result2 = $conn->query($sql);
							if($result2->num_rows==1)
							{
								$row2=$result2->fetch_assoc();
								$stp1=$row2['step1'];
								$stp2=$row2['step2'];
								$stp3=$row2['step3'];
								$mdcn=$row2['medicine'];
								$frm='
								<div id="HTMLtoPDF">
									<table class="t">
										<tr style="padding: 12px">
											<th>Problem Regarding</th>
											<th>Description</th>
											<th>Description</th>
											<th>Medicine With Power</th>
										</tr>
										<tr>
											<td>'.$stp1.'</td>
											<td>'.$stp2.'</td>
											<td>'.$stp3.'</td>
											<td>'.$mdcn.'</td>
										</tr>
									</table>
								</div>
								<a href="#" onclick="HTMLtoPDF()">Download PDF</a>
								<script src="js/jspdf.js"></script>
								<script src="js/jquery-2.1.3.js"></script>
								<script src="js/pdfFromHTML.js"></script>';
								echo $frm;
							}
							else
								echo "problem";
						}
						else
							if($num == 0)
							{
								$sql = "insert into try_search (phn,search) values('$newphn','$key')";
								$conn->query($sql);
								echo $form;
							}
							else
							{
								$msg = "**type from the option list ";
								echo "<p>$msg</p>$form";
							}
						
					}
					else
					{
						echo $form;
					}
					?>
				</center>
			</article>

			<footer>Copyright &copy doctor care, Designed by Ritwik Kr. Guria</footer>
		</div>
	</body>
</html>