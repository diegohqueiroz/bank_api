<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;

    const INTERNAL_ERROR = 'Erro interno';

    protected function responseInternalErro($ex){
        Log::error($ex);
    	return response(['error' => self::INTERNAL_ERROR])->setStatusCode(500);
    }

    protected function responseApiErro($ex){
        Log::warning($ex);
	    return response(['error' => $ex->getMessage()])->setStatusCode(422);
	}
}
