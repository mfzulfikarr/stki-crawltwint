<?php
	include 'koneksidb.php';
	$searchErr='';
	$namajalan='';
	if(!empty($_POST['submit'])) {
		$search = $_POST['search'];
		$select = $connect->prepare("SELECT * from datasettweetfinal where `Dari` like '%$search%'");
		$select->execute();
		$namajalan = $select->fetchAll(PDO::FETCH_ASSOC);
	}
?>

<html>
	<head>
		<title>IR Persimpangan D.I.Y</title>
		<style>
			*{
				font-family: Verdana, sans-serif, Arial, "Helvetica Neue", Helvetica;
			}
			.judul{
				font-size: large;
				font-family: Montserrat, Verdana, sans-serif, Arial, "Helvetica Neue", Helvetica;
				text-align: center;
			}

			.bar{
				font-size: smaller;
			}

			section{
				background: rgb(61, 64, 112);
			}

			#wide{
				width: 130px;
			}

			th{
				background: rgb(61, 64, 112);
				color: white;
				padding-inline: 10px;
			}

			th:first-child{
				border-radius: 10px 0px 0px 0px;
			}

			th:last-child{
				border-radius: 0px 10px 0px 0px;
			}

			tr, td{
				background: rgba(230, 230, 250, 50%);
    			opacity: 0.8;
    			padding: 5px;
    			text-align: center;
			}

			a{
				text-decoration: none;
				color: #000;
			}

			td:hover{
				background: rgba(230, 230, 250, 100%);
    			opacity: 100%;
			}
		</style>
	</head>
	<body>
		<h1 class="judul">Informasi Kondisi Lalu Lintas Jalan D.I. Yogyakarta<br>
						via tweet ATCS D.I.Y</h1>

		<section><p class="bar">" "</p></section>
		<p>Hi! Saya akan mengambil informasi lalu lintas dari tweet @ATCS_DISHUB_DIY. Coba tulis nama jalannya disini ya!</p>
		
		<center>
		<form action="" method="POST">
			<label for="datasettweetfinal">Masukkan Nama Persimpangan</label>
			<input type="text" name="search" required>
			<input type="submit" name="submit" value="cari">
		</form>
		</center>
		<table class="tablehasil">
			<tr>
				<th>No</th>
				<th id="wide">Tanggal</th>
				<th id="wide">Waktu</th>
				<th id="wide">Dari</th>
				<th id="wide">Arah</th>
				<th id="wide">Kondisi</th>
				<th>Hambatan</th>
				<th>Tweet (Klik untuk melihat Tweet)</th>
			</tr>
			<?php
                if($namajalan == "") {
                    echo '<tr>Informasi jalan akan muncul dalam tabel di bawah ini</tr><br><br>';
                }
                elseif(!$namajalan) {
                    echo '<tr>Hmm... Sepertinya saya belum bisa menemukan tweet untuk jalan itu. Bagaimana dengan jalan lainnya?</tr><br><br>';
                }
                else {
					echo '<p>Yay! Saya menemukan beberapa tweet!</p>';
                	foreach($namajalan as $key=>$value) {
                        ?>
                    <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $value['Date'];?></td>
                        <td><?php echo $value['Waktu'];?></td>
						<td><?php echo $value['Dari'];?></td>
						<td><?php echo $value['Arah'];?></td>
						<td><?php echo $value['Kondisi'];?></td>
						<td><?php echo $value['Hambatan'];?></td>
						<td><?php echo "<a href = '$value[link]' target=_blank>$value[Tweet]</a>"?></td>
                    </tr>
                    <?php
                    }    
                }
            ?>
		</table>
	</body>
</html>