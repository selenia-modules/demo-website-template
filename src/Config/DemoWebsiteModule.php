<?php
namespace SeleniaTemplates\DemoWebsite\Config;

use SeleniaTemplates\DemoWebsite\Controllers\Index;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Electro\Application;
use Electro\Core\Assembly\Services\ModuleServices;
use Electro\Interfaces\Http\RouterInterface;
use Electro\Interfaces\ModuleInterface;
use Electro\Interfaces\Navigation\NavigationInterface;
use Electro\Interfaces\Navigation\NavigationProviderInterface;
use Selenia\Platform\Components\Base\PageComponent;

class DemoWebsiteModule implements ModuleInterface, NavigationProviderInterface
{
  /** @var RouterInterface */
  private $router;

  function __invoke (ServerRequestInterface $request, ResponseInterface $response, callable $next)
  {
    return $this->router
      ->set ([
        // Example route implementing a self-contained component-like controller.
        '.'     => Index::class,

        // Example route using an automatic controller and an external view.
        'page1' => factory (function (PageComponent $page) {
          $page->templateUrl = 'page1.html'; // try changing this to page2 and see what happens...
          return $page;
        }),

        // page2 is served via auto-routing (but only on debug/development mode)
      ])
      ->__invoke ($request, $response, $next);
  }

  function configure (ModuleServices $module, RouterInterface $router, Application $app)
  {
    $this->router = $router;
    $app->name    = 'demo';            // session cookie name
    $app->appName = 'Minimal Website'; // default page title; also displayed on title bar (optional)
    $app->title   = '@ - Demo';        // @ = page title
    $module
      ->publishPublicDirAs ('modules/demo-company/demo-project')
      ->provideMacros ()
      ->provideViews ()
      ->registerRouter ($this)
      ->registerNavigation ($this);
  }

  function defineNavigation (NavigationInterface $navigation)
  {
    $navigation->add ([
      '' => $navigation
        ->link ()
        ->id ('home')
        ->title ('Home')
        ->links ([
          'page1' => $navigation
            ->link ()
            ->id ('page1')
            ->title ('Page 1'),
          'page2' => $navigation
            ->link ()
            ->id ('page2')
            ->title ('Page 2'),
        ]),
    ]);
  }

}
