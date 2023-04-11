<?php
include "header.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>

<div class="row cells4">
	<div class="cell colspan2">
	<?php
			if(isset($_POST['periode']) && isset($_POST['tampil'])) {
		?>
				<h4>Eksekusi Perangkingan - Periode <?=$_POST['periode']?></h4>
		<?php
			}
			else {
		?>
				<h4>Eksekusi Perangkingan</h4>
		<?php
			}
		?>
</div>

	<div class="col-md-1">
		<a href="perangkingan.php" class="btn btn-primary">Kembali</a>
	</div>
</div>
<br/>

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
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">	<thead>
		<tr>
			<th width="50">No</th>
			<th>Nama</th>
            <?php
            $stmt2x = $db->prepare("select * from smart_kriteria");
            $stmt2x->execute();
            while($row2x = $stmt2x->fetch()){
            ?>
			<th><?php echo $row2x['nama_kriteria'] ?></th>
            <?php
            }
            ?>
			<th>Hasil</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>-</td>
			<td>Bobot</td>
            <?php
            $stmt2x1 = $db->prepare("select * from smart_kriteria");
            $stmt2x1->execute();
            while($row2x1 = $stmt2x1->fetch()){
            ?>
			<td><?php echo $row2x1['bobot_kriteria'] ?></td>
            <?php
            }
            ?>
            <td>-</td>
            <td>-</td>
		</tr>
		<?php
		$stmtx = $db->prepare("select * from smart_alternatif_kriteria a JOIN  smart_alternatif b on b.id_alternatif=a.id_alternatif where a.periode = '$periode' group by a.id_alternatif  ");
		$noxx = 1;
		$stmtx->execute();
		while($rowx = $stmtx->fetch()){
		?>
		<tr>
			<td><?php echo $noxx++ ?></td>
			<td><?php echo $rowx['nama_alternatif'] ?></td>
            <?php
            $stmt3x = $db->prepare("select * from smart_kriteria");
            $stmt3x->execute();
            while($row3x = $stmt3x->fetch()){
            ?>
			<td>
                <?php
                $stmt4x = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='".$row3x['id_kriteria']."' and id_alternatif='".$rowx['id_alternatif']."'");
                $stmt4x->execute();
                while($row4x = $stmt4x->fetch()){
                	$ida = $row4x['id_alternatif'];
                	$idk = $row4x['id_kriteria'];
                    echo $kal = $row4x['nilai_alternatif_kriteria']*$row3x['bobot_kriteria'];
                    $stmt2x3 = $db->prepare("update smart_alternatif_kriteria set bobot_alternatif_kriteria=? where id_alternatif=? and id_kriteria=?");
					$stmt2x3->bindParam(1,$kal);
					$stmt2x3->bindParam(2,$ida);
					$stmt2x3->bindParam(3,$idk);
					$stmt2x3->execute();
                }
                ?>
            </td>
            <?php
            }
            ?>
            <td>
			<?php
            	$stmt3x2 = $db->prepare("select sum(bobot_alternatif_kriteria) as bak from smart_alternatif_kriteria where id_alternatif='".$rowx['id_alternatif']."'");
	            $stmt3x2->execute();
	            $row3x2 = $stmt3x2->fetch();
	            $ideas = $rowx['id_alternatif'];
				echo $hsl = $row3x2['bak'];
				if($hsl>=75){
	            	$ket = "MENERIMA BANTUAN";
	            }
	            else if($hsl<=75){
	            	$ket = "TIDAK MENERIMA BANTUAN";
	            } else{
	            	$ket = "Data yang dimasukan salah";
	            }
	            $stmt2x3y = $db->prepare("update smart_alternatif set hasil_alternatif=?, ket_alternatif=? where id_alternatif=?");
				$stmt2x3y->bindParam(1,$hsl);
				$stmt2x3y->bindParam(2,$ket);
				$stmt2x3y->bindParam(3,$ideas);
				$stmt2x3y->execute();
            	?>
            </td>
            <td>
			<?php
				if($hsl>=75){
					$ket2 = "MENERIMA BANTUAN";
				}
            	else if($hsl<=75){
	            	$ket2 = "TIDAK MENERIMA BANTUAN";
	            } else{
	            	$ket2 = "Data yang dimasukan salah";
	            }
	            echo $ket2;
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
<p><br/></p>

<?php } ?>

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

  <div >
<?php
include "footer.php";
?>			