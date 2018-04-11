<?php
  include '../php/dbh.php';
  session_start();

  $userLoggedIn = 0;
  $uType = 2;
  $uName = "";
  if(isset($_SESSION['uID'])){
    $userLoggedIn = $_SESSION['uID'];
    $uName = $_SESSION['uName'];
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;

}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  text-align:center;
  float: right;
  
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;

}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;

}

.tab input{
  background: #fff;
  border-radius: 5px;
  display: inline-block;
  height: 25px;
  margin: 0;
  padding: 2.5px;
  position: relative;
  transform: translateY(25%);
  width: 250px;
}

#submitbutton{
  background-color: #009933;
  border-style: ridge;
  height: 50px;
  width: 200px;
}
#cancelbutton{
  background-color: #ff3333;
  border-style: ridge;
  height: 50px;
  width: 180px;
}

</style>
</head>
<body>
<div class="tab" > <a href="index.php">
        <button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>

  <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"post.php\"><button class=\"tablinks\" onclick=\"\" style=\"float: left;\">Create Post</button></a>";
          echo "<button class=\"tablinks\" onclick=\"location.href='profile.php?un=".$uName."';\">".$uName."</button>";
          echo "<a href=\"../php/signOut.php\"><button class=\"tablinks\" onclick=\"\">Sign out</button></a>";
      }else{
          echo "<a href=\"login.html\"><button class=\"tablinks\" onclick=\"\">log In</button></a>";
          echo "<a href=\"signup.php\"><button class=\"tablinks\" onclick=\"\">Sign Up</button></a>";
      }
  ?>
  <a href="categories.php"><button class="tablinks" onclick="">Explore Creators</button></a>
  <div style="float: right; box-sizing: border-box;">
   <form action="search.php" method="post">
     <input type="text" placeholder="Search.." name="patSearch">
     <button type="submit">search</button>
   </form>
  </div>


</div>

<form>
  <center>
  <p style="font-size:25px;">Password Confirmation</p>
  <input type="Password" name="password"><br><br>
  <button id="submitbutton" type="submit">Confirm</button><br><br>
  <button id="cancelbutton" type="cancel">Cancel</button>
  </center>
</form>
<hr>



     
</body>
</html> 
