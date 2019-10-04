
<?php 
    session_start();


    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }


?>




<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration Form with HTML5 and CSS3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="">
                    <strong>&laquo; Previous Demo: </strong>Responsive Content Navigator
                </a>
                <span class="right">
                    <a href=" http://tympanus.net/codrops/2012/03/27/login-and-registration-form-with-html5-and-css3/">
                        <strong>Back to the Codrops Article</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar --> 
            <header>
                <h1>Change Password </h1>
				<nav class="codrops-demos">

                    <?php 
                 
                    if(isset($_SESSION['username'])){
                        echo "<span><strong>Hello , ".$_SESSION['username']."</strong> </span>";
                        echo "<br>";
                        echo "<br>";
                        echo "<span><strong><a href='../Controller/logout.php'>logout</a></strong> </span>";
                    }
                    
                    
                    ?>
					
					
				</nav>
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                           <!-- change pass form -->
                        <div id="login" class="animate form">
                            <form  action="../Controller/change.php" autocomplete="on" method="POST"> 
                                <h1>Change password 14.Lưu Xuân Tùng - AT120458</h1> 
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> current password </label>
                                    <input id="password" name="current-password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>


                                <p> 
                                            <label for="password" class="youpasswd" data-icon="p"> new password </label>
                                            <input id="password" name="new-password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p> 
                                    
                                    <label for="password" class="youpasswd" data-icon="p"> re-password </label>
                                    <input id="password" name="re-new-password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                              
                                <p class="login button"> 
                                    <input type="submit" value="Change password"  name="submit"/> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>
                  
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>