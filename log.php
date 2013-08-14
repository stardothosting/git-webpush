<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
        <title>Untitled</title>
</head>

<body>
<b>Export Log:</b><hr>
<?php
include("./functions.inc.php");
$logfile = new logfile();
$logfile->display();
?>
</body>
</html>
