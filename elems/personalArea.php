<?php
	session_start();
	include '../elems/init.php';
	
		if(!empty($_SESSION['reg'])){
			$id = $_SESSION['id'];
			$query = "SELECT * FROM registration WHERE id ='$id'";
			$result = mysqli_query($link,$query) or die(mysqli_error($link));
			for($data = []; $row = mysqli_fetch_assoc($result); $data[]=$row);
				foreach($data as $elem){
					$log = $elem['login'];
					$em = $elem['email'];
					$birth = $elem['birth_date'];					
				}					
		
			if(isset($_POST['submit'])){
				if(!empty($_POST['login'])&& !empty($_POST['email'])&& !empty($_POST['birth_date']) && !empty($_POST['password'])){
					$query = "SELECT * FROM registration WHERE id='$id'"; // получаем юзера по $id из сессии
					$result = mysqli_query($link, $query);
					$user = mysqli_fetch_assoc($result);
						
					$hash = $user['password']; // соленый пароль из БД
					// Проверяем соответствие хеша из базы введенному паролю
					if (password_verify($_POST['password'], $hash)) {
					
					$login=$_POST['login'];
					$email=$_POST['email'];
					$birth_date=$_POST['birth_date'];
					$query="UPDATE registration SET login='$login', birth_date='$birth_date', email='$email' WHERE id ='$id'";
					mysqli_query($link,$query);
						$_SESSION['log']= $login;
						header("Location: ../index.php");
						exit;
					} else echo 'Вы неправильно ввели пароль';
				} else echo 'Вы не заполнили какое-то из полей';
			}	
		} 		
?>		
<link rel = "stylesheet" href = "style.css?v2">
<title>Анекдоты</title>
<body>
	<nav>
		<div class= "center">				
			<form action="" method="POST">	
				Если вы хотите изменить данные своего профиля,<br>
				внесите изменения и нажмите кнопку отправить
				<p>логин:<input name="login" value="<?= $log ?>" ></p>
				<p>емейл:<input name="email" type ="email" value="<?= $em ?>" ></p>
				<p>день рождения:<input type ="date" name="birth_date" value= "<?= $birth ?>"></p>
				<p>пароль:<input name="password" type="password"></p>
				<p><input type="submit" name = "submit" value="Отправить"></p>
			</form>

			<p><a href = "changePassword.php">Изменить пароль</a></p>
			<p><a href = "Delete.php">Удалить свой аккаунт</a></p>

			<a href = "../index.php">Вернуться на главную страницу</a>
		</div>
	</nav>
</body>