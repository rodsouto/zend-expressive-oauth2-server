<?php

namespace OAuth2Server\Middleware;

use League\OAuth2\Server\Middleware\ResourceServerMiddleware as LeagueResourceServerMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ResourceServerMiddleware
{

    private $middleware;

    public function __construct(LeagueResourceServerMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {

        /** @var \Zend\Expressive\Router\RouteResult $routeResult */
        $routeResult = $request->getAttribute(\Zend\Expressive\Router\RouteResult::class);

        if (!$routeResult) {
            return $next($request, $response);
        }

        if($routeResult->getMatchedRoute()->getName() === 'oauth2.access_token') {
            return $next($request, $response);
        }

        return ($this->middleware)($request, $response, $next);
    }
}
