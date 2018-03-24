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
    body {font-family: Arial;
	}

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
	#Create{
	  margin: auto;
	  border: none;
	  width: 70%;
	  background: #ccccff;
	  padding:10px;
	  
	}
	#submitbutton{
	height:50px;
	width:100px;
	border: inset;
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
    <center><h1>Create Content</h1></center>
    <center><div id="Create">
        <form>
            <p>Make Post:</p>
            <textarea name="message" style="width:90%; height:300px;">
            </textarea> 
            <p>
              Available to
              <select name="cat">
                <option value="1st">1st Level Patreon</option>
                <option value="2nd">2nd Level Patreon</option>
                <option value="3rd">3rd Level Patreon</option>
              </select><br><br>
              <button id="submitbutton" type="submit">Post</button>
              
            </p>
        </form>
    </div></center>
        
    
</html>