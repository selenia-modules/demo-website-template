<?php
namespace ___NAMESPACE___\Config;

use Electro\Interfaces\Http\RequestHandlerInterface;
use Electro\Interfaces\Http\RouterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Routes implements RequestHandlerInterface
{
  /** @var RouterInterface */
  private $router;

  public function __construct (RouterInterface $router)
  {
    $this->router = $router;
  }

  function __invoke (ServerRequestInterface $request, ResponseInterface $response, callable $next)
  {
    return $this->router
      ->set ([
        '.'              => page ('index.html'),
        'about'          => page ('about.html'),
        'contact'        => page ('contact.html'),
        'blog'           => page ('blog.html'),
        'single-post'    => page ('single-post.html'),
        'portfolio'      => page ('portfolio.html'),
        'single-project' => page ('single-project.html'),
        // '.' => Some::class,
      ])
      ->__invoke ($request, $response, $next);
  }

}
