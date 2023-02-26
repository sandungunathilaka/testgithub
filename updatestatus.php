 <?php
$servername = "localhost";
$username = "root";
$password = "Procons@$123";
$dbname = "order";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Colombo');
$current_date=date('Y-m-d h:i:s'); 

$sql = "SELECT order_id,order_date FROM order_details where order_status='Processing'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  	
	$to_time = strtotime($current_date);
	$from_time = strtotime($row["order_date"]);
	$minutes= round(abs($to_time - $from_time) / 60,2);
	if($minutes>20){

$sql = "UPDATE order_details SET order_status='Done' WHERE order_id=".$row["order_id"];

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
	}else{
		echo $minutes= 'Order Id - '.$row["order_id"].', Minute-'.round(abs($to_time - $from_time) / 60,2). " <br>";
	}
   
  }
} else {
  echo "0 results";
}
$conn->close();
?> 