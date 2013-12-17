<?
class link
{
	public $name;
	public $url;
	public $ico;
	public $prefix;
	
	function __construct($name, $url, $ico, $prefix = "")
	{
		$this->name = $name;
		$this->url = $url;
		$this->ico = $ico;
		
	    if (link::startsWith($url, "http") && $prefix == "")
	    {
	        $this->prefix = "target=\"_blank\"";
	    }
		else 
		{
		    $this->prefix = $prefix;
		}
	}
	
	static function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }
	
	function makeLink()
	{
		echo "<a class=\"list-group-item\" href=\"$this->url\" $this->prefix>";
		echo "<i class=\"fa fa-$this->ico fa-fw\"></i>";
		echo " $this->name</a>";
		//<i class=\"icon-fixed-width icon-$this->ico\"/></i> $this->name</a>";
	}
}
?>