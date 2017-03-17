<?php
class Breadcrumb
{
	public function __construct()
	{
		print_r($_SERVER);
		$this->parse();
	}

	private function parse()
	{
		echo 'r';
	}
}
?>
