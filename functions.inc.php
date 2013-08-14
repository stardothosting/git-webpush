<?php

// Cross Site Script  & Code Injection Sanitization
function xss_cleaner($input_str) {
    $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}

function getbranches() {
	$command = "sudo -u gituser;cd /data/www/yoursite.com/repos/webapp; git ls-remote --heads origin | awk -F \"\\t\"  '{printf \"%s\\n\", $2}' | awk -F \"/\" '{printf \"%s\\n\",$3}'";
	exec($command,$branch_list);
	return($branch_list);
        }

function getcurrentbranch($branchpath) {
	if (!$prodbranch = @file_get_contents($branchpath . '/current_branch.txt')){
		$prodbranch_array[0] = "Cannot get current branch";
		$prodbranch_array[1] = "Cannot get current branch";
	}
	else {
		$prodbranch = @file_get_contents($branchpath . '/current_branch.txt');
		$prodbranch_array = explode(',', $prodbranch);
	}
	return($prodbranch_array);
	}

class logfile {
	function logfile() {
		$this->filename = "log.txt";
		$this->Username = $_SERVER['PHP_AUTH_USER'];
		$this->logfile = $this->filename;
	}
	
	function write($data) { // write to logfile
		$handle = fopen($this->logfile, "a+");
		$date = date("Y-m-d H:i:s");
		$IP = getenv('REMOTE_ADDR');
		$data = "[$date] {$this->Username}:{$IP} - " . $data . "\n";
		$return = fwrite($handle, $data);
		fclose($handle);
	}
	
	function display() { // display logfile
		$handle = fopen($this->logfile, "a+");
		while(!feof($handle)) { // Pull lines into array
			$lines[] = fgets($handle, 1024);
		}
		$count = count($lines);
		$count = $count - 2;
		for($i=$count;$i>=0;$i--) {
			echo $lines[$i] . "<br>";
		}
		fclose($handle);
	}
}
?>
