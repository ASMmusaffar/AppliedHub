<?PHP

$conn=mysqli_connect("localhost","root","","appliedhub");
if(!$conn){
    $error=mysqli_connect_error();
    echo "<script>alert('$error')</script>";
}
else{
    //echo '<script>alert("Conected")</script>';
}

?>