<?php
  include '../php/dbh.php';
  session_start();

  $userLoggedIn = 0;
  $uType = 2;
  $uName = "";
  if(isset($_SESSION['uID'])){
    $userLoggedIn = $_SESSION['uID'];
    $uName = $_SESSION['uName'];
  }else{
  	header("Location: index.php");
  }
  
  $sql = $conn->prepare("select * from users, categories where users.categoryid = categories.categoryid and username like ?");
  $sql->bind_param('s',$uName);

  $sql->execute();
  $res = $sql->get_result();
  $row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {font-family: Arial;}

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

.setting{
  background-color: gray;
  margin: auto;
  border: 1px solid #ccc;
  width:70%; 
  height:1000px;
  display: block;
   border-collapse: collapse;
   word-wrap:break-word;
   text-align: center;
   padding-top: 75px;

}

#editname, #editdesc, #editlvl1, #editlvl2, #editlvl3, #editcate, #editpw{
  display: none;
}
.profiledets{
  word-wrap:break-word;
  text-align: left;
  background-color: white;
  padding: 10px;
  width: 90%;
  margin: auto 1.5em; 
  display: inline-block;

}

#profname, #descriptions, #lvl1, #lvl2, #lvl3, #category, #pw{
  cursor: pointer;
  border: outset;
}

.levels{
  display: inline;
}

</style>



</head>
<body>
  <div class="tab" >
    <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
    <a href="post.php"><button class="tablinks" onclick="" style="float: left;">Create Post</button></a>

    <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"profile.php\"><button class=\"tablinks\" onclick=\"\">".$uName."</button></a>";
          echo "<a href=\"../php/signOut.php\"><button class=\"tablinks\" onclick=\"\">Sign out</button></a>";
      }else{
          echo "<a href=\"login.html\"><button class=\"tablinks\" onclick=\"\">log In</button></a>";
          echo "<a href=\"signup.php\"><button class=\"tablinks\" onclick=\"\">Sign Up</button></a>";
      }
  	?>
    <a href="categories.html"><button class="tablinks" onclick="">Explore Creators</button></a>   
    <div style="float: right; box-sizing: border-box;">
      <form action="search.php" method="post">
      <input type="text" placeholder="Search.." name="patSearch">
      <button type="submit">search</button>
      </form>
    </div>
  </div>

  <div class="setting">
    <div class="profiledets">
      Profile Name:
      <div id="profname" onclick="clickedname()"><?php echo $row['username'];?></div>
      <div id="editname">
        <form action="../php/chName.php" method="post">
          <input type="text" name="name" placeholder="New Name">
          <button id="submitname" type="submit" >save</button>
        </form>
      </div><br>

      Description
      <div id="descriptions" style="" onclick="clickeddesc()"><?php echo $row['description'];?></div>
      <div id="editdesc">
        <form action="../php/chDesc.php" method="post">
          <textarea name="desc" style="width:831px; height:92px;"></textarea> 
          <button id="submitdesc" type="submit" >save</button>
        </form>
      </div><br>

      <div id="levels">

      Patreon Level 1
      <span id="lvl1" onclick="clickedlvl1()">69</span>
      <span id="editlvl1">
        <form>
          <input type="text" name="lvl1sub" value="New amount">
          <button id="submitlvl1" type="submit" >save</button>
        </form>
      </span>
      Patreon Level 2
      <span id="lvl2" onclick="clickedlvl2()">169</span>
      <span id="editlvl2">
        <form>
          <input type="text" name="lvl2sublvl3sub" value="New amount">
          <button id="submitlvl2" type="submit" >save</button>
        </form>
      </span>
      Patreon Level 3
      <span id="lvl3" onclick="clickedlvl3()">1069</span>
      <span id="editlvl3">
        <form>
          <input type="text" name="lvl3sublvl3sub" value="New amount">
          <button id="submitlvl3" type="submit" >save</button>
        </form>
      </span><br><br>

      Category:
      <span id="category" onclick="clickedcate()"><?php echo $row['categoryname'];?></span>
      <div id="editcate">
        <form action="../php/chCat.php" method="post">
          <select name="cat">
            <option value="Video & Film">Video & Film</option>
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
            <option value="All">All</option>
          </select>
          <button id="submitlvl3" type="submit" >save</button>


        </form>
      </div><br><br>
      Password:
      <span id="pw" onclick="clickedpw()">Change</span>
      <div id="editpw">
        <form>
          Enter old Password<input name="oldpw" type="password"><br>
          Enter new Password<input name="newpw1" type="password"><br>
          Enter new Password Again<input name="newpw2" type="password"><br>
          <button id="submitpw" type="submit">Enter</button>
        </form>


    </div>

    </div>
  </div>

   <script>
    function clickedname(){
      var txt, frm;
      txt = document.getElementById("profname");
      frm = document.getElementById("editname");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickeddesc(){
      var txt, frm;
      txt = document.getElementById("descriptions");
      frm = document.getElementById("editdesc");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickedlvl1(){
      var txt, frm;
      txt = document.getElementById("lvl1");
      frm = document.getElementById("editlvl1");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickedlvl2(){
      var txt, frm;
      txt = document.getElementById("lvl2");
      frm = document.getElementById("editlvl2");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickedlvl3(){
      var txt, frm;
      txt = document.getElementById("lvl3");
      frm = document.getElementById("editlvl3");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickedcate(){
      var txt, frm;
      txt = document.getElementById("category");
      frm = document.getElementById("editcate");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    function clickedpw(){
      var txt, frm;
      txt = document.getElementById("pw");
      frm = document.getElementById("editpw");
      txt.style.display = "none";
      frm.style.display = "inline-block";
    }
    
  </script>


</body>
</html>