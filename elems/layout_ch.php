<!DOCTYPE html>
<html>
	<head>
		<title>Чат</title>
		<link rel = "stylesheet" href = "elems/style_ch.css?v11">
		<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
		
	</head>
	<body>						
		<header>
			<nav>							
				<?php if(empty($_SESSION['reg'])){
					echo '<div class= "left" onclick="location.href=\'elems/come.php\';">Войти</div>';
					}?>
					
				<?php if(empty($_SESSION['reg'])){
					echo '<div class= "left" onclick="location.href=\'elems/Registration.php\';">Регистрация<br></div>';
					}?>			
				  
				<?php if(!empty($_SESSION['reg']) && $_SESSION['status']=='admin'){
					echo '<div class= "left" onclick="location.href=\'elems/admin.php\';">admin</div>';
					}?>					
				
				<?php if(!empty($_SESSION['reg'])){
					echo '<div class= "left" onclick="location.href=\'elems/personalArea.php\';">Личный профиль</div>';
					}?>					
				
				<?php if(!empty($_SESSION['reg'])){
					echo '<div class= "left" onclick="location.href=\'elems/logout.php\';">Выйти</div>';
					}?>	
					
				<div class="right" onclick="location.href='elems/instruction.php';">Правила чата</div>	
				
				<div id= "hello">
					<?php if(!empty($_SESSION['reg'])){
						 echo "Здравствуйте, ".$_SESSION['log'];			
					}else echo ''; ?>					
				</div>
			</nav>	
			<?php
				if(!empty($_SESSION['reg'])){					
					echo'<div id = "users">';						
					echo $users;								
					echo'</div>';
				}			
				if(isset($_GET['user_page'])&& $_GET['user_page']='true'){
					echo '<div id = "box">';
						if(isset($_GET['name_user'])){
							echo'<div id = "name_user">';						
							echo $_GET['name_user'];								
							echo'</div>';
						}
					echo'<div id="user_content">';						
					echo'</div>';							
					echo'<div id="add_text">
							<form  action="" method="POST" id="form">		
							<textarea type="text" name="text1"  rows="10"  ></textarea><br>
							<input type="submit" name="submit" id="submit">
							</form>				
						</div>';
						echo'<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>';
					echo'<script src="elems/unload.js?v9"></script>';
					echo'<script src="elems/scrollTop.js?v9"></script>';
					echo '</div>';
					
				}		
			?>		
			
		</header>
		<footer>				
			Copyright &copy; 2020.Все права защищены			
		</footer>
		
	</body>		
</html>	
