<?php
/**
 * This file simply provides the user with a button to flush the memcache servers
 *
 * author:  Zachary Brown
 */

//Array of server:port
$memcache_servers = array('127.0.0.1:11211');

if($_POST['submit']){
	foreach($memcache_servers as $memserv){
		$memparts = explode(':',$memserv);
		$servername = $memparts[0];
		$serverport = $memparts[1];
		$memcache_obj = memcache_connect($servername,$serverport);
		if(!$memcache_obj){die("Could not connect to memcache server $servername");}
		if(!(memcache_flush($memcache_obj))){die("Could not flush cache of $servername");}
		echo "Flush of $servername successful<br>";	
	}
	echo "<br>All servers have been flushed<br>";
	exit;
}

?>

<html>
<body>
Please be aware that flushing the cache can lead to performance problems and website slowness for a couple minutes!<br><br>
<form method="post" action="flush-memcache.php">
<input name="submit" type="submit" value="FLUSH CACHE">
</form>

</body></html>
