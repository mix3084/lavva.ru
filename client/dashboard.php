<?php
$title = "Личный кабинет";
$description = "ХУЙНЯ.";

include '../header.php';
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
	exit();
}

$user = $_SESSION['user'];
include 'sidebar.php';
?>
<div class="content-page">
	<div class="content">
		<div class="container-fluid p-3">
			<?php
				$page = $_GET['page'] ?? 'profile';
				include $page . '.php';
			?>
		</div>
	</div>
</div>
<?php include '../footer.php';?>