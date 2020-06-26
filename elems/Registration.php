<?php 
	session_start();
	include '../elems/init.php';	
	
	$reg= false; //Установим флаг, если значение изменится переходим на основную страницу 
	
	if(isset($_POST['submit'])){
			if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['login']) && !empty($_POST['password'])&& !empty($_POST['confirm'])
				&& !empty($_POST['email'])){
				if($_POST['password']==$_POST['confirm']){
						
					$name=$_POST['name'];
					$surname=$_POST['surname'];
					$login= $_POST['login'];
					$password = password_hash($_POST['password'],PASSWORD_DEFAULT);//хэшируем пароль
					$birth_date = $_POST['birth_date'];
					$email_a = $_POST['email'];
						//Получим данные из таблицы registration пользователя с логином $login									
					$query = "SELECT * FROM registration WHERE login = '$login'";
					$user = mysqli_fetch_assoc(mysqli_query($link,$query));
					
					if(empty($user)){
						//проверим на корректность email 
						if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){
							if(strlen($login)>=4 && strlen($login)<=10){
								// проверим, что логин состоит только из латинских букв или цифр
								if(preg_match("#^[a-zA-Z0-9]+$#",$login)){	
														
									if(strlen($_POST['password'])>=6 && strlen($_POST['password'])<=12){
									//внесем в таблицу registration логин, пароль, дату регистрации и email
										$query = "INSERT INTO registration SET name = '$name',surname = '$surname',login = '$login', password= '$password',
										birth_date = '$birth_date', email = '$email_a', banned = '0', status= 'user',status_active= '1'";							
										mysqli_query($link,$query);
										
										$reg=true;
										$_SESSION['reg']=true;
										$_SESSION['log']=$login;
										$_SESSION['name_active']=$name;
										$_SESSION['status']='user';
										$_SESSION['email']=$email_a;
										
										/* if ($_SESSION['reg']){
											$query = "UPDATE registration SET status_active = '1' WHERE id ='$id'";
											mysqli_query($link, $query) or die(mysqli_error($link));
										} */
										
										$query = "SELECT * FROM registration WHERE login = '$login'";
										$user = mysqli_fetch_assoc(mysqli_query($link,$query));
										
										$_SESSION['id']=$user['id'];
																				
																	
									}else echo 'Пароль должен быть длиной от 6 до 12 символов';
								} else echo 'Логин должен состоять из латинских букв и/или цифр'; 	
							}else echo 'Логин должен быть длиной от 4 до 10 символов';
						}else echo 'Вы ввели неправильный почтовый адрес'; 
					}else echo "Логин $login занят, введите другой логин.";
				} else echo 'пароли не совпадают';
			} else echo 'вы не ввели логин или пароль, или другие данные о себе';
		}				
			
	if($reg){
		 header("Location: ../index.php");
		exit; 	
		
	} else {?>
<link rel = "stylesheet" href = "style.css?v3">
<title>Анекдоты</title>
	<nav>	
		<div class= "center">
			<form action="" method="POST">
				<p>имя:<input name="name" value= "<?php if(isset($_POST['name'])) echo $_POST['name']?>"></p>
				<p>Фамилия:<input name="surname" value= "<?php if(isset($_POST['surname'])) echo $_POST['surname']?>"></p>
				<p>логин:<input name="login" onclick ="alert('Логин должен состоять из латинских букв и/или цифр, длиной от 4 до 10 символов')" value= "<?php if(isset($_POST['login'])) echo $_POST['login']?>"></p>
				<p>пароль:<input name="password" type="password"onclick ="alert('Пароль должен состоять из латинских букв и/или цифр, длиной от 6 до 12 символов')" value= "<?php if(isset($_POST['password'])) echo $_POST['password']?>"></p>
				<p>подтвердите пароль:<input name="confirm" type="password" value= "<?php if(isset($_POST['confirm'])) echo $_POST['confirm']?>"></p>
				<p>email:<input name="email" type = "email" value= "<?php if(isset($_POST['email'])) echo $_POST['email']?>" ></p>
				<p>день рождения:<input type ="date" name="birth_date" value= "<?php if(!empty($_POST['birth_date'])) echo $_POST['birth_date']?>"></p>
				<p><input type="submit" name = "submit" value="Отправить"></p>
			</form>
			<a href = "../index.php">Вернуться на главную страницу</a>
		</div>
	</nav>
<?php
	}							
?>

