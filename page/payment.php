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

#paybutton{
  background-color: #009933;
  border-style: ridge;
  height: 75px;
  width: 250px;
}
#payment{
  margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
</style>
</head>
<body>
<div class="tab" > <a href="index.php">
        <button class="tablinks" onclick="openCity(event, 'London')" style="float: left;">PAT-REON</button></a>

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
<br><br>
<div id="payment">
  <form style="text-align: center;">
    Card Number<br>
    <input type="text" name="cardnum"><br><br>
    Expiry Date<br>
    <input type="number" name="year" min="1" max="12" placeholder="mm"> / <input type="number" name="month" min="00" max="18" placeholder="yy"><br><br>
    CVV<br>
    <input type="text" name="cardnum"><br><br>
    <button id="paybutton" type="submit" >Pay $143 & Pat</button>
  </form>
</div>

     
</body>
</html> 
