<?php 
$time_format = $_POST["time_format"];
if($t_offset=='' || $t_offset>12){$t_offset = "0";}
$output = '<?php $wpc_textcolor = "'.$clockfontcolor.'";
';
$output .= '$wpc_bgcolor = "'.$clockbgcolor.'";
$wpc_time_format = "'.$time_format.'";
$time_type = "'.$time_type.'";
$t_offset_type = "'.$t_offset_type.'";
$t_offset = "'.$t_offset.'";
?>';
$ourFileName = 'wp-clock-params.php';
$fh = fopen($ourFileName, 'w') or die("can't open file");
fwrite($fh, $output);
fclose($fh);

$url = $_SERVER['HTTP_REFERER'].'&clock_updated=true';
header("Location: ".$url);
?>