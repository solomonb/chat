<?php	
	include '../elems/init.php';	
	session_start();
	
	if(isset($_POST['submit'])){
		if (!empty($_POST['login']) and !empty($_POST['password'])){
			$login = $_POST['login'];
			$password = $_POST['password'];				
		
				//Получим данные из таблицы registration пользователя с логином $login
			$query = "SELECT * FROM registration WHERE login = '$login'";
			$result = mysqli_query($link,$query);				
			$user = mysqli_fetch_assoc($result);
				
				if(!empty($user)){				
					$hash = $user['password'];
					//Проверим на соответствие паролей введенного и хранимого в таблице registration
					if(password_verify($_POST['password'],$hash)){
						if($user['banned'] !=1){
							$_SESSION['reg']=true;
							$_SESSION['log']=$_POST['login'];
							$_SESSION['name_active']=$user['name'];
							$_SESSION['id']=$user['id'];
							$_SESSION['email']=$user['email'];
							$id=$_SESSION['id'];
								
								if ($_SESSION['reg']){
									$query = "UPDATE registration SET status_active = '1' WHERE id ='$id'";
									mysqli_query($link, $query) or die(mysqli_error($link));
								} 
																				
								if ($user['status']=='admin'){
									$_SESSION['status']='admin';
								}else $_SESSION['status']='user';
							
							header("Location: ../index.php");				
							exit; 	
						} else echo 'Ваш аккаунт заблокирован';
					} else echo 'вы неправильно ввели логин или пароль!!';
				
				} else 	echo 'вы неправильно ввели логин или пароль!';					
		
		} else echo 'Вы не ввели логин или пароль';
	}
	
						
		?>	
<link rel = "stylesheet" href = "style.css?v3">
<title>Анекдоты</title>
	<body>
		<nav>
		<div class= "center">
			<form method = "POST">
				Логин:<br>
				<input name="login" value= "<?php if(isset($_POST['login'])) echo $_POST['login']?>"><br>
				
				Пароль:<br>
				<input type="password" name= "password"><br>
				<input type="submit" name = "submit">
			</form>	

			<a href = "../index.php">Вернуться на главную страницу</a>
		</div>
		</nav>
	</body>
	
	