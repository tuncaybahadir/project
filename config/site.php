<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Number of results to show per page
	|--------------------------------------------------------------------------
	|
	| To Use, simply call Config::get('site.num_results_per_page');
	|
	*/

	'uploads_url' => '/content/uploads/',
	'uploads_dir' => '/content/uploads/',
	'radio_logos_dir' => env("DOMAIN")  . 'radios/',
	'banner_upload_dir' => env("DOMAIN")  . 'banners/',
	'media_upload_function' => 'ImageHandler::upload',
	'num_results_per_page' => 15,
);