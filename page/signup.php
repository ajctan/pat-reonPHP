<?php
  include '../php/dbh.php';
  session_start();
  if(isset($_SESSION['uID'])){
    $_SESSION['error'] = 2;
    header("Location: index.php");
  }
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
      <form action="search.php" method="post">
        <input type="text" placeholder="Search.." name="patSearch" autocomplete="off">
        <button type="submit">search</button>
      </form>
    </div>
  </div>
  <div id="parent">
    <form id="form_signup" action="../php/userReg.php" method="post">
      <h1>Sign-up</h1>
      <hr>
      <p>
          <input type="text" id="username" name="regUserName" placeholder="Username" autocomplete="off" />
      </p>
      <p>
          <input type="text" id="email" name="regEMail" placeholder="Email" autocomplete="off"/>
      </p>
      <p>
          <input type="password" id="password" name="regPassword" placeholder="Password" autocomplete="off"/>
      </p>
        <progress value="0" max="100" id="strength" style="width:230px"></progress>
      <p>
          <input type="password" id="confirm" name="regCheckPW" placeholder="Confirm Password" autocomplete="off"/>
      </p>
      <p>
          Select Your Category:
          <select name="cat">
            <?php
                $sql = "select categoryname from categories";
                $result = mysqli_query($conn,$sql);

                while($cat = mysqli_fetch_assoc($result)){
                  echo "<option value=\"".htmlspecialchars($cat['categoryname'])."\">".htmlspecialchars($cat['categoryname'])."</option>";
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
          <button id="submitbutton" type="submit" disabled="true">Sign Up</button>
      </p>
    </form>
  </div>

    <script type="text/javascript">
  var pass = document.getElementById("password")
  var email = document.getElementById("email")
  pass.addEventListener('keyup', function(){
    checkPassword(pass.value)
  })
  email.addEventListener('keyup', function(){
    validateEmail(email.value)
  })
  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    document.getElementById('submitbutton').disabled = 'disabled';
    if(re.test(email))
        document.getElementById('submitbutton').disabled = false;
        
  }
  function checkPassword(password){
    var strengthBar = document.getElementById("strength")
    var strength = 0;
    document.getElementById('submitbutton').disabled = 'disabled';
    if(password.match(/[a-z]+/)){
      strength += 1
    }
    if(password.match(/[A-Z]+/)){
      strength += 1
    }
    if(password.match(/[0-9]+/)){
      strength += 1
    }
    if (password.match(/[!@£$%^&*()~<>?]+/)) {
      strength += 1
    }
    if (password.length >= 8) {
      strength += 1
      document.getElementById('submitbutton').disabled = false;
    } else {
       document.getElementById('submitbutton').disabled = 'disabled';
    }
    switch(strength){
      case 0:
              strengthBar.value = 0;
              break
      case 1:
              strengthBar.value = 20;
              break
      case 2:
              strengthBar.value = 40;
              break
      case 3:
              strengthBar.value = 60;
              break
      case 4:
              strengthBar.value = 80;
              break
      case 5:
              strengthBar.value = 100;
              break
    }
  }
</script>
</body>