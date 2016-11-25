<?php
namespace ___NAMESPACE___\Config;

use Electro\Interfaces\Navigation\NavigationInterface;
use Electro\Interfaces\Navigation\NavigationProviderInterface;

class Navigation implements NavigationProviderInterface
{
  function defineNavigation (NavigationInterface $nav)
  {
    $nav->add ([
      ''               => $nav
        ->link ()
        ->id ('homepage')
        ->title ('Home'),
      'about'          => $nav
        ->link ()
        ->id ('about')
        ->title ('About'),
      'contact'        => $nav
        ->link ()
        ->id ('contact')
        ->title ('Contact'),
      'single-post'    => $nav
        ->link ()
        ->id ('singlePost')
        ->title ('Single Post'),
      'porfolio'       => $nav
        ->link ()
        ->id ('porfolio')
        ->title ('Porfolio'),
      'single-project' => $nav
        ->link ()
        ->id ('single-project')
        ->title ('SingleProject'),
    ]);
  }


}
