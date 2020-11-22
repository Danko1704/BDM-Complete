<?php
include('dbOrlando.php');

$sql = $con->query("call sp_selectUsuarios();");
$result = mysqli_query($con, $sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysqli_error();
    exit;
}

while ($row = mysqli_fetch_row($result)) {
    echo "<script>
    var z = document.createElement('option');
    z.setAttribute('value', '".$row[0]."');
    var t = document.createTextNode('".$row[0]."');
    z.appendChild(t);
    document.getElementById('mySelect').appendChild(z);</script>";

}
?>