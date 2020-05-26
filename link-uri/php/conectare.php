<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['mail']) || empty($_POST['pass'])) {
  echo "mail or pass is invalid";
}
else{
	
// Define $mail and $pass
$mail = $_POST['mail'];
$pass = $_POST['pass'];

// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "calin", "boracalin20", "cloud");

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT Email, Password  from users where Email=?  LIMIT 1";

$checkPass=check_password($mail);
if (password_verify($pass, $checkPass)){    
// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $mail);    
$stmt->execute();
$stmt->bind_result($mail, $pass);
$stmt->store_result();
if($stmt->fetch()) //fetching the contents of the row 
{
$_SESSION['login_user'] = $mail; // Initializing Session
header("location: profile.php"); // Redirecting To Profile Page
}
mysqli_close($conn); // Closing Connection
}else{
    echo "<script> alert('Parola incorecta'); window.location.href = '../conectare.html';</script>";}
}
}

if(isset($_POST["submit"])) {
    if (is_dir($_SESSION['login_user']) !== true ) {
            $dir  = mkdir($_SESSION['login_user']);
        }
}

function check_password($email)
{
    $conn = new mysqli('localhost', 'calin', 'boracalin20', 'cloud');
   /* check connection */
   if (mysqli_connect_errno()) {
    exit('Connect failed: '. mysqli_connect_error());
    }

   $sql = "SELECT PASSWORD FROM users WHERE Email='$email'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
    // output data of each row
     while($row = $result->fetch_assoc()) {
        return  $row["PASSWORD"];
     }
    } 
$conn->close();
}
?>