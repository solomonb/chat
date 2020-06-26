<?php
	 error_reporting(E_ALL);
	ini_set('display_errors','on');	
	session_start();				
	include 'elems/init.php';	
	
	$users='';	
	
	//Проверка есть зарегистрирован ли пользователь и вывод перечня пользователей
	if(!empty($_SESSION['reg'])){
		$login_active = $_SESSION['log'];	
		$query = "SELECT * FROM registration WHERE login != '$login_active'";
		//$query = "SELECT * FROM registration WHERE status_active='0'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
		foreach ($data as $elem) {				
			$users.='<a href = "index.php?id='.$elem['id'].'&&user_page=true&&name_user='.$elem['login'].'">'.$elem['login'].'</a>'.'<br>';			
		}
	
		//Выбор собеседника из перечня, определяем его id и выводим все сообщения с этим собеседником
		if (isset($_GET['id'])){
			$id=$_GET['id'];
			$query = "SELECT * FROM registration WHERE id='$id'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
				foreach ($data as $elem) {
					$name=$elem['name'];
					$log =$elem['login'];				
				}
			$_SESSION['log1']=$log;
			$_SESSION['name1']= $name;
			$login=$_SESSION['log'];
			$name_active=$_SESSION['name_active'];				
				
				//Отправка данных в базу данных				
				if(isset($_POST['submit'])){
					if(!empty($_POST['text1'])){
						$text = $_POST['text1'];				
						$date = date('d-m-Y H:i:s');
						
						$query = "INSERT INTO message set text ='$text', login='$login', whom='$name', date= '$date'";
						$result=mysqli_query($link,$query) or die(mysqli_error($link));	
					} 
				}
		}
	}
	include 'elems/layout_ch.php';				 