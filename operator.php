<?php
include "header.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h4>Operator</h4>
	</div>
<?php
if($page=='form'){
?>
	<div class="col 7">
		<a href="operator.php" class="btn btn-primary">Kembali</a>
	</div>
</div>
	<p></p>
	<?php
	if(isset($_POST['simpan'])){
		$nama = $_POST['nama'];
		$user = $_POST['user'];
		$pass = md5($_POST['pass']);
		$stmt2 = $db->prepare("insert into smart_admin values('',?,?,?)");
		$stmt2->bindParam(1,$nama);
		$stmt2->bindParam(2,$user);
		$stmt2->bindParam(3,$pass);
		if($stmt2->execute()){
			?>
				<script type="text/javascript">location.href='operator.php'</script>
			<?php
		} else{
			?>
				<script type="text/javascript">alert('Gagal menyimpan data')</script>
			<?php
		}
	}
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$user = $_POST['user'];
		$pass = md5($_POST['pass']);
		$stmt2 = $db->prepare("update smart_admin set nama_admin=?, username=?, password=? where id_admin=?");
		$stmt2->bindParam(1,$nama);
		$stmt2->bindParam(2,$user);
		$stmt2->bindParam(3,$pass);
		$stmt2->bindParam(4,$id);
		if($stmt2->execute()){
			?>
				<script type="text/javascript">location.href='operator.php'</script>
			<?php
		} else{
			?>
				<script type="text/javascript">alert('Gagal mengubah data')</script>
			<?php
		}
	}
	?>
	<div class="card shadow mb-4">
	<form method="post">
	<div class="card-body">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id'])? $_GET['id'] : ''; ?>">
		<div class="form-group">
		<label>Nama Lengkap :</label>
		<div class="input-control text full-size">
		    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?php echo isset($_GET['nama'])? $_GET['nama'] : ''; ?>">
		</div>
		<label>Username :</label>
		<div class="input-control text full-size">
		    <input type="text" class="form-control" name="user" placeholder="Nama Pengguna" value="<?php echo isset($_GET['username'])? $_GET['username'] : ''; ?>">
		</div>
		<label>Password :</label>
		<div class="input-control text full-size">
		    <input type="password" class="form-control" name="pass" placeholder="Kata Sandi">
		</div>
		</div>
		<?php
		if (isset($_GET['id'])) {
			?>
			<button type="submit" name="update" class="button warning">Update</button>
			<?php
		} else{
			?>
			<button type="submit" name="simpan" class="btn btn-danger">Simpan</button>
			<?php
		}
		?>
	</form>
	</div>
<?php
} else if($page=='hapus'){
?>
	<div class="cell colspan2 align-right">
	</div>
</div>
<?php
	if(isset($_GET['id'])){
		$stmt = $db->prepare("delete from smart_admin where id_admin='".$_GET['id']."'");
	 	if($stmt->execute()){
	 		?>
	 		<script type="text/javascript">location.href='operator.php'</script>
	 		<?php
	 	}
	}
} else{
?>
<div class="col colspan2">
	<a href="?page=form" class="btn btn-primary">Tambah</a>
</div>

<br></br>

<!-- Begin Page Content -->
<div class="container-fluid">


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary"></h6>
  </div>
  <div class="card-body">
	<div class="table-responsive">
	  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
		  <tr>
			<th width="50">ID</th>
			<th>Nama</th>
			<th>Username</th>
			<th width="240">Aksi</th>
		  </tr>
		</thead>
		
		<tbody>
		  <?php
		  $stmt = $db->prepare("select * from smart_admin");
		  $stmt->execute();
		  while($row = $stmt->fetch()){
		  ?>
		  <tr>
			<td><?php echo $row['id_admin'] ?></td>
			<td><?php echo $row['nama_admin'] ?></td>
			<td><?php echo $row['username'] ?></td>
			<td class="align-center">
			  <a href="?page=form&id=<?php echo $row['id_admin'] ?>&nama=<?php echo $row['nama_admin'] ?>&username=<?php echo $row['username'] ?>" class="btn btn-success"><span class="mif-pencil icon"></span> Edit</a>
			  <a href="?page=hapus&id=<?php echo $row['id_admin'] ?>" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
			</td>
		  </tr>
		  <?php
		  }
		  ?>
		</tbody>
	  </table>
	</div>
</div>
</div>

</div>
<!-- /.container-fluid -->
<p>
	<br/>
</p>
<?php
}
include "footer.php";
?>