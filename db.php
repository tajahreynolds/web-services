<?php
$conn = mysqli_connect('ceclnx01.csi.miamioh.edu', 'exam', 'password', 'exam');
if (!$conn) {
	die("ERR: Could not connect. " .mysqli_connect_error());
}
$sql = "SELECT * FROM test";
if ($res = mysqli_query($conn, $sql)) {
	if (mysqli_num_rows($res) > 0) {
		
		echo "<table>"; 
		echo "<tr>"; 
		echo "<th>pk</th>";
	        echo "<th>name</th>"; 
	        echo "<th>col1</th>"; 
	        echo "<th>col2</th>"; 
	        echo "</tr>"; 
	        while ($row = mysqli_fetch_array($res)) { 
			echo "<tr>";
		       echo "<td>".$row['pk']."</td>";	
		            echo "<td>".$row['name']."</td>"; 
		            echo "<td>".$row['col1']."</td>"; 
		            echo "<td>".$row['col2']."</td>"; 
		            echo "</tr>"; 
		        } 
	        echo "</table>"; 
		mysqli_free_res($res); 
	} else {
		echo "No matching records found.";
	}
} else {
	echo "ERR: Could not execute $sql. ".mysqli_error($conn);
}
mysqli_close($conn);
?>
