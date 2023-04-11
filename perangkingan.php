<?php
include "header.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>

<div class="row cells4">
	<div class="cell colspan2">
		<?php
			if(isset($_POST['periode']) && isset($_POST['tampil'])) {
		?>
				<h4>Perangkingan - Periode <?=$_POST['periode']?></h4>
		<?php
			}
			else {
		?>
				<h4>Perangkingan</h4>
		<?php
			}
		?>
</div>

<?php

if(isset($_POST['tampil'])){
$periode = $_POST['periode'];

	?>


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
		<th width="50">No</th>
		<th>Alternatif</th>
			  <?php
			  $stmt2 = $db->prepare("select * from smart_kriteria");
			  $stmt2->execute();
			  while($row2 = $stmt2->fetch()){
			  ?>
		<th><?php echo $row2['nama_kriteria'] ?></th>
			  <?php
			  }
			  ?>
		<th width="140">Aksi</th>
	  </tr>
	</thead>
	
	<tbody>
	  <?php
$stmt = $db->prepare("select * from smart_alternatif_kriteria a JOIN  smart_alternatif b on b.id_alternatif=a.id_alternatif where a.periode = '$periode' group by a.id_alternatif  ");
$nox = 1;
$stmt->execute();
while($row = $stmt->fetch()){
?>
<tr>
<td><?php echo $nox++ ?></td>
<td><?php echo $row['nama_alternatif'] ?></td>
<?php
$stmt3 = $db->prepare("select * from smart_kriteria");
$stmt3->execute();
while($row3 = $stmt3->fetch()){
?>
<td>
  <?php
  $stmt4 = $db->prepare("select * from smart_alternatif_kriteria where periode='$periode' and id_kriteria='".$row3['id_kriteria']."' and id_alternatif='".$row['id_alternatif']."'");
  $stmt4->execute();
  while($row4 = $stmt4->fetch()){
	  echo $row4['nilai_alternatif_kriteria'];
	  ?>
	  <!--<a href="?page=form&alt=<?php echo $row['id_alternatif'] ?>&kri=<?php echo $row3['id_kriteria'] ?>&nilai=<?php echo $row4['nilai_alternatif_kriteria'] ?>" style="color:orange"><span class="mif-pencil icon"></span></a>-->
	  <?php
  }
  ?>
</td>
<?php
}
?>
<td class="align-center">
  <a href="?page=hapus&alt=<?php echo $row['id_alternatif'] ?>" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
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
<p><br/></p>

	<?php
}



if($page=='form'){
?>
	<div class="col colspan2">
		<a href="perangkingan.php" class="btn btn-primary">Kembali</a>
	</div>
</div>
	<p></p>
	<?php
	
	if(isset($_POST['simpan'])){
		$periode = $_POST['periode'];
		$alt = $_POST['alt'];
		$stmtx4 = $db->prepare("select * from smart_kriteria");
		$stmtx4->execute();
		while($rowx4 = $stmtx4->fetch()){
			if ($rowx4['id_kriteria']==true) {
				$idkri = $rowx4['id_kriteria'];
				$kri = $_POST['kri'][$idkri];
				$altkri = $_POST['altkri'][$idkri];
				$stmt2 = $db->prepare("insert into smart_alternatif_kriteria(id_alternatif,id_kriteria,nilai_alternatif_kriteria,periode) values(?,?,?,?)");
				$stmt2->bindParam(1,$alt);
				$stmt2->bindParam(2,$kri);
				$stmt2->bindParam(3,$altkri);
				$stmt2->bindParam(4,$periode);
				$stmt2->execute();
			}
		}
	}
	if(isset($_POST['update'])){
		$alt = $_POST['alt'];
		$stmtx4 = $db->prepare("select * from smart_kriteria");
		$stmtx4->execute();
		while($rowx4 = $stmtx4->fetch()){
			if ($rowx4['id_kriteria']==true) {
				$idkri = $rowx4['id_kriteria'];
				$kri = $_POST['kri'][$idkri];
				$altkri = $_POST['altkri'][$idkri];
				$stmt2 = $db->prepare("update smart_alternatif_kriteria set nilai_alternatif_kriteria=? where id_alternatif=? and id_kriteria=?");
				$stmt2->bindParam(1,$altkri);
				$stmt2->bindParam(2,$alt);
				$stmt2->bindParam(3,$kri);
				$stmt2->execute();
			}
		}
	}
	?>
	<div class="card shadow mb-4">
	<form method="post">
	<div class="card-body">
		<label>Alternatif</label>
		<div class="input-control select full-size">
		    <select class="form-control" name="alt">
		    	<option value="<?php echo isset($_GET['alt'])? $_GET['alt'] : ''; ?>"><?php echo isset($_GET['alt'])? $_GET['alt'] : ''; ?></option>
		    	<?php
				$stmt3 = $db->prepare("select * from smart_alternatif");
				$stmt3->execute();
				while($row3 = $stmt3->fetch()){
				?>
		    	<option value="<?php echo $row3['id_alternatif'] ?>"><?php echo $row3['nama_alternatif'] ?></option>
		    	<?php
		    	}
		    	?>
		    </select>
		</div><br/><br/><b>

		<div class="row col3">
			<div class="col">ID Kriteria</div>
			<div class="col colspan2">Nilai/Sub Kriteria</div>
		</div></b><br/>
		<?php
			$stmt4 = $db->prepare("select * from smart_kriteria");
			$stmt4->execute();
			$no=1;
			while($row4 = $stmt4->fetch()){
		?>
		<div class="row col3">
			<div class="col"><input type="hidden" name="kri[<?php echo $row4['id_kriteria'] ?>]" value="<?php echo $row4['id_kriteria'] ?>"><?php echo $no++ ?>.
				<?php echo $row4['nama_kriteria'] ?></div>
			<div class="col colspan2">
				<div class="input-control select full-size">
				    <select class="form-control" name="altkri[<?php echo $row4['id_kriteria'] ?>]">
				    	<?php
						$stmt5 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='".$row4['id_kriteria']."'");
						$stmt5->execute();
						while($row5 = $stmt5->fetch()){
						?>
				    	<option value="<?php echo $row5['nilai_sub_kriteria'] ?>"><?php echo $row5['nama_sub_kriteria'] ?></option>
				    	<?php
				    	}
				    	?>
				    </select>
				</div>
			</div>
		</div>
		<br>
		
		<?php
		    }
		?>
<div class="row col3">
			<div class="col">Pilih Periode :</div>
			<div class="col colspan2">
			<input class="form-control" type="text" name="periode" id="periode">
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
	</>
</div>
<?php
	if(isset($_GET['alt'])){
		$stmt = $db->prepare("delete from smart_alternatif_kriteria where id_alternatif='".$_GET['alt']."'");
	 	if($stmt->execute()){
	 		?>
	 		<script type="text/javascript">location.href='perangkingan.php'</script>
	 		<?php
	 	}
	}
} else{
?>
<div class="col colspan2">
	<a href="execute-rangking.php" class="btn btn-warning">Eksekusi Perangkingan</a>
	<a href="?page=form" class="btn btn-primary">Tambah</a>

	<br><br>
	<form method="post">
		<div class="form-group">
			<label>Pilih Periode :</label>
			<select class="form-control" name="periode">
				<?php
				$stmt5 = $db->prepare("select distinct periode from smart_alternatif_kriteria order by periode asc");
				$stmt5->execute();
				while($row5 = $stmt5->fetch()){
				?>
					<option value="<?php echo $row5['periode'] ?>"><?php echo $row5['periode'] ?></option>
				<?php
				}
				?>
			</select><br>
			<button type="submit" name="tampil" class="btn btn-danger">Tampil</button>
		</div>
  </form>
</div>

<div class="card shadow">
	
</div>




<?php
}
include "footer.php";
?>