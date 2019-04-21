<!DOCTYPE html>
<html>
<head>
	<title>Sistem Perpustakaan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/wow/css/libs/animate.css">
</head>
<body bgcolor="#1A1A1A" >
	<div align="center" class="title wow fadeInUp">
		<img src="img/book.png" class="icon">

		<h1 class="titletext">Perpustakaan</h1>
		<h2 class="subtitletext">Sekolah</h2>

		<hr class="hrtitle" size="1" width="1000px">
	</div>
	<div align="center" class="content wow fadeIn">

	<h3>Masuk sebagai</h3>
		
	<a href="pages/login.php"><button class="btnpustakawan fadeInUp" onmouseover="document.getElementById('tpustakawan').style.display = 'block';" onmouseout="document.getElementById('tpustakawan').style.display = 'none';">P</button></a>
	<a href="pages/siswa.php">
		<button class="btnsiswa fadeInUp" onmouseover="document.getElementById('tsiswa').style.display = 'block';" onmouseout="document.getElementById('tsiswa').style.display = 'none';">S</button>
	</a>

	<br>

	<div id="tpustakawan">PUSTAKAWAN</div>
	<div id="tsiswa">SISWA</div>
			
	</div>

	<script src="css/wow/dist/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>

</body>



</html>