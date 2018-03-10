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
<style>
body {font-family: Arial;}
#parent {
   display: table;
   width: 100%;
}
#form_signup {
   display: table-cell;
   text-align: center;
   vertical-align: middle;
   margin:auto;

}
.exploretab{

        border: 2px solid #e7e7e7;
        color: #515151;
        padding: 10px;
        width: 200px;
        text-align: center;
        font-size: 16px;
        margin: auto;
        transition-duration: 0.4s;
}

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

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;

}
.exploretab:hover{
  background-color: #e7e7e7;
  letter-spacing:0.5px;
}
</style>
</head>
<body>
	<div class="tab" >
  <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"profile.html\"><button class=\"tablinks\" onclick=\"\">".$uName."</button></a>";
          echo "<a href=\"../php/signOut.php\"><button class=\"tablinks\" onclick=\"\">Sign out</button></a>";
      }else{
          echo "<a href=\"login.html\"><button class=\"tablinks\" onclick=\"\">log In</button></a>";
          echo "<a href=\"signup.php\"><button class=\"tablinks\" onclick=\"\">Sign Up</button></a>";
      }
  ?>
  <div style="float: right; box-sizing: border-box;">
   <form action="/action_page.php">
     <input type="text" placeholder="Search.." name="search">
     <button type="submit">search</button>
   </form>
  </div>


</div>
<table align="center">
      <tr>
        <td><a href="category.php"><button class="exploretab" onclick="">Video & film</button></a></td>
        <td><a href="category.php"><button class="exploretab" onclick="">Comics</button></a></td>
        <td><button class="exploretab" onclick="">Podcasts</button></td>
        <td><button class="exploretab" onclick="">Comedy</button></td>
        <td><button class="exploretab" onclick="">Crafts & DIY</button></td>
      </tr>
      <tr>
        <td><button class="exploretab" onclick="">Music</button></td>
        <td><button class="exploretab" onclick="">Drawing & Painting</button></td>
        <td><button class="exploretab" onclick="">Games</button></td>
        <td><button class="exploretab" onclick="">Science</button></td>
        <td><button class="exploretab" onclick="">Dance & Theater</button></td>
      </tr>
      <tr>
        <td><button class="exploretab" onclick="">Writing</button></td>
        <td><button class="exploretab" onclick="">Animation</button></td>
        <td><button class="exploretab" onclick="">Photography</button></td>
        <td><button class="exploretab" onclick="">Education</button></td>
        <td><button class="exploretab" onclick="">All</button></td>
      </tr>
    </table>
</body>