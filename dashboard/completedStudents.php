<?php
require ('login_connect.php'); 
session_start();
if(!isset($_SESSION['userId'])){
	header('Location:login.php');
}
?>
<div id="content_table">
	<input type="text" id="myInput" onkeyup="myFunction()" style="" placeholder="Search for names..">
	<p id="studentsList"><b>List of Students Completed:</b></p>
	<table id="tableID">
		<tr>
			<td>Name</td>
			<td>Year</td>
			<td>Branch</td>
			<td>Email</td>
			<td>Mobile</td>
			<!-- TO-DO: Print the Batch no alloted from the respective table -->
			<!-- <th>Batch</th> -->
		</tr>
		<?php
			//----- PostGRE SQL Commands -----
			// Printing 2018 Data:
			$result = pg_query_params($dbconn, "SELECT * FROM $tablename_IMac_2018 WHERE \"Status\"=$1",array('COMPLETED'));
			if (pg_result_status($result)==2) {
				while($row = pg_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>".$row["Name"]."</td>";
					echo "<td>".$row["Year"]."</td>";
					echo "<td>".$row["Branch"]."</td>";
					echo "<td>".$row["Email"]."</td>";
					echo "<td>".$row["Mobile"]."</td>";
							// echo "<td>".$row["Status"]."</td>";
							// echo "<td>".$row["Batch"]."</td>";
					echo "</tr>";
				}
			}
			else{
				echo "Query Failed.";
			}
				// Printing 2017 Data:
			$result = pg_query_params($dbconn, "SELECT * FROM $tablename_IMac WHERE \"Status\"=$1",array('COMPLETED'));
			if (pg_result_status($result)==2) {
				while($row = pg_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>".$row["Name"]."</td>";
					echo "<td>".$row["Year"]."</td>";
					echo "<td>".$row["Branch"]."</td>";
					echo "<td>".$row["Email"]."</td>";
					echo "<td>".$row["Mobile"]."</td>";
						// echo "<td>".$row["Status"]."</td>";
						// echo "<td>".$row["Batch"]."</td>";
					echo "</tr>";
				}
			}
			else{
				echo "Query Failed.";
			}
			// -X-X-X- End of PostGRE SQL Commands -X-X-X-

			//----- SQL Commands -----
			/*
			$sql = "SELECT * FROM $tableName WHERE Status='Completed'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				while ($row=mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>".$row["Name"]."</td>";
					echo "<td>".$row["Year"]."</td>";
					echo "<td>".$row["Branch"]."</td>";
					echo "<td>".$row["Email"]."</td>";
					echo "<td>".$row["Mobile"]."</td>";
					echo "<td>".$row["Status"]."</td>";
					echo "</tr>";
				}
			}else{
				echo "NO DATA";
			}
			*/
			// -X-X-X- End of SQL Commands -X-X-X-
			?>
		</table>
		<button onclick="$('#tableID').tableExport({type:'csv',escape:'false'});">Export</button>
	</body>
</div>