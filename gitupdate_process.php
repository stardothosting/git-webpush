<b>Update/Status Window</b>
<hr>


<?php
include("./functions.inc.php");


$logfile = new logfile();

$pushname=xss_cleaner($_POST['pushname']);
$sitename=xss_cleaner($_POST['name']);
$proddev=xss_cleaner($_POST['devprod']);

// Debug
//print "Input : " . $sitename;
//print "Input : " . $pushname;
//print "Processing request, details below :";

if($_POST['submitbutton']) {


	//Specific push command for Dev
	if($proddev == "dev") {
		echo "Dev push ...<br><br>";
		if($pushname == "invalidate") {
			$command = "/usr/local/bin/push.sh " . $pushname . " 2>&1";
		} else { 
			$branchname=xss_cleaner($_POST['gitbranch']);
			if ($branchname == "noneselected") {
				echo "No branch selected. Select the dropdown menu in the \"Branch to Export\" column.";
				exit(1);
			}
			$command = "/usr/local/bin/push.sh " . $pushname . " " . $branchname . " 2>&1";
		}
	}
	//Specific push command for Prod
	elseif($proddev == "prod") {
		echo "Prod push ...<br><br>";
		$command = "/usr/local/bin/push.sh " . $pushname . " 2>&1";
	}	
	if($_POST['submitbutton'] == "Export" || $_POST['submitbutton'] == "Invalidate") {
		$output = shell_exec("umask 022;" . $command);
		//$output = shell_exec("/usr/bin/tail -f " . $logtail);
		//$output = follow("/data/www/wdwdt.com/push.wdwdt.com/output.log");
	}

	echo "<pre>$output</pre>";
	}
	$logfile->write($logtext);

}

?>

