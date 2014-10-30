<?

if (strpos(strtolower(PHP_OS), "win") === false)
	$loads = sys_getloadavg();

if (isset($_GET["progressbars"]))
{
    echo json_encode(@getPBObject());
    die();
}

function getPBObject()
{
    $load["1 min"] = getLoad(0);
    $load["5 min"] = getLoad(1);
    $load["15 min"] = getLoad(2);
  $responce["load"] = $load;
	
  $responce["ram"] = getFreeRam();
    
    $disk["Root"] = getDiskspace("/");
    $disk["Data"] = getDiskspace("/media/Data");
    $disk["Backup"] = getDiskspace("/media/Backup");
    
  $responce["disk"] = $disk;
    
  return $responce;
}
	
function getSystemMemInfo()
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
    	@list($key, $val) = explode(":", $line);
    	$meminfo[$key] = trim($val);
    }
    return $meminfo;
}

function getFreeRam()
{
	$sysInfo = getSystemMemInfo();
	$free = intval(str_replace(" kb", "", $sysInfo['MemFree'])) + intval(str_replace(" kb", "", $sysInfo['Cached'])) + intval(str_replace(" kb", "", $sysInfo['Buffers']));
	$total = intval(str_replace(" kb", "", $sysInfo['MemTotal']));
	$ramUsed =  $total - $free;
	return sprintf('%.0f',($ramUsed / $total) * 100);
}

function getDiskspace($dir)
{
	$df = disk_free_space($dir);
	$dt = disk_total_space($dir);
	$du = $dt - $df;
	return sprintf('%.0f',($du / $dt) * 100);
}

function getLoad($id)
{
	return 100 * $GLOBALS['loads'][$id];
}
?>
