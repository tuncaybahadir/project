<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CacheRemove extends Facade {

	public static function getFacadeAccessor()
	{
		return 'cacheremove';
	}

}