<?php

require_once (__DIR__.'/core/init.php');

//create short variable names
$firstname = ($_POST['fname']);
?>
<html>
<head>
	<title>Your Name is:</title>
</head>
<body>
	<?php

	echo "<p>Your Names are: </p>";
	echo $firstname. " is your first name</br>";
	?>
</body>
</html>