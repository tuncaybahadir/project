<?php namespace App\Http\Middleware;

use App;
use Closure;
use Request;
use Illuminate\Contracts\Auth\Guard;
use Input;

class Trust {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $iplong = ip2long(self::getIp());

        if (
            $iplong != 2130706433 and
            (
            ($iplong < ip2long('192.168.1.1') or $iplong > ip2long('192.168.1.255'))
            )
        )
            App::abort(404);

        return $next($request);
    }

    private static function getIp() {
        if(getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');

        if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            $ip = explode(',', $ip);
            return trim($ip[0]);
        }

        return $_SERVER['REMOTE_ADDR'];
    }

}
