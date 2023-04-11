<?php
include "header.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>

<div class="row cells4">
	<div class="cell colspan2">
		<h4>Kriteria</h4>
</div>

<?php
if($page=='form')
{
?>
	<div class="col-md-12 text-xl-right">
		<a href="kriteria.php" class="btn btn-primary">Kembali</a>
	</div>
</div>
	<p></p>
	<?php
	if(isset($_POST['simpan'])){
		$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
		$stmt->execute();
		$row = $stmt->fetch();
		if($_POST['bobot']<=100){
			$bbt = $_POST['bobot']/100;
			$bbtk = $bbt+$row['bbtk'];
			if($bbtk<=1){
				$nama = $_POST['nama'];
				$bobot = $_POST['bobot']/100;
				$stmt2 = $db->prepare("insert into smart_kriteria values('',?,?)");
				$stmt2->bindParam(1,$nama);
				$stmt2->bindParam(2,$bobot);
				if($stmt2->execute()){
					?>
					<script type="text/javascript">location.href='kriteria.php'</script>
					<?php
				} else{
					?>
					<script type="text/javascript">alert('Gagal menyimpan data')</script>
					<?php
				}
			} else{
				?>
				<script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
				<?php
			}
		} else{
			?>
				<script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
			<?php
		}
	}
	if(isset($_POST['update'])){
		$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
		$stmt->execute();
		$row = $stmt->fetch();
		if($_POST['bobot']<=100){
			$bbt = $_GET['bobot'];
			$bbt2 = $_POST['bobot']/100;
			$bbtk = $row['bbtk']-$bbt;
			$bbtk2 = $bbtk+$bbt2;
			if($bbtk2<=1){
				$id = $_POST['id'];
				$nama = $_POST['nama'];
				$bobot = $_POST['bobot']/100;
				$stmt2 = $db->prepare("update smart_kriteria set nama_kriteria=?, bobot_kriteria=? where id_kriteria=?");
				$stmt2->bindParam(1,$nama);
				$stmt2->bindParam(2,$bobot);
				$stmt2->bindParam(3,$id);
				if($stmt2->execute()){
					?>
					<script type="text/javascript">location.href='kriteria.php'</script>
					<?php
				} else{
					?>
					<script type="text/javascript">alert('Gagal mengubah data')</script>
					<?php
				}
			} else{
				?>
				<script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
				<?php
			}
		} else{
			?>
				<script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
			<?php
		}
	}
	?>
	<div class="card shadow mb-4">
	<form method="post">
	<div class="card-body">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id'])? $_GET['id'] : ''; ?>">
		<div class="form-group">
			<label>Kriteria :</label>
			<div class="input-control text full-size">
			<input type="text" class="form-control" name="nama" placeholder="Nama Kriteria" value="<?php echo isset($_GET['nama'])? $_GET['nama'] : ''; ?>">
			</div>
			<label>Bobot :</label>
			<div class="input-control text full-size">
			<input type="text" class="form-control" name="bobot" placeholder="Bobot %" value="<?php echo isset($_GET['bobot'])? $_GET['bobot']*100 : ''; ?>">
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
	</div>
	</form>
<?php
} else if($page=='hapus'){
?>
	<div class="cell colspan2 align-right">
	</div>
</div>
<?php
	if(isset($_GET['id'])){
		$stmt = $db->prepare("delete from smart_kriteria where id_kriteria='".$_GET['id']."'");
	if($stmt->execute()){
	?>
	<script type="text/javascript">location.href='kriteria.php'</script>
	<?php
		}
	}
} else
{
?>
<div class="col-sm-1 text-sm-1-right">
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
				<th >ID</th>
				<th>Kriteria</th>
				<th >Bobot</th>
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$stmt = $db->prepare("select * from smart_kriteria");
			$stmt->execute();
				$no = 1;
			while($row = $stmt->fetch()){
			?>
			<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['nama_kriteria'] ?></td>
			<td><?php echo $row['bobot_kriteria'] ?></td>
			<td class="align-center">
				<a href="?page=form&id=<?php echo $row['id_kriteria'] ?>&nama=<?php echo $row['nama_kriteria'] ?>&bobot=<?php echo $row['bobot_kriteria'] ?>" class="btn btn-success"><span class="mif-pencil icon"></span> Edit</a>
				<a href="?page=hapus&id=<?php echo $row['id_kriteria'] ?>" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
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
*CATATAN<br>
Nilai dalam kolom bobot adalah hasil NORMALISASI dari nilai pada kriteria dibagi total nilai bobot, sebagai berikut: <br>
30 = 0.3 <br>
10 = 0.1 <br>
5 = 0.05 <br>
15 = 0.15 <br>
40 = 0.4<br>
yang jika ditotal keseluruhan nilai bobot sebelum diNORMALISASI adalah 100.
<!-- /.container-fluid -->
<p>
	<br/>
</p>
	
<?php
}
include "footer.php";
?>