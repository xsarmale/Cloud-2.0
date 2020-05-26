<?php

require('encripting.php');

$conn = new mysqli('localhost', 'calin', 'boracalin20', 'cloud');
/* check connection */
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
   
//cand se apasa 'submit' se va face inregistrarea 

if(isset($_POST['submit']))
{
	//preluare datelor din form
   $nume=$_POST['name'];
   $email=test_input($_POST['email']);
   $tell=$_POST['tell'];
   $pass1=$_POST['pass1'];
   $pass2=$_POST['pass2'];
   
   //verificare daca cele 2 parole introduse coincide
   if($pass1 !== $pass2)
	{
	  echo "<script> alert('Parola nu coincide');
	                  window.location.href = '../inregistrare.html';
		    </script>";
    }else{
		
		//verificare daca este cont pe adresa de email
		$conn2 = new mysqli('localhost', 'calin', 'boracalin20', 'cloud');
		$sql2="SELECT * FROM `users` WHERE Email='$email'";
		$result = $conn2->query($sql2);
		if ($result->num_rows > 0)
		{  echo "<script> alert('Pe aceasta adresa de mail este deja un cont'); window.location.href = '../inregistrare.html';  </script>"; 
	    }else {	  
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                       echo "<script> alert('Vormatul de email nu este valid'); window.location.href = '../inregistrare.html';  </script>";
                  }else{
                  //inserare in DB
                  $pass1=password_hash($pass1, PASSWORD_DEFAULT);      
                  $sql="INSERT INTO users (Nume, Email, Telefon, Password) VALUES ('$nume','$email','$tell','$pass1')";
                  if ($conn->query($sql) === TRUE) { echo "<script> window.location.href = 'inregistrareok.html';  </script>";}
                  else { echo 'Error: '. $conn->error;}
                  }//pentru formatul de email 
		       } // se inchide verificarea de email daca exista in DB
	}//de la pass1===pass2

  }	 

//inchiderea conexiuni 
$conn->close();
$conn2->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>