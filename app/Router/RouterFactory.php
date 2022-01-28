<?php declare(strict_types = 1);

namespace App\Router;

use App\Core\Router\IdObjectRouterFactory;
use App\Entity\Id\ProductId;
use Nette\Application\Routers\RouteList;
use Nette\StaticClass;

final class RouterFactory
{
    use StaticClass;

    public function __construct(
        private IdObjectRouterFactory $idObjectRouterFactory,
    ) {
    }

    public function createRouter(): RouteList
    {
        $router = new RouteList();
        $router->add($this->idObjectRouterFactory->create(
            ProductId::class,
            '/product/findById/<id>',
            ['presenter' => 'Product', 'action' => 'find']
        ));
        $router->addRoute('/product/save/<title>', 'Product:save');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');

        return $router;
    }
}
