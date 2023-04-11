<?php
include "header.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h4>Sub Kriteria</h4>
</div>

<?php
if($page=='form')
{
?>
	<div class="col-md-12 text-xl-right">
		<a href="subkriteria.php" class="btn btn-primary">Kembali</a>
	</div>
</div>
	<p></p>
	<?php
	if(isset($_POST['simpan'])){
		$nama = $_POST['nama'];
		$nilai = $_POST['nilai'];
		$kriteria = $_POST['kriteria'];
		$stmt2 = $db->prepare("insert into smart_sub_kriteria values('',?,?,?)");
		$stmt2->bindParam(1,$nama);
		$stmt2->bindParam(2,$nilai);
		$stmt2->bindParam(3,$kriteria);
		if($stmt2->execute()){
			?>
				<script type="text/javascript">location.href='subkriteria.php'</script>
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
		$nilai = $_POST['nilai'];
		$kriteria = $_POST['kriteria'];
		$stmt2 = $db->prepare("update smart_sub_kriteria set nama_sub_kriteria=?, nilai_sub_kriteria=?, id_kriteria=? where id_sub_kriteria=?");
		$stmt2->bindParam(1,$nama);
		$stmt2->bindParam(2,$nilai);
		$stmt2->bindParam(3,$kriteria);
		$stmt2->bindParam(4,$id);
		if($stmt2->execute()){
			?>
				<script type="text/javascript">location.href='subkriteria.php'</script>
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
		<label>Sub Kriteria :</label>
		<div class="input-control text full-size">
		<input type="text" class="form-control" name="nama" placeholder="Nama Sub Kriteria" value="<?php echo isset($_GET['nama'])? $_GET['nama'] : ''; ?>">
		</div>
		<label>Nilai :</label>
		<div class="input-control text full-size">
		<input type="text" class="form-control" name="nilai" placeholder="Nilai Sub Kriteria" value="<?php echo isset($_GET['nilai'])? $_GET['nilai'] : ''; ?>">
		</div>
		<label>Kriteria :</label>
		<div class="input-control select full-size" >
		<select class="form-control" name="kriteria">
		<option value="<?php echo isset($_GET['kriteria'])? $_GET['kriteria'] : ''; ?>"><?php echo isset($_GET['kriteria'])? $_GET['kriteria'] : ''; ?></option>
				<?php
					$stmt3 = $db->prepare("select * from smart_kriteria");
					$stmt3->execute();
					while($row3 = $stmt3->fetch()){
				?>
		<option value="<?php echo $row3['id_kriteria'] ?>"><?php echo $row3['nama_kriteria'] ?></option>
		<?php
		}
		?>
		</select>
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
	<!-- </div> -->
	
	</form>

<?php
} else if($page=='hapus'){
?>
	<div class="cell colspan2 align-right">
	</div>
</div>
<?php
	if(isset($_GET['id'])){
		$stmt = $db->prepare("delete from smart_sub_kriteria where id_sub_kriteria='".$_GET['id']."'");
	if($stmt->execute()){
	?>
	<script type="text/javascript">location.href='subkriteria.php'</script>
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
				<tr>
				<th width="50">No</th>
				<th>Kriteria</th>
				<th>Sub Kriteria</th>
				<th>Nilai</th>
				<th>Aksi</th>
				</tr>
			</tr>
			</thead>
			
			<tbody>
			<?php
			$stmt = $db->prepare("select * from smart_kriteria");
			$stmt->execute();
				$no =1;
			while($row = $stmt->fetch()){
			?>
			<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['nama_kriteria'] ?></td>
					<td>
					<?php
					//$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
					$stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='".$row['id_kriteria']."'");
					$stmt2->execute();
					while($row2 = $stmt2->fetch()){
					?>
					<?php echo $row2['nama_sub_kriteria'] ?><br/>
					<?php
					}
					?>
					</td>
					<td>
					<?php
					//$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
					$stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='".$row['id_kriteria']."'");
					$stmt2->execute();
					while($row2 = $stmt2->fetch()){
					?>
					<?php echo $row2['nilai_sub_kriteria'] ?><br/>
					<?php
					}
					?>
					</td>
					<td>
					<?php
					//$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
					$stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='".$row['id_kriteria']."'");
					$stmt2->execute();
					while($row2 = $stmt2->fetch()){
					?>
					<a href="?page=form&id=<?php echo $row2['id_sub_kriteria'] ?>&nama=<?php echo $row2['nama_sub_kriteria'] ?>&nilai=<?php echo $row2['nilai_sub_kriteria'] ?>&kriteria=<?php echo $row2['id_kriteria'] ?>" style="color:green;">Edit<span><a>
					<a href="?page=hapus&id=<?php echo $row2['id_sub_kriteria'] ?>"style="color:red;">Hapus</a><br/>
					<?php
					}
					?>
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
