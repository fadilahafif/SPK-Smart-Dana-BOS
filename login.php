<?php
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>SPK Metode SMART</title>
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
	<script src="js/metro.js"></script>
	
	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  	<!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

	
    
    <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
</head>
<body onload="runPB1()">
    <div class="app-bar">
		<a class="app-bar-element" href="login.php">SPK SDN Karang Tengah 7 </a>
	</div>
	
	<h2 style="text-align:center;margin:100px auto 0 auto;">Silakan Masuk</h2>
	<div style="margin:15px auto;width:320px;background:#FFF5EE;border:1px solid #ddd;padding:20px;">
	<div class="text-center">
          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 50rem;" src="images/logosd.png" alt="">
    </div>
	<h5 style="text-align:center;margin:0px auto 0 auto;">Sekolah Dasar Negeri <br> Karang Tengah 7</h5>
		<?php
		if(isset($_POST['username']) && isset($_POST['password'])){
			$user = $_POST['username'];
			$pass = md5($_POST['password']);
			$stmt = $db->prepare("SELECT * from smart_admin where username='$user' and password='$pass' limit 0,1");
			$stmt->execute();
			$row = $stmt->fetch();
				if($row['username']==$user && $row['password']=$pass){
					session_start();
					$_SESSION['id'] = $row['id_admin'];
					$_SESSION['nama'] = $row['nama_admin'];
					$_SESSION['username'] = $row['username'];
					?>
					<div class="progress ani large" id="pb1" data-animate="500" data-color="ribbed-amber" data-role="progress"></div>
					<script>
						var interval1;
						function runPB1(){
							clearInterval(interval1);
							var pb = $("#pb1").data('progress');
							var val = 0;
							interval1 = setInterval(function(){
								val += 10;
								pb.set(val);
								if (val >= 100) {
									location.href='index.php';
									val = 0;
									clearInterval(interval1);
								}
							}, 100);
						}
					</script>
					<?php
				} else{
					?>
					<script>
						$.Notify({
							caption: 'Maaf',
							content: 'Anda mungkin salah memasukkan username dan password, silahkan coba lagi!',
							type: 'alert'
						});
					</script>
					<?php
				}
		}
		?>
		<form method="post">
			<p></p>
			<!-- input[type=text] -->
			<div class="input-control text full-size">
				<label>Username</label>
				<input type="text" class="form-control" name="username" required>
			</div>
			<p></p>
			<!-- input[type=password] -->
			<div class="input-control password full-size">
				<label>Password</label>
				<input type="password" class="form-control" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary" style="text-align:center;">Masuk</button>
		</form>
	</div>
	
</body>
</html>