<?php
include("./functions.inc.php");

$sites[] = array(
"name" => "Production Site",
"pushname" => "www.prod",
"url" => "http://www.yoursite.com",
"path" => "/data/sites/yoursite.com/public_html",
"source" => "/data/sites/test.yoursite.com/public_html",
"base" => "1.00",
"notes" => "Production site."
);

$sites[] = array(
"name" => " Dev Site",
"pushname" => "www.dev",
"url" => "http://test.yoursite.com",
"path" => "/data/sites/test.yoursite.com/public_html",
"source" => "/data/sites/test.yoursite.com/git",
"base" => "1.00",
"notes" => "Dev site"
);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title> GIT Push</title>

<style>
body {
	background-color:#eeeeee;
}

.tdheader {
	background-color:#0f2c66;
	color:#FFFFFF;
	font-weight: bold;
}

.tdheader2 {
	background-color:#000000;
	color:#FFFFFF;
	font-weight: bold;
}

.tdrow {
	background-color:#ffffff;
	color:#000000;
	font-weight: normal;
}

a:link,a:active,a:visited {
	color:#0f2c66;
}

a:hover {
	color:#6A9CD3;
}

.menuon {
	background-color:#6699cc;
	color:white;
	font-weight: bold;
}

.menuoff {
	background-color:white;
	color:black;
	font-weight: bold;
}

table {
	border-style: solid;
	border-width: 1px;
	border-color: #000000;
}

</style>
<script type="text/javascript">
function confirmexport(text) {
	if (confirm(text)) {
		document.getElementById('framecont').style.display = '';
		document.getElementById("processframe").contentWindow.document.body.innerHTML = "<div align='center'>Exporting ... </div>";
		return true;
	} else return false;
}
function viewframe() {
        document.getElementById('framecont').style.display = '';
}
</script>
</head>

<body>
<br><br><br><br>
<center>
<big><b>Code Push Page</b></big>
<hr size="1" noshade="noshade" />
<br><br>
<table cellpadding="2" width="80%" cellspacing="1" bgcolor="#000000" border="0">
<tr class="tdheader">
<td>Site</td>
<td>Source</td>
<td>Export Code</td>
<td>Current Branch</td>
<td>Last Exported</td>
<td>Notes</td>
</tr>

<?php
if($sites) {
foreach($sites as $key => $value) {
?>
<form method="POST" action="gitupdate_process.php" target="processframe">
<input type="hidden" name="name" value="<?php echo $value['name']?>">
<input type="hidden" name="pushname" value="<?php echo $value['pushname']?>">
<input type="hidden" name="devprod" value="prod">
<tr class="tdrow">
<td><a href="<?php echo $value['url']?>" target="_blank"><?php echo $value['name']?></a></td>
<td><?php echo $value['source']?></td>
<td><input type="hidden" name="site" value="<?php echo $value['path']?>">
<input type="submit" name="submitbutton" value="<?php echo ($value['pushname'] == "invalidate") ? "Invalidate":"Export";?>" onClick="javascript:return confirmexport('<?php echo ($value['pushname'] == "invalidate") ? "This will submit a request to invalidate differentially changed files on CloudFront":"This will overwrite the current files on " . $value['name'];?>. Are you sure?');">
<td><?php
if ($value['pushname'] == "invalidate") {
echo "Not applicable";
} else {
$tmp = getcurrentbranch($value['path']);
$currentbranch = $tmp[0];
echo $currentbranch;
}
 ?></td>
<td><?php
if ($value['pushname'] == "invalidate") {
echo "Not applicable";
} else {
$tmp = getcurrentbranch($value['path']);
$exporttime = $tmp[1];
echo $exporttime;
}
 ?></td>
<td><?php echo $value['notes']?></td>
</tr>
</form>
<?php } ?>
<?php } ?>
</table>
<br>
<a href="log.php" target="processframe" onclick="viewframe()">View Export Log</a>
<br><div id='framecont' style="text-align: left; display: none">
<iframe name="processframe" id="processframe" width="1000px" height="300px" align="left" scrolling="yes" frameborder="0">
                </iframe>
</center>
</div>
</body>
</html>

