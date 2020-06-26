<?php
	include 'init.php';				
	session_start();
	
		
			$login=$_SESSION['log'];
			$name_active=$_SESSION['name_active'];				
			$log = $_SESSION['log1'];
			$name = $_SESSION['name1'];
			//Вывод данных из таблицы table_time
			function outputData(){
					global $user_content;
					$user_content='';
					include 'init.php';					
					$query = "SELECT * FROM table_time WHERE id>0 ORDER BY date";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
					foreach ($data as $elem) {
						if($_SESSION['log']==$elem['login']){
							$user_content.= '<p>'.$elem['text'].'<br>'.$elem['date'].'</p>';
							
						} else 
							$user_content.= $elem['text'].'<br>'.$elem['date'].'<br><br>';				
						}
						
						echo $user_content;
			}	
			
						
				if(!isset($_POST['submit'])){			
					
					outputData();				
					
				} else 
					include 'init.php';	
					$query = "DELETE FROM table_time";
					mysqli_query($link, $query) or die(mysqli_error($link));			
					
					//Отбор и запись данных из message в table_time у активного пользователя
					$query = "SELECT * FROM message WHERE login='$log' and whom='$name_active'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
					foreach ($data as $elem) {				
						$text_time= $elem['text'];
						$date_time= $elem['date']; 
						$login_time= $log;
						
						$query = "INSERT INTO table_time set login='$login_time', text ='$text_time', date= '$date_time'";
						$result=mysqli_query($link,$query) or die(mysqli_error($link));	
						
					}	
					 //Отбор и запись данных из message в table_time у собеседника
					$query = "SELECT * FROM message WHERE whom='$name' and login='$login'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
					foreach ($data as $elem) {	
						$text_time2= $elem['text'];
						$date_time2= $elem['date']; 
						$login_time2= $login;				
						
						$query = "INSERT INTO table_time set login='$login_time2', text ='$text_time2', date= '$date_time2'";
						$result=mysqli_query($link,$query) or die(mysqli_error($link));
					} 
				
					outputData();
					
					$query = "DELETE FROM table_time";
					mysqli_query($link, $query) or die(mysqli_error($link));					
	
