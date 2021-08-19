<?php

  if(!empty($_POST["product"])){

    /* RE-ESTABLISH YOUR CONNECTION */
    $con = new mysqli("localhost", "root", "", "nelayanindonesia");

    /* CHECK CONNECTION */
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    /* PREPARE YOUR QUERY */
    $stmt = $con->prepare("SELECT  FROM product WHERE id_product = ?");
    $stmt->bind_param("i", $_POST["id_product"]); /* PARAMETIZE THIS VARIABLE TO YOUR QUERY */
    $stmt->execute(); /* EXECUTE QUERY */
    $stmt->bind_result($harga); /* BIND THE RESULTS TO THESE VARIABLES */
    $stmt->fetch(); /* FETCH THE RESULTS */
    $stmt->close(); /* CLOSE THE PREPARED STATEMENT */

    /* RETURN THIS DATA TO THE MAIN FILE */
    echo json_encode(array("harga" => $harga));

  } /* END OF IF NOT EMPTY loadnumber */

?>
