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
		$harga = $_REQUEST['harga'];
		$stok = $_REQUEST['stok'];
		$gambar = $_REQUEST['gambar'];

		$sql = mysqli_query($koneksi, "INSERT INTO product(product, harga, stok, gambar) VALUES('$product', '$harga', '$stok', '$gambar')");

		if($sql == true){
			header('Location: ./admin.php?hlm=product');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Data Product Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="product" class="col-sm-2 control-label">Product</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="product" name="product" placeholder="Product Ikan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="harga" name="harga" placeholder="harga" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Stok</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Product" required>
		</div>
	</div>
	<div class="form-group">
		<label for="gambar" class="col-sm-2 control-label">Gambar</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" id="gambar" name="gambar" placeholder="pilih File" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button href="./admin.php?hlm=product" type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=product" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
