<?php
$ipsy = [
	'213.241.55.',
	'214.231.22.',
];
$rbls = [
	'b.barracudacentral.org',
	'cbl.abuseat.org',
	
];
foreach ($ipsy as $checked_ip){
	
	echo "loop for$checked_ip\n";
	for ($count = 1;  $count <= 4; $count++){
		$ip          = $checked_ip.$count ;
		$rev         = join('.', array_reverse(explode('.', trim($ip))));
		echo "zmienna$rev\n";
		$i           = 1;
		$rbl_count   = count($rbls);
		$listed_rbls = [];
		foreach ($rbls as $rbl)
		{
		    printf('Checking %s, %d of %d... ', $rbl, $i, $rbl_count);
		    $lookup = sprintf('%s.%s', $rev, $rbl);
		    $listed = gethostbyname($lookup) !== $lookup;
		    printf('[%s]%s', $listed ? 'LISTED' : 'OK', PHP_EOL);
		    if ( $listed )
		    {
		        $listed_rbls[] = $rbl;
		    }
		    $i++;
		}

		printf('%s listed on %d of %d known blacklists%s', $ip, count($listed_rbls), $rbl_count, PHP_EOL);
		if ( ! empty($listed_rbls) )
		{
		    printf('%s listed on %s%s', $ip, join(', ', $listed_rbls), PHP_EOL);
		}
	};

};