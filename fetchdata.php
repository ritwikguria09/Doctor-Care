<?php
    if($_GET['keyword'] && !empty($_GET['keyword']))
    {
		require("connect.php");
        $keyword = $_GET['keyword'];
        $query = "select * from search where searchtext like '%$keyword%'";
		$statement=$conn->query($query); 
        if($statement->num_rows == 0)
        {
            echo '<div id="item"><p>No results found :</p></div>';
            $statement->close();
            $conn->close();

        }
        else {
            while ($row=$statement->fetch_assoc())
            {
				echo '<div id="item">'.$row['searchtext'].'</div>';
            }
            $statement->close();
            $conn->close();
        };
    };
?>