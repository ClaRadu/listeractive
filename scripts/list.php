<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test"; // db name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error . "<br>"); }

// select data from the table
if (isset($_GET['show'])) {
	$show = $_GET['show'];
	
	if ($show > 1)
		$sql = "select * from users";
	else
		$sql = "select * from users where active='" . $show . "'";
	$result = runquery($conn, 'select', $sql, false);
	
	$ares = array();
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$ares[] = [ 'id' => $row['id'], 'name' => $row['name'], 'active' => $row['active'] ];
		}
	}
	
//	echo print_r($ares);	
	echo json_encode($ares);
}

// insert data to the table
if (isset($_GET['insid'])) {
	$insid = $_GET['insid'];
	$inval = $_GET['inval'];
	
	$sql = "update users set active='" . $inval . "' where id='" . $insid . "'";
	runquery($conn, 'update', $sql, true);
}

$conn->close(); // close connection

// function to run a mysql query
function runquery($conn, $strop, $sqlq, $showerr) {
	$res = '';
	if ($res = $conn->query($sqlq)) { if ($showerr) echo "Operation [" . $strop . "] completed successfully<br>"; }
	else { if ($showerr) echo "Error while trying to " . $strop . ": " . $conn->error . "<br>"; }
	
	return $res;
}

?>
