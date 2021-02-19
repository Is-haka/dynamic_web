<?php

include('admin/db_connect.php');
?>
<?php

    $id = $_GET['id'];

    $delCartQuery = "DELETE FROM cart WHERE id = $id";
    $delCartResult = mysqli_query($conn, $delCartQuery);
    if ($delCartResult) {
        header("location: ./index.php?page=cart_list");
    }

?>