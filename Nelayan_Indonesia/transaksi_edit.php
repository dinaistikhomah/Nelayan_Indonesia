<?php
if( empty( $_SESSION['id_user'] ) ){
    $nama = $_SESSION['nama'];
	$alamat = $_SESSION['alamat'];

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){
		
		$product = $_REQUEST['product'];
		$nama = $_REQUEST['nama'];
		$harga = $_REQUEST['harga'];
		$Qty = $_REQUEST['Qty'];
		$total = $_REQUEST['total'];
		$id_user = $_SESSION['id_user'];

		$sql = mysqli_query($koneksi, "UPDATE transaksi SET product='$product', nama='$nama', harga='$harga', Qty='$Qty', total='$total', tanggal=NOW(), id_user='$id_user' WHERE id_transaksi");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_transaksi = $_REQUEST['id_transaksi'];

		$sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
		while($row = mysqli_fetch_array($sql)){

?>

<h2>Edit Data Transaksi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_transaksi" class="col-sm-2 control-label">No. Transaksi</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="no_transaksi" value="<?php echo $row['no_transaksi']; ?>"name="no_transaksi" placeholder="No. Transaksi" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="product" class="col-sm-2 control-label">Product</label>
		<input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
		<div class="col-sm-3">
			<select name="product" class="form-control" required>
				<option value="<?php echo $row['product']; ?>"><?php echo $row['product']; ?></option>

			<?php

				$q = mysqli_query($koneksi, "SELECT product FROM product");
				while(list($product) = mysqli_fetch_array($q)){
					echo '<option value="'.$harga.'">'.$product.'</option>';
				}

			?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="Qty" class="col-sm-2 control-label">Qty</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="Qty" name="Qty" value="<?php echo $row['Qty']; ?>" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Total Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" placeholder="Total Bayar" required>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Pelanggan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama Pelanggan" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
	}
}
?>
