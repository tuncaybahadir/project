<?php namespace App\Http\Middleware;

use FtpPhp\FtpClient;
use FtpPhp\FtpException;
use Illuminate\Support\Facades\Config as Config;

class Ftp extends FtpClient {
	
	public function connect($alias = 'default')
	{
		$site = Config::get('ftp.' . $alias);

		parent::connect($site['host']);
		$this->login($site['username'], $site['password']);
		$this->pasv(TRUE);

		return $this;
	}
}