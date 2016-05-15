<div class='footer_top'>
	<img src='img/softvision_logo.png' style='float:left;'>
	<span id='footerTop_text'>SOFTVISION GROUP. An Adams Production</span>
</div>
<footer>
            <div class='container12'>
               <div class="row">
                   <div class='footer_desktop'>
                    <div class="column3">
                        <ul>
                            <div id="header_title">Help and support</div>
                            <li><a href="faq">FAQ</a></li>
                       </ul>
                   </div>
                 
                   <div class="column2 social">
                        <ul>
                            <div id="header_title">Social</div>
                            <li>Join our community</li>
                            <a href="" class="fb"><div id='sm_txt'>facebook</div></a>
                            <a href="" class="tw"><div id='sm_txt'>Twitter</div></a>
                            <a href="" class="gp"><div id='sm_txt'>Google+</div></a>
                            <a href="" class="rss"><div id='sm_txt'>RSS</div></a>
                       </ul>
                   </div>
                   
                    <div class="column2">
                       <ul>
                           <div id="header_title">About us</div>
                           <li><a href="about">About us</a></li>
                           <li><a href="faq">FAQ</a></li>
                       </ul>
                   </div>
                   
                     <div class="column2">
                       <ul>
                           <div id="header_title">Agoras</div>
                           <li><a href="signup.php?reg=1">Signup</a></li>
                           <li><a href="signup.php?reg=0">Login</a></li>
                           <li><a href="index">agoras.com</a></li>
                       </ul>
                   </div>
                        
                    <div class="column1">
                       <ul>
                           <li><a href="forum.php?forum_name=knust">#KNUST</a></li>
                           <li><a href="forum.php?forum_name=ug">#UG</a></li>
                           <li><a href="forum.php?forum_name=music">Music</a></li>
                           <li><a href="forum.php?forum_name=fashion">Fashion</a></li>
                            <li><a href="forum.php?forum_name=movies">Movies</a></li>
                        
                       </ul>
                   </div>
                    <div class="column1">
                       <ul>
                           <li><a href="forum.php?forum_name=maths">Maths</a></li>
                           <li><a href="forum.php?forum_name=science">Science</a></li>
                           <li><a href="forum.php?forum_name=television">Television</a></li>
                           <li><a href="forum.php?forum_name=sports">Sports</a></li>
                       </ul>
                   </div>
                        
                     
                    </div>
                </div>
            </div>
                <hr>
                   <div id="footer_text">Copyright ©2016 Agoras.com.All right reserved|Designed and maintained by SoftVision Inc | <b>BETA VERSION</b> </div>
                <script src="js/jquery.js" type="text/javascript"></script>
				<script src="js/jquery.slides.min.js"></script>
                <script src="js/jquery-ui.js" type="text/javascript"></script>
                <script src="js/filestyle.min.js" type="text/javascript"></script>
                <script src="js/texteditor.js" type="text/javascript"></script>
                <script src="js/main.js" type="text/javascript"></script>
                <script src="js/ui.js" type="text/javascript"></script>
				<?php
					if(login_user()==true){
						echo "<script src='js/real-time.js' type='text/javascript'></script>";		
					}
				?>
            </footer>
            <!--End of footer -->
