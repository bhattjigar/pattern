<?php
libxml_use_internal_errors(true);
libxml_clear_errors();
error_reporting(0);
class crawl
{
	public function __construct($url)
	{
		$this->url=$url;
	}
	// opening cmd for command 
	public function opencmd($command,$callback)
	{
		$this->command=$command;
		//callback for running diiferent function 
		echo $this->command;
		$this->cmdprocess($this->command);

	}
	public function cmdprocess($c)
	{
		if(ob_get_level()==0) 
		ob_start();
		//create arrays for retrieving using pipes
		$retrievarray=array(
		0 => array("pipe","w"),
		1 => array("pipe","w"),
		2 => array("pipe","w"),
		3 => array("pipe","w"),
		4 => array("pipe","w"),
		5 => array("pipe","w")
		);
		//process for retrieve data

		$process=proc_open($c, $retrievarray,$pipes,realpath('./'),array());
		if(is_resource($process))
		{

			while($data=fgets($pipes[2]))
			{

				echo $data;
				// ob_flush();
				// flush();
			}
		}
		else
		{
			echo "fuck";
		}
	}

}

class parser
{
	public function __construct($url)
	{
		$this->filename=sha1($url);
	}
	public function fopen($callback)
	{
		$this->tree=array();
		$this->tree=$callback($this->filename,$this->tree);
	}
}

$url='http://www.mensxp.com/entertainment/gossip/31016-here-s-proof-that-deepika-padukone-is-the-coolest-girlfriend-ever.html';
$web=new crawl($url);
$filename=sha1($url);
$command="./shell.sh  $filename $url";
$web->opencmd($command,function($c){

	

});

//starting parser with no limitations 
$page=new parser($url);
$page->fopen(function($file,$tree){
	$html=file_get_contents("./".$file,true);
	
	$dom=new DOMDocument;
	$dom->loadHTMl($html);
	foreach ($dom->getElementsByTagName('*') as $htmltag)
	{
		$count=0;
		foreach ($htmltag->attributes as $name => $value)
		{
			$tree[$htmltag->nodeName][$count]=$name;
			// $tree[$htmltag->nodeName][$name]=$value;
			$count++;
		}

	}
	return $tree;
	// print_r($tree);
});


//////////////second time testing
$url='http://www.mensxp.com/relationships/understanding-women/30372-20-men-share-the-most-adorable-thing-about-the-women-in-their-lives-it-s-simply-beautiful.html';
$web2=new crawl($url);
$filename=sha1($url);
$command="./shell.sh  $filename $url";
$web2->opencmd($command,function($c){

	

});

//starting parser with no limitations 
$page2=new parser($url);
$page2->fopen(function($file,$tree){
	$html=file_get_contents("./".$file,true);
	
	$dom=new DOMDocument;
	$dom->loadHTMl($html);
	foreach ($dom->getElementsByTagName('*') as $htmltag)
	{
		$count=0;
		foreach ($htmltag->attributes as $name => $value)
		{
			$tree[$htmltag->nodeName][$count]=$name;
			// $tree[$htmltag->nodeName][$name]=$value;
			$count++;
		}

	}
		return $tree;
	// print_r($tree);
});


///diffrence between array
print_r($page->tree);print_r($page2->tree);
// $result=array_diff($page->tree,$page2->tree);
$result=array_diff_assoc($page->tree,$page2->tree);
if(!empty($result))
{
	print_r($result);
	echo "array differ";
}
else
{
	echo "array same";
}

?>