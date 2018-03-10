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
</style>
</head>
<body>
 <div class="tab" >
  <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  
  <?php
            
      if($userLoggedIn != 0){
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
    <p>1st level patreon</p>
    <a href=""><button class="subscribe" onclick="">subscribe</button></a>
    <p>2nd level patreon</p>
    <a href=""><button class="subscribe" onclick="">subscribe</button></a>
    <p>3rd level patreon</p>
    <a href=""><button class="subscribe" onclick="">subscribe</button></a>
  </th>
  <th id="descripts">
   <p><h1>Description </h1><?php echo $row['description']?><br>
   <p><h1>Creator name</h1>
   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, </p>

  </th>
  </tr>
  </table>
  </div>
</body>
</html>