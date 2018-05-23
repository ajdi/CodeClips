<?
$time_now=time();

$time_then=time("1 day from now");
$time_end=strtotime("now + 1 day")."<br>\n";

$now=time();

$difference=$time_end-$now;

echo "Now: ".date("l, F m, Y, G:i:s",$now)."<br>\n";
echo "Future Time: ".date("l, F m, Y, G:i:s", $time_end)."<br>\n";
echo "Difference: ".date("d,H:i:s",$difference)." (d,h:m:s) - or - ".$difference." (seconds)<br>\n";
?>
