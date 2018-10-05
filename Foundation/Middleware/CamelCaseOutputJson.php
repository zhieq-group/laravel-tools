<?php

namespace ZhiEq\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ZhiEq\Contracts\MiddlewareExceptRoute;

class CamelCaseOutputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        /**
         * @var Response $response
         */
        $response = $next($request);
        if(!empty($response->getContent()) && !empty(json_decode($response->getContent(), true))){
            $response->setContent(json_encode(camel_case_array_keys(json_decode($response->getContent(), true))));
        }
        return $response;
    }
}