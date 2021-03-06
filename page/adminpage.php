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
  if(!isset($_SESSION['uID']) || $_SESSION['uID'] != 1)
    header("Location: index.php");
  $sql = $conn->prepare("select * from users, categories where users.categoryid = categories.categoryid and users.username like ?");
  $sql->bind_param("s",$_SESSION['uName']);

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
  background-color: white;
  color: black;
  text-align: left;
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

.wrapper{
  width: 95%;
  margin: 0 auto;
  padding: 10px;
  background: white;
}
.optiontab{
  border-color: transparent;
  font-size: 20px;
  background:#888;
  color: #fff;
  padding:10px;
  cursor: pointer;
  transition: 0.2s;
}
.optiontab:focus{
  outline: none;
}
.optiontabs{
  display: flex;
}
.optiontab_post{
  background: #666;
  color: white;
  border-style: none;
}
#userlist{
  font-size: 20px;
  background:#888;
  padding: 5px 20px 5px;
  display:block;
}
#postlist{
  font-size: 20px;
  background:#666;
  padding: 5px 20px;
  color: #fff;
  display:none;
}
.list{
  border-style: none;
  background-color: #888;
}

.list:hover{
  color: #fff;
  background-color: #222;
}
.delbutton{
  border-style: none;
  background-color: transparent;
  color: white;
}


</style>
</head>
<body>
 <div class="tab" >
  <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"post.php\"><button class=\"tablinks\" onclick=\"\" style=\"float: left;\">Create Post</button></a>";
          echo "<a href=\"profile.php\"><button class=\"tablinks\" onclick=\"\">".htmlspecialchars($uName)."</button></a>";
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
    <p id="pageTitle"><?php echo "<h1>".htmlspecialchars($row['username'])."</h1>"?></p>     
    <hr>
      <p class="pageLegend">
      <?php echo htmlspecialchars($row['categoryname'])." pats are mine to manage!!!"?>      
      </p>
  </div>
  <div class="descriptions">
  <table id="patrontable">
  <tr>
    <div class="wrapper">
      <div class="optiontabs">
        <button class="optiontab" onclick="openuser()">Users</button>
        <button class="optiontab_post" onclick="openpost()">Posts</button>
      </div>

      <div id="userlist">
      <?php
        $sql = $conn->prepare("select * from users where userid not like 1");
        $sql->execute();
        $getRes = $sql->get_result();
        while($res = $getRes->fetch_assoc())
          echo "<div class=\"list\" onclick=\"\">".htmlspecialchars($res['username'])."<button class=\"delbutton\" type\"button\" style=\"float: right;\"onclick=\"location.href='../php/delUser.php?id=".htmlspecialchars($res['userid'])."';\">Delete</button></div>";
      ?>
      </div>
      <div id="postlist">
        <div class="posts">
          
          <?php
            $sql = $conn->prepare("select * from contents, users where users.userid = contents.userid order by contentid desc");
            $sql->execute();
            $getRes = $sql->get_result();
            while($res = $getRes->fetch_assoc()){
              echo "<div id=\"posts\">";
              echo "<h2 id=\"poster\">".htmlspecialchars($res['username'])."</h2>";
              echo "<div class=\"popup\"><button id=\"editpost\" onclick=\"myFunction('myPopup1')\"><img id=\"editimg\" src=\"../img/settings.png\"></button><br>";
              echo "<span class=\"popuptext\" id=\"myPopup1\"><button onclick=\"location.href='../php/delPost.php?pid=".htmlspecialchars($res['contentid'])."';\"style=\"border-style: none;background-color: #555;color: white;cursor: pointer;\">Delete</button></span>";
              echo "</div>";
              echo "<center></center><img id=\"postimg\" src=data:image/".htmlspecialchars($res['content_ext']).";base64,".base64_encode( $res['content_file'] ).">";
              echo "<p>".htmlspecialchars($res['content_message'])."</p>";
              echo "</div>";
            }
          ?>
        </div>
      </div>
        
    </div>

    </div>

  </tr>
  </table>
  </div>
  <script>
function myFunction(myPopup) {
    var popup = document.getElementById(myPopup);
    popup.classList.toggle("show");
}
function openuser(inside){
    var content1, content2;
    content1 = document.getElementById("postlist");
    content1.style.display = "none"
    content2 = document.getElementById("userlist");
    content2.style.display = "block"
}
function openpost(inside){
    var content1, content2;
    content1 = document.getElementById("userlist");
    content1.style.display = "none"
    content2 = document.getElementById("postlist");
    content2.style.display = "block"
}


</script>
</body>
</html>