<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo htmlspecialchars($title);  ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/zebra_form.css" />
	</head>
<body>
<h1><?php echo htmlspecialchars($title);  ?></h1>

<?php
$info = flash_now('info');
if ($info != null) {
    printf("<p style=\"color: blue\">%s</p>\n", htmlspecialchars($info));
}
$error = flash_now('error');
if ($error != null) {
    printf("<p style=\"color: red\">%s</p>\n", htmlspecialchars($error));
}
?>

<?php echo $content;  ?>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/zebra_form.js"></script>

</body>
</html>

