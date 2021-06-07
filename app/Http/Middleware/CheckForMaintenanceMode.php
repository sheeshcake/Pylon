<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;


class CheckForMaintenanceMode {

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, Closure $next)
    {
        // if (!in_array($request->getClientIp(), ['180.190.9.97', '180.190.9.179', '180.190.9.170','180.190.9.100']))
        // {
        //     abort(503);
        // }
        return $next($request);
    }

}