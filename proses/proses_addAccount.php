<?php  
	session_start();
	include ("connection.php");

	$user=$_POST['username'];
	$pass=$_POST['password'];
	$nama=$_POST['name'];
	$phone=$_POST['phone'];

	$query="SELECT id_pustakawan FROM tb_pustakawan ORDER BY id_pustakawan DESC LIMIT 1";
    $select_stmt=$db->prepare($query);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    $number=substr($row['id_pustakawan'],2);
    $angka=intval($number);
    $angka++;
    $gabung="P".sprintf('%03d',$angka);

	if ($user == null || $pass == null || $nama == null || $phone == null) {
		header("Refresh:0.1; url=../pages/login.php");
		echo "<script>alert('Lengkapi form terlebih dahulu')</script>";
	}else{
		$query="INSERT INTO tb_pustakawan VALUES (?,?,?,?,?)";
		$stmt=$db->prepare($query);
		$stmt->bindParam(1,$gabung);
		$stmt->bindParam(2,$user);
		$stmt->bindParam(3,$pass);
		$stmt->bindParam(4,$nama);
		$stmt->bindParam(5,$phone);
		$stmt->execute();
	
		header("Refresh:0.1; url=../pages/login.php");
		echo "<script>alert('Berhasil membuat akun !')</script>";
		
	}

	
	
?>