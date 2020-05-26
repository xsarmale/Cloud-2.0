<?php
include('session.php');
if(!isset($_SESSION['login_user'])){
header("location: ..\conectare.html"); // Redirecting To Home Page    
}
?>

<!doctype html>
<html>

<head>
    
</head>

<header> 
       <div>
        <a id="welcome"><b> <i><?php echo $login_session; ?></b></i></a>
        <a id="logout"><b><a href="logout.php" style="color:white;">Log Out</a></b></a>
       </div>
</header>
    
<script>
        function _(el){
         	return document.getElementById(el);
        }
       function uploadFile(){
	      var file = _("file1").files[0];
	          
	      var formdata = new FormData();
	      formdata.append("file1", file);
	      var ajax = new XMLHttpRequest();
	      ajax.upload.addEventListener("progress", progressHandler, false);
	      ajax.addEventListener("load", completeHandler, false);
	      ajax.addEventListener("error", errorHandler, false);
	      ajax.addEventListener("abort", abortHandler, false);
	      ajax.open("POST", "upload.php");
	      ajax.send(formdata);
		  }
		  
      function progressHandler(event){
	    _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	    var percent = (event.loaded / event.total) * 100;
	   _("progressBar").value = Math.round(percent);
	   _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
	   }
	   
      function completeHandler(event){
	     _("status").innerHTML = event.target.responseText;
	     _("progressBar").value = 0;
		 }
		 
      function errorHandler(event){
	    _("status").innerHTML = "Upload Failed";
		}
		
      function abortHandler(event){
	    _("status").innerHTML = "Upload Aborted";
		}  		
</script>    
    
    <style>
        header{
            background-color: black;
            color: white;
        }
        body{
            margin: 0;
            padding: 0;  
        }
        footer{
            background-color: aqua;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        }
        .form_upload{
            position: flex;
            padding-top: 2%; 
            padding-bottom: 15px;
            
        }
        #upload_form{
            position: flex;
            text-align: center;
        }
        #upload{
            position: flex;
            width: 25%;
            text-align: center;
            background-color: red;
            color:white;
        }
        #upload:hover{
            background-color: forestgreen;
            color:blueviolet;
        }
        #progressBar{
            background-color: green;
            width: 25%;
        }
        .dir{
            border-top: 15px double;
            border-left: 15px double;
            border-right: 15px double;
            border-bottom: 15px double;
        }
        #fis
        {
            position: flex;
            border-style: double;
            align-content: center;
            text-align: center;
        }
    </style>
    
<body>
    
    <div class="form_upload">
      <form id="upload_form" enctype="multipart/form-data" method="post">
         <input type="file" name="file1" id="file1"><br><br>
         <input type="button" id="upload" value="Upload File" onclick="uploadFile()"><br><br>
         <progress id="progressBar" value="0" max="100" ></progress>
         <h3 id="status"></h3>
         <p id="loaded_n_total"></p>
      </form>
	 </div> 
    
     <div class="dir">
        <div id="fis"> 
	    <?php

         //afisarea din folder

          $dir= $_SESSION['login_user'] . "/";
          $heandle = opendir($dir. "/");

          while($file = readdir($heandle))
           {
  	          if($file!='.' && $file!='..')
	           {
	              echo '<a  href="' .$dir. '/'.$file.'">'.$file.'</a><br>';
	          }
           }
         ?>
        </div>
     </div>
    
</body>

</html>

