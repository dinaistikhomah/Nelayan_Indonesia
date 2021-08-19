<?php
if( empty( $_SESSION['id_user'] ) ){
    $nama = $_SESSION['nama'];
	$alamat = $_SESSION['alamat'];

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_transaksi = $_REQUEST['no_transaksi'];
		$product = $_REQUEST['product'];
		$harga = $_REQUEST['harga'];
		$nama = $_REQUEST['nama'];
		$Qty = $_REQUEST['Qty'];
		$total = $_REQUEST['total'];
		$id_user = $_SESSION['id_user'];

		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_transaksi, product, harga, nama, Qty, total, tanggal, id_user) VALUES('$no_transaksi', '$product', '$harga', '$nama', '$Qty', '$total', NOW(), '$id_user')");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_transaksi" class="col-sm-2 control-label">No. Transaksi</label>
		<div class="col-sm-3">

		<?php

			$sql = mysqli_query($koneksi, "SELECT no_transaksi FROM transaksi");
				echo '<input type="text" class="form-control" id="no_transaksi" value="';

			$no_transaksi = "A001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_transaksi;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_transaksi) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_trabsaksi++;
					echo $no_transaksi;
				}
			}
				echo '"name="no_transaksi" placeholder="No. Transaksi" readonly>';

		?>

		</div>
	</div>
	<div class="form-group">
		<label for="product" class="col-sm-2 control-label">Product</label>
		<div class="col-sm-3">
			<select name="product" class="form-control" id="product" required>
				<option value="" disable>--- Pilih Product ---</option>
			<?php

				$q = mysqli_query($koneksi, "SELECT * FROM product");
				while($data = mysqli_fetch_array($q)){
					echo '<option value="'.$data['harga'].'">'.$data['product'].'</option>';
				}

			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" name="harga" value="" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="Qty" class="col-sm-2 control-label">Qty</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="Qty" name="Qty" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Total Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="total" name="total" placeholder="Total Bayar" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Pelanggan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button href="./admin.php?hlm=transaksi" type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
<script>

  $(document).ready(function(){

    $("#product").change(function(){
      var harga = $(this).val();
      $("#harga").val(harga);
    });

    $("#Qty").keyup(function(){
        var harga = $("#harga").val();
        var Qty = $("#Qty").val();
        $("#total").val(harga * Qty);
    });

  });
</script>
