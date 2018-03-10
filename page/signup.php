<?php
  include '../php/dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {font-family: Arial;}
#parent {
   display: table;
   width: 30%;
   margin:auto;
   vertical-align: middle;
}
#form_signup {
   display: table-cell;
   text-align: center;
   vertical-align: middle;
   margin:auto;

}
#form_signup input{
  height: 35px;
  width: 200px;
  text-align: center;
}
#form_signup button{
  height: 35px;
  width:170px;
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
</style>
</head>
<body>
  <div class="tab" >
    <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  
    <a href="login.html"><button class="tablinks" onclick=""/>Log In</button></a>
    <a href="categories.html"><button class="tablinks" onclick="">Explore Creators</button></a> 	
    <div style="float: right; box-sizing: border-box;">
      <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">search</button>
      </form>
    </div>
  </div>
  <div id="parent">
    <form id="form_signup" action="../php/userReg.php" method="post">
      <h1>Sign-up</h1>
      <hr>
      <p>
          <input type="text" id="username" name="regUserName" placeholder="Username" />
      </p>
      <p>
          <input type="text" id="email" name="regEMail" placeholder="Email" />
      </p>
      <p>
          <input type="password" id="password" name="regPassword" placeholder="Password" />
      </p>
      <p>
          <input type="password" id="confirm" name="regCheckPW" placeholder="Confirm Password" />
      </p>
      <p>
          Select Your Category:
          <select name="cat">
            <?php
                $sql = "select categoryname from categories";
                $result = mysqli_query($conn,$sql);

                while($cat = mysqli_fetch_assoc($result)){
                  echo "<option value=\"".$cat['categoryname']."\">".$cat['categoryname']."</option>";
                }
            ?>
            <!--<option value="Video & Film">Video & Film</option>
            <option value="Podcasts">Podcasts</option>
            <option value="Crafts & DIY">Crafts & DIY</option>
            <option value="Drawing & Painting">Drawing & Painting</option>
            <option value="Science">Science</option>
            <option value="Writing">Writing</option>
            <option value="Photography">Photography</option>
            <option value="Comics">Comics</option>
            <option value="Comedy">Comedy</option>
            <option value="Music">Music</option>
            <option value="Games">Games</option>
            <option value="Dance & Theater">Dance & Theater</option>
            <option value="Animation">Animation</option>
            <option value="Education">Education</option>
            <option value="All">All</option>-->
          </select>
      </p>
      <p>
          <button id="submitbutton" type="submit">Sign Up</button>
      </p>
    </form>
  </div>
</body>