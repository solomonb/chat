<?php
	session_start();
	include '../elems/init.php';
	
	
	$id=$_SESSION['id'];	
	$query = "SELECT * FROM registration WHERE id = '$id'"; 
	$result = mysqli_query($link, $query);
	$user = mysqli_fetch_assoc($result);	
	
	if($user['status']=='admin'){
	$_SESSION['status']='admin';
?>	

<title>Администратор</title>
	<body bgcolor="PaleGreen">
	<p><a href = "../index.php">Вернуться на сайт</a><p>
		<table border = "1">
		<tr>
			<th>id</th>
			<th>login</th>
			<th>email</th>
			<th>статус пользователя</th>
			<th>состояние пользователя</th>
			<th>удалить пользователя</th>
		</tr>

		<?php
				
			if(isset($_GET['bann'])){
				$bann =$_GET['bann'];
				$query = "UPDATE registration SET banned = '0' WHERE id=$bann";
				mysqli_query($link, $query) or die(mysqli_error($link));
			}
			if(isset($_GET['bann1'])){
				$bann =$_GET['bann1'];
				$query = "UPDATE registration SET banned = '1' WHERE id=$bann";
				mysqli_query($link, $query) or die(mysqli_error($link));
			}
			if(isset($_GET['del'])){
				$del =$_GET['del'];
				$query = "DELETE FROM registration WHERE id=$del";
				mysqli_query($link, $query) or die(mysqli_error($link));
			}
			$query = "SELECT * FROM registration";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			
			// Вывод на экран:
			$result = '';					
			
				foreach ($data as $elem) {
					$result .= '<tr>';
					
					$result .= '<td>' . $elem['id'] . '</td>';
					$result .= '<td>' . $elem['login'] . '</td>';
					$result .= '<td>' . $elem['email'] . '</td>';
					if($elem['banned']=='1'){
						$result .= '<td align= "center">забанен</td>';	
					} else $result .= '<td align= "center">разбанен</td>';
					if($elem['banned']=='1'){
						$result .= '<td align= "center"><a href="?bann=' . $elem['id'] . '">разбанить</a></td>';
					} else $result .= '<td align= "center"><a href="?bann1=' . $elem['id'] . '">забанить</a></td>';
					
					$result .= '<td align= "center"><a href="?del=' . $elem['id'] . '">удалить</a></td>';
					$result .= '</tr>';
				}
			
			echo $result;				
		?>		
		</table>		
		<?php } ?>			
</body>