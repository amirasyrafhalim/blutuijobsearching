<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return response based on request type necessarily.
     *
     * @param $data
     * @param $redirectUrl
     * @param $statusCode
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function makeResponse($data, $redirectUrl, $statusCode)
    {
        if(request()->ajax() || request()->expectsJson()) {
            return response($data, $statusCode);
        }

        return redirect($redirectUrl)->with('message', $data);
    }
}
