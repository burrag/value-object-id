<?php declare(strict_types = 1);

namespace App\Core\Router;

use App\Core\Id\EntityId;
use Nette\Application\Routers\Route;

class IdObjectRouterFactory
{
    /**
     * @param class-string<EntityId> $className
     */
    public function create(string $className, string $mask, array $metadata = [], int $flags = 0): Route
    {
        $metadata['id'] = [
            Route::FILTER_IN => static function(string $id) use ($className): EntityId {
                return $className::fromScalar((int) $id);
            },
            Route::FILTER_OUT => static function(EntityId $id): int {
                return $id->toScalar();
            },
        ];

        return new Route($mask, $metadata, $flags);
    }
}
