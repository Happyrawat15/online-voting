<?php

session_start();
if(!isset($_SESSION['userdata'])){
    header("location:../");
}

$userdata = $_SESSION['userdata'];
$groupsdata =$_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status = '<b style="color:red">Not Voted</b>';
}

else{
    $status = '<b style="color:green">Voted</b>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<style>

#backbtn{
    padding: 10px;
    border-radius: 5px;
    color: white;
    background-color: blueviolet;
    font-size:15px;
    float:left;
    margin:7px;
}

#logoutbtn{
    padding: 10px;
    border-radius: 5px;
    color: white;
    background-color: blueviolet;
    font-size:15px;
float:right;
margin:7px;

}

#profile{
    background-color:white;
    width:30%;
    padding:20px;
    float:left;
}

#group{
    background-color:white;
    width:60%;
    padding:20px;
    float:right;
}

#votebtn{
    padding: 10px;
    border-radius: 5px;
    color: white;
    background-color: blueviolet;
    font-size:15px;
  
}

#mainpanel{
    padding:10px;
}

#headersection{
    padding:10px;
}

#voted{
    padding: 10px;
    border-radius: 5px;
    color: white;
    background-color: green;
    font-size:15px; 
}
</style>
<div class="main ">
    <center>  
          <div id="headersection ">
          <a href="../"><button id="backbtn"> Back</button></a>
          <a href="logout.php"> <button id="logoutbtn"> Logout</button></a>
   <h1 style="margin-bottom:50px;margin-top:50px;">Online Voting System - Dashboard</h1>
   </div>
   </center>
   <hr>

<div id="mainpanel">

    
    <div id="profile">
        <center> 
            <img src="../uploads/<?php echo $userdata['photo']?>" height="100" width = "100" alt=""></center><br>
        <b>Name:</b><?php echo $userdata['name']?><br><br>
       <b>Mobile:</b><?php echo $userdata['mobile']?><br><br>
       <b>Address:</b><?php echo $userdata['address']?><br><br>
       <b>Status:</b><?php echo $status?><br><br>
       </div>
       
       <div id="group">
           <?php 
           if($_SESSION['groupsdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>
                <div>
                    <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100" alt="">
                    <b>Group Name:</b><?php echo $groupsdata[$i]['name'] ?><br><br>
                    <b>Votes:</b><?php echo $groupsdata[$i]['votes'] ?><br><br>
                    <form action="../api/vote.php" method ="POST">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">

                            <?php
                            if($_SESSION['userdata']['status']==0){
                                ?>
                                <input type="submit" name="votebtn" value="vote" id="votebtn">
                                <?php
                            }
                            else{
                                ?>
                                <button disabled type="button" name="votebtn" value="vote" id="voted">voted</button>
                                <?php
                            }
                            ?>

                        
                    </form>
                </div>
                <hr>
                <?php
            }
        }
           else{

           } 
           ?>

</div>

</div>


</div>
</body>
</html>