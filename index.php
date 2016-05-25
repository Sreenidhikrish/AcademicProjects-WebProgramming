<?php

//Start of session
session_start();

$count=1;
//Session id retrieved
$chatuserid ="";
$id = session_id();


if(isset($_GET['logout'])) //Invoked when log out is clicked
{

$ffname=$_GET['val'];

$fp = fopen($ffname, 'a'); //File opened to write the log out information
fwrite($fp, "<div class='msgln'><i>User".$variable1.$_SESSION['name']."has left the chat session"."</i><br></div>");

fclose($fp); //Close the file
$conn = mysql_connect("localhost","root","server"); //Connect to the DB and set status offline
mysql_select_db("information",$conn);
mysql_query("UPDATE USERSDATA SET status='offline' WHERE username='" . $_SESSION['name'] . "'");
mysql_close($dbhandle); //Close DB connection
session_destroy(); //Destroy the session

header("Location: index.php"); //Redirect the user
}

function loginForm(){ //Displays the login form with username and password
echo'
<div id="loginform">
<form action="index.php" method="post">
<p>Please enter your name and password to continue:</p>
<label for="name">Name:</label>
<input type="text" name="name" id="name" />
</br>
<label for="password">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspPassword:</label>
<input type="text" name="password" id="password" />
<input type="submit" name="enter" id="enter" value="Enter" />
</form>
</div>
';
}

if(isset($_POST['enter']) )
{

  if(($_POST['name'] == "") ||   ($_POST['password'] == "")   )  //Checks if either of the input field is empty
  {
            if($_POST['name'] == "")       
			   {			   
			   echo '<span class="error">Please type in a name</br></span>';
			   }
			   if($_POST['password'] == "")     
			   {
			    echo '<span class="error">Please type in a password</span>';
				}
				$count=1;
   }
   else
   {
			//If both the input fields are non-empty i.e. Username and password entered
			
					$conn = mysql_connect("localhost","root","server");
					mysql_select_db("information",$conn); 
					$result = mysql_query("SELECT username FROM USERSDATA WHERE username='" . $_POST["name"] . "' and password = '". $_POST["password"]."'");
						if($result == FALSE)
						 { 
							die(mysql_error()); // TODO: better error handling
						}
					$c  = mysql_num_rows($result); //Check if the username and password is present in DB
				    	if($c==0)
							{
												
							echo '<span class="error">Invalid user name</span>';
							$count=1;
							} 
				     	else
				  			{
							//If username and password are present in DB, check if the user i already logged in i.e. check the DB status of the user
							$result = mysql_query("SELECT status FROM USERSDATA WHERE username='" . $_POST["name"] . "' ");  
								if($result == FALSE)
									 { 
										die(mysql_error()); // TODO: better error handling
									 }
									
							$value = mysql_result($result,0);
							if($value=="online")
							{
							
							echo '<span class="error">User name in use</span>';
							$count=1;
							
							}
							else
							{
							//If the user name and password are present in DB, and user is not currently logged in authenticate the user
							mysql_query("UPDATE USERSDATA SET status='online' WHERE username='" . $_POST["name"] . "'");
						
							$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
							$count=0;
							// echo "Successfully authenticated";
							 							 
							}
   	
				           }	
							}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php
if($count==1)
{         
loginForm();
}

elseif($count==0){
?>

<div id="wrapper">
<div id="menu">
<p id="header_pos" class="Welcome">Welcome, <b><?php echo $_SESSION['name']?></br></b></p>
<p class="logout"><a id="exit" href="javascript:void(0)">Exit Chat</a></p>
<div style="clear:both"></div>
</div>
<div id="chatbox">


</div>
<div id="messagebox"> </div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
</script>
<script type="text/javascript"> 

$(document).ready(function(){

$vid=0;
$vname="";

$variable2= <?php echo json_encode($_SESSION['name']) ?>;
alert($variable2);



//Displays the friend's list
$("#chatbox").append("<ul id='myLink'></ul>");
    if($variable2!= "Friend1") //If username is not same as friend name create a <li>
	{
     $("#myLink").append("<li id='1'>" +
	 "<b>Friend1</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" + "</li></br></br></br>");
     }

	if($variable2 != "Friend2") //If username is not same as friend name create a <li>
	{
     $("#myLink").append("<li id='2'>" +
	 "<b>Friend2</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" + "</li></br></br></br>");
     }
	 
	 if($variable2 != "Friend3") //If username is not same as friend name create a <li>
	{
     $("#myLink").append("<li id='3'>" +
	 "<b>Friend3</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" + "</li></br></br></br>");
     }
	 
	 
	 if($variable2 != "Friend4") //If username is not same as friend name create a <li>
	{
     $("#myLink").append("<li id='4'>" +
	 "<b>Friend4</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" + "</li></br></br></br>");
     }
	 
	 
	 if($variable2 != "Friend5") //If username is not same as friend name create a <li>
	{
     $("#myLink").append("<li id='5'>" +
	 "<b>Friend5</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" + "</li></br></br></br>");
     }
	 
	 
	 	  
	 

//Exit call- on click of exit button
       $("#exit").click(function(){
       var exit = confirm("Are you sure you want to end the session?");
       if(exit==true)
	   {
	   
	      if(  (($variable2=="Friend1")&&($vname=="Friend2") )    ||   (($variable2=="Friend2")&&($vname=="Friend1") ) )
			{
	             window.location = "index.php?logout=true&val=log12.html";
			}
	     else if(  (($variable2=="Friend1")&&($vname=="Friend3") )    ||   (($variable2=="Friend3")&&($vname=="Friend1") ) )
			{
	             window.location = "index.php?logout=true&val=log13.html";
			}
	     else if(  (($variable2=="Friend1")&&($vname=="Friend4") )    ||   (($variable2=="Friend4")&&($vname=="Friend1") ) )
			{
	             window.location = "index.php?logout=true&val=log14.html";
			}
	     else if(  (($variable2=="Friend1")&&($vname=="Friend5") )    ||   (($variable2=="Friend5")&&($vname=="Friend1") ) )
			{
	             window.location = "index.php?logout=true&val=log15.html";
			}
	     else if(  (($variable2=="Friend2")&&($vname=="Friend3") )    ||   (($variable2=="Friend3")&&($vname=="Friend2") ) )
			{
	             window.location = "index.php?logout=true&val=log23.html";
			}
	     else if(  (($variable2=="Friend2")&&($vname=="Friend4") )    ||   (($variable2=="Friend4")&&($vname=="Friend2") ) )
			{
	             window.location = "index.php?logout=true&val=log24.html";
			}
	     else if(  (($variable2=="Friend2")&&($vname=="Friend5") )    ||   (($variable2=="Friend5")&&($vname=="Friend2") ) )
			{
	             window.location = "index.php?logout=true&val=log25.html";
			}
	     else if(  (($variable2=="Friend3")&&($vname=="Friend4") )    ||   (($variable2=="Friend4")&&($vname=="Friend3") ) )
			{
	             window.location = "index.php?logout=true&val=log34.html";
			}
	     else if(  (($variable2=="Friend3")&&($vname=="Friend5") )    ||   (($variable2=="Friend5")&&($vname=="Friend3") ) )
			{
	             window.location = "index.php?logout=true&val=log35.html";
			}
		else if(  (($variable2=="Friend4")&&($vname=="Friend5") )    ||   (($variable2=="Friend5")&&($vname=="Friend4") ) )
			{
	             window.location = "index.php?logout=true&val=log45.html";
			}
	   else if(  $vname=="")
			{
	             window.location = "index.php?logout=true&val=log.html";
			}
	   
	   
	   
	   
	   
	   
	   }
        
	   
	   
   });

$setvariable=0;
$regcounter=0;

$cname= <?php echo json_encode($_SESSION['name']) ?>;

//Invokes the function when friend name is clicked
$("#myLink li").click(function() {



$vname="Friend";
$vname+= this.id;
$vid=this.id;
alert($vname);



//Checks if friend name not equal to username to proceed
if($cname!=$vname)
 {
     if($regcounter==0)
	 {
	$chatuserid  = $vid;
	//Displays the text
	    $("#header_pos").text('Chatting with Friend '+ $chatuserid ); //Displays the friend the user is chatting with
		
//Message box created
 //Displays the dynamically created message box and submit button
$('#messagebox').append("<form action=''>");                
$('#messagebox form').append("<input type='text'  name='usermsg' id='usermsg' size:'63' />");
$('#messagebox form').append("<input type='submit'  name='submitmsg' id='submitmsg' value='Send' />");

 
if($setvariable==0)
{
	var newfilename="log.html"; //set a default value
	
    //Checks for the username and friend name and opens the corresponding log file	
	if(($variable2=="Friend1" && $vid =='2')||($variable2=="Friend2" && $vid =='1'))
	{var newfilename= "log12.html";
	alert(newfilename);
	$setvariable+=1;
    }
	//Checks for the username and friend name and opens the corresponding log file	
    else if(($variable2=="Friend1" && $vid =='3')||($variable2=="Friend3" && $vid =='1'))
	{var newfilename= "log13.html";
	alert(newfilename);
	$setvariable+=1;
    }
		
	//Checks for the username and friend name and opens the corresponding log file		
	else if(($variable2=="Friend1" && $vid =='4')||($variable2=="Friend4" && $vid =='1'))
	{var newfilename= "log14.html";
    alert(newfilename);
	$setvariable+=1;
	}
   //Checks for the username and friend name and opens the corresponding log file	
	else if(($variable2=="Friend1" && $vid =='5')||($variable2=="Friend5" && $vid =='1'))
	{var newfilename= "log15.html";
    alert(newfilename);
	$setvariable+=1;
	}
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend2" && $vid =='3')||($variable2=="Friend3" && $vid =='2'))
	{var newfilename= "log23.html";
    alert(newfilename);
	$setvariable+=1;
	}
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend2" && $vid =='4')||($variable2=="Friend4" && $vid =='2'))
	{var newfilename= "log24.html";
    alert(newfilename);
	$setvariable+=1;
	}
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend2" && $vid =='5')||($variable2=="Friend5" && $vid =='2'))
	{var newfilename= "log25.html";
    alert(newfilename);
	$setvariable+=1;
	}
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend3" && $vid =='4')||($variable2=="Friend4" && $vid =='3'))
	{var newfilename= "log34.html";
    alert(newfilename);
	$setvariable+=1;
	}
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend3" && $vid =='5')||($variable2=="Friend5" && $vid =='3'))
	{var newfilename= "log35.html";
    alert(newfilename);
	$setvariable+=1;
	}
	
	//Checks for the username and friend name and opens the corresponding log file
	else if(($variable2=="Friend4" && $vid =='5')||($variable2=="Friend5" && $vid =='4'))
	{var newfilename= "log45.html";
    alert(newfilename);
	$setvariable+=1;
	}

	}

	//The message typed in is retrieved and send to post.php
   $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val()  + "--"+ newfilename;
	  $.post("post.php", {text: clientmsg});
      $("#usermsg").attr("value", "");
      return false;
   });

setInterval (loadLog, 2500); //Refreshing and loading every 2.5sec

function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;

//AJAX function to load the chat log	
    $.ajax({ url: newfilename,
             cache: false,
             success: function(html){
                $("#chatbox").html(html);
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }
             },
    });
}
$regcounter=$regcounter+1;
}

}
});



});
</script>


<?php
}
?>

</body>
</html>