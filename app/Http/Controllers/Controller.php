<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\ControllerMiddlewareOptions;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected $middleware = [];

    /**
     * Apply middleware to controller actions.
     *
     * @param  \Closure|array|string  $middleware
     * @param  array  $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */

    public function checkLogin()
    {
        if (!Auth::check()) {
            Auth::logout();
            return redirect()->route('login');
        }
    }
    public function getCurrentDateTime()
    {

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->toDateTimeString();
        return $formattedDateTime;
    }
    public function getCurrentDate()
    {
        return Carbon::now()->toDateString();
    }

    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }
}
