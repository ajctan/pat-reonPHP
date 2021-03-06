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
  if(!isset($_POST['patSearch'])){
    $_SESSION['error'] = 3;
    header("Location: index.php");
  }
  $patSearch = $_POST['patSearch'];
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
    #categoryhead{
        display: block;
        border:none;
        outline: none;
        text-align: center;
        background-color: #ccc;
        padding: 10px;
      }
      #creators{
        display: block;
        border:ridge;
        outline: none;
        text-align: center;
        width: 75%;
        margin: auto;
        background-color: #dae4f2;
      }
      #creators button{
        border-color: #dae4f2;
       } 
      #creators button:hover{
        background-color: #c2d4ed;
      }
    </style>
    </head>
    <body>
    <div class="tab" >
      <a href="index.php"><button class="tablinks" onclick="" style="float: left;">PAT-REON</button></a>
  <?php
            
      if($userLoggedIn != 0){
          echo "<a href=\"post.php\"><button class=\"tablinks\" onclick=\"\" style=\"float: left;\">Create Post</button></a>";
          echo "<button class=\"tablinks\" onclick=\"location.href='profile.php?un=".htmlspecialchars($uName)."';\">".htmlspecialchars($uName)."</button>";
          echo "<a href=\"../php/signOut.php\"><button class=\"tablinks\" onclick=\"\">Sign out</button></a>";
      }else{
          echo "<a href=\"login.html\"><button class=\"tablinks\" onclick=\"\">log In</button></a>";
          echo "<a href=\"signup.php\"><button class=\"tablinks\" onclick=\"\">Sign Up</button></a>";
      }
  ?>
      <a href="categories.php"><button class="tablinks" onclick="">Explore Creators</button></a>
      <div style="float: right; box-sizing: border-box;">
       <form action="search.php" method="post">
     <input type="text" placeholder="Search.." name="patSearch autocomplete="off"">
     <button type="submit">search</button>
   </form>
      </div>
    </div>
    <div id="categoryhead">
     <p><?php echo "<h1>Search Results For '".htmlspecialchars($patSearch)."'</h1>"?>
    </div>
    <br>
    <?php
      $likePS = '%'.$patSearch.'%';
      //echo $likePS;
      $sql = $conn->prepare("select * from users, categories where users.userid > 1 and users.categoryid = categories.categoryid and (users.username like ? or users.description like ?)");
      $sql->bind_param('ss',$likePS,$likePS);

      $sql->execute();
      $res = $sql->get_result();
      $row = $res->fetch_assoc();
      if($row['username'] == null){
        echo "<h1 align=\"center\">No Results Found</h1>";
      }else{
        echo 
        "<div id=\"creators\">
          <button onclick=\"location.href='profile.php?un=".htmlspecialchars($row['username'])."';\" style=\"width:100%\"><p><h1>".htmlspecialchars($row['username'])."</h1></p>
          <p>".htmlspecialchars($row['description'])."</p></button></a>
        </div>";
      }


    ?>
</html>