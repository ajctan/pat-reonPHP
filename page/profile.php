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

  $sql = $conn->prepare("select * from users, categories where users.categoryid = categories.categoryid and users.username like ?");
  $sql->bind_param("s",$_GET['un']);

  $sql->execute();
  $res = $sql->get_result();
  $row = $res->fetch_assoc();
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
.user{
display: block;
  margin: 0 auto 10px auto;
  min-height: 200px;
  padding: 20px;
  position: relative;
  width: 80%;
  border: 1px solid #ccc;
}
#pageHead{
  display: block;
  margin: 0 auto 10px auto;
  min-height: 200px;
  padding: 20px;
  position: relative;
  width: 80%;
}
.pageLogo{
  border-radius: 200px;
  float: left;
  height: 200px;
  margin: 0 50px 0 0;
  width: 200px;
}
#pageTitle{
  display: block;
  font-size: 3.0em;
  font-weight: bold;
  margin: 40px 0 0 0;
  padding: 0;
  position: relative;
}
.pageLegend{
  color: #aaa;
  float: right;
  margin: 0;
}
.descriptions{
    display: block;
  margin: 0 auto 10px auto;
  min-height: 200px;
  padding: 20px;
  position: relative;
  width: 60%;
  border: 1px solid;
 border-collapse: collapse;
  text-align: center;

}
.subscribe{    
    display: block;
    margin: 0 auto 10px auto;
    width: 100%;
    height: 40px;
    text-align: center;
        border: groove;
    outline: none;
    position: relative;
        cursor: pointer;



}
#descripts{
    margin: 0 auto 10px auto;
    padding: 20px;
    text-align: left;
    float: center;
    vertical-align: top;


}
#patron{
    margin: 0 auto 10px auto;
    padding: 20px;
    float: left;

} 
#patrontable{
  border-collapse: collapse;

}
#posts{
  border-style: groove;
  border-color: #b8b894;
}
#postimg{
  max-width: 600px;
  max-height: 200px;
  display: block;
  padding: 20px;
  position: relative;

}
#poster{
  float: left;
}
#editpost, #editimg{
  float: right;
  height: 25px;
  width: 25px;
  border-style: none;
  background-color: white;
}

.popup {
  float:right;
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 1;}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}




</style>
</head>
<body>
 <div class="tab" >
  <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"post.php\"><button class=\"tablinks\" onclick=\"\" style=\"float: left;\">Create Post</button></a>";
          echo "<a href=\"profile.php\"><button class=\"tablinks\" onclick=\"\">".$uName."</button></a>";
          echo "<a href=\"../php/signOut.php\"><button class=\"tablinks\" onclick=\"\">Sign out</button></a>";
      }else{
          echo "<a href=\"login.html\"><button class=\"tablinks\" onclick=\"\">log In</button></a>";
          echo "<a href=\"signup.php\"><button class=\"tablinks\" onclick=\"\">Sign Up</button></a>";
      }
  ?>
  <a href="categories.html"><button class="tablinks" onclick="">Categories</button></a>     
  <div style="float: right; box-sizing: border-box;">
   <form action="search.php" method="post">
     <input type="text" placeholder="Search.." name="patSearch">
     <button type="submit">search</button>
   </form>
  </div>
 </div>
  <div class="user">
    <p id ="pagehead">
    <img class='pageLogo' src='../img/user.png'></p>
    <p id="pageTitle"><?php echo "<h1>".$row['username']."</h1>"?></p>     
    <hr>
      <p class="pageLegend">
      <?php echo $row['categoryname']?>      
      </p>
  </div>
  <div class="descriptions">
  <table id="patrontable">
  <tr>
  <th id="patron">
  <?php
    echo "<p>1st level patreon</p>";
    if($_GET['un'] === $uName)
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\" disabled>subscribe</button></a>";
    else
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\">subscribe</button></a>";
    echo "<p>2nd level patreon</p>";
    if($_GET['un'] === $uName)
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\" disabled>subscribe</button></a>";
    else
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\">subscribe</button></a>";
    echo "<p>3rd level patreon</p>";
    if($_GET['un'] === $uName)
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\" disabled>subscribe</button></a>";
    else
      echo "<a href=\"\"><button class=\"subscribe\" onclick=\"\">subscribe</button></a>";

    if($_GET['un'] === $uName)
      echo "<br> <a href=\"settings.php\"><button class=\"subscribe\" onclick=\"\">Settings</button></a>"

  ?>
  </th>
  <th id="descripts">
   <p><h1>Description </h1><?php echo $row['description']?><br><br>
   <div id="posts">
     <h2 id="poster">Creator name</h2>
     <div class="popup"><button id="editpost" onclick="myFunction()"><img id="editimg" src="../img/settings.png"></button><br>
     <span class="popuptext" id="myPopup"><button style="border-style: none;background-color: #555;color: white;cursor: pointer;">Delete</button></span>
     </div>
     <center></center><img id="postimg" src="../img/panda.png">
     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
   </div>

  </th>

  </tr>
  </table>
  </div>
  <script>
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
</script>
</body>
</html>