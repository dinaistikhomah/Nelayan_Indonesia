<?php
if( empty( $_SESSION['id_user'] ) ){
    $nama = $_SESSION['nama'];
    $alamat = $_SESSION['alamat'];

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_product = $_REQUEST['id_product'];

    $sql = mysqli_query($koneksi, "DELETE FROM product WHERE id_product='$id_product'");
    if($sql == true){
        header("Location: ./admin.php?hlm=product");
        die();
    }
    }
}
?>
