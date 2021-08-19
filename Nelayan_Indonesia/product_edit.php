<?php
if( empty( $_SESSION['id_user'] ) ){
    $nama = $_SESSION['nama'];
	$alamat = $_SESSION['alamat'];

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_product = $_REQUEST['id_product'];
		$product = $_REQUEST['product'];
		$harga = $_REQUEST['harga'];
		$stok = $_REQUEST['stok'];
		$gambar = $_REQUEST['gambar'];

		$sql = mysqli_query($koneksi, "UPDATE product SET product='$product', harga='$harga', stok='$stok', gambar='$gambar' WHERE id_product='$id_product'");

		if($sql == true){
			header('Location: ./admin.php?hlm=product');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_product = $_REQUEST['id_product'];

		$sql = mysqli_query($koneksi, "SELECT * FROM product WHERE id_product='$id_product'");
		while($row = mysqli_fetch_array($sql)){

?>
<h2>Edit Data Product</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="product" class="col-sm-2 control-label">Nama Product</label>
		<div class="col-sm-4">
			<input type="hidden" name="id_product" value="<?php echo $row['id_product']; ?>">
			<input type="text" class="form-control" id="product" value="<?php echo $row['product']; ?>" name="product" placeholder="Nama Product" required>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="harga" value="<?php echo $row['harga']; ?>" name="harga" placeholder="Harga" required>
		</div>
	</div>
	<div class="form-group">
		<label for="stok" class="col-sm-2 control-label">stok</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="stok" value="<?php echo $row['stok']; ?>" name="stok" placeholder="Stok" required>
		</div>
	</div>
	<div class="form-group">
		<label for="gambar" class="col-sm-2 control-label">Gambar</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" id="gambar" value="<?php echo $row['gambar']; ?>" name="gambar" placeholder="Pilih File" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=product" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php

	}
	}
}
?>
