<?php include 'assets/php/db.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>proses</title>
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="assets/js/alertify.min.js"></script>
    <style type="text/css">
    	.ajs-cancel {
		  display: none;
		}
    </style>
</head>
<body>
<?php
// Koneksi ke database menggunakan MySQLi
$koneksi = mysqli_connect("localhost", "root", "", "rentalcamera");
if (mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Query login menggunakan MySQLi
    $login = mysqli_query($koneksi, "SELECT id_user, email, password FROM tb_user WHERE email='$email' AND password='$pass'");
    $hasil = mysqli_fetch_array($login);

    if (mysqli_num_rows($login) == 0) { ?>
        <script language="JavaScript">
            alertify.alert("Username Belum Terdaftar", function(){ window.location.assign('login-user'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
    <?php } else {
        if ($pass != $hasil['password']) { ?>
            <script language="JavaScript">
                alertify.alert("Password Salah", function(){ window.location.assign('login-user'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?php } else {
            $_SESSION['idUser'] = $hasil['id_user'];
        ?>
            <script type="text/javascript">
                window.location.assign('penyewaan-user');
            </script>
        <?php
        }
    }
}
?>

</body>

</html>