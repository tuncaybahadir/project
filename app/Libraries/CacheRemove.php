<?php namespace App\Libraries;

use Cache;
use Config;
use Guzzle\Http\Client;


class CacheRemove
{

    public function tags($get)
    {
        Cache::tags($get)->flush();
    }

    public function key($get)
    {
        Cache::forget($get);
    }

    public function tagsInKey($get, $key)
    {
        Cache::tags($get)->forget($key);
    }

    public function purge($url = '/$') {
        $client = new Client('http://proje.127.0.0.1.xip.io');
        $client->createRequest('PURGE', $url)->send();
    }

}