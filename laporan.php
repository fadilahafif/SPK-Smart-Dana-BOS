<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
	?>
	<script>window.location.assign("login.php")</script>
	<?php
}


if(isset($_POST['tampil'])){
	$periode = $_POST['periode'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
	<title>LAPORAN HASIL PERANGKINGAN</title>
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
</head>
<body>

	<div class="container">
	<h4 style="text-align:center;"><img class="" style="width: 3.5rem;" src="images/logosd.png">LAPORAN HASIL PERIODE <?=$_POST['periode']?> PERANGKINGAN SISTEM PENDUKUNG KEPUTUSAN SELEKSI PENERIMAAN DANA BOS SDN KARANG TENGAH 7 MENGGUNAKAN METODE SMART (Simple Multi Attribute Rating Tehnique)</h4>
	<p><strong>Nilai Dasar</strong></p>
	<table class="table striped hovered cell-hovered border bordered">
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
		</tr>
	</thead>
	<tbody>
		<?php
		$stmt = $db->prepare("select * from smart_alternatif_kriteria a JOIN  smart_alternatif b on b.id_alternatif=a.id_alternatif where a.periode = '$periode' group by a.id_alternatif order by b.nama_alternatif asc");
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
                $stmt4 = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='".$row3['id_kriteria']."' and id_alternatif='".$row['id_alternatif']."'");
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
		</tr>
		<?php
		}
		?>
	</tbody>
	</table>
	<br/>
	<p><strong>Nilai Perangkingan</strong></p>
	
	<table class="table striped hovered cell-hovered border bordered">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Alternatif</th>
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
		$stmtx = $db->prepare("select * from smart_alternatif_kriteria a JOIN  smart_alternatif b on b.id_alternatif=a.id_alternatif where a.periode = '$periode' group by a.id_alternatif order by b.nama_alternatif asc");
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
	            } else if($hsl<=75){
	            	$ket = "TIDAK MENERIMA BANTUAN";
	            } else{
	            	$ket = "Data yang dimasukan salah";
	            }
            	?>
            </td>
            <td>
            	<?php
            	if($hsl>=75){
	            	$ket2 = "MENERIMA BANTUAN";
	            } else if($hsl<=75){
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
	<p><br/></p>
	</div>
  
</body>
</html>


<?php
}
?>
