<?php

require_once("RLCommon.php");

class RLHeader
{
	public function __construct()
	{
		$this->mIncludeCSS = false;
		$this->mIncludeScript = false;
	}

	public function setIncludeCSS($includeCSS)
	{
		$this->mIncludeCSS = $includeCSS;
	}

	public function getIncludeCSS()
	{
		return $this->mIncludeCSS;
	}

	public function setIncludeScript($includeScript)
	{
		$this->mIncludeScript = $includeScript;
	}

	public function getIncludeScript()
	{
		return $this->mIncludeScript;
	}


	public function display($pageTitle)
	{
		 
		$cssContent = " ";
		$scriptContent = " ";

		if( $this->mIncludeCSS)
		{
			$cssContent = <<<EOF
            <link rel="stylesheet" type="text/css" href="style.css" />
EOF;
		}

		if( $this->mIncludeScript)
		{
			$scriptContent = <<<EOF
            <script type="text/javascript" src="script/jquery-1.7.1.js"> </script>
            <script type="text/javascript" src="script/util.js"> </script>
EOF;
		}

		$productName = RL__('Rolling');
		
		return <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> $productName - $pageTitle  </title>
    $cssContent
    $scriptContent
</head>
<body>
    <h3>$productName / $pageTitle </h3>
EOF;
	}


	protected $mIncludeCSS;
	protected $mIncludeScript;
}

?>
