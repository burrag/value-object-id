<?php declare(strict_types = 1);

namespace App\Entity\Id;

use App\Core\Id\EntityIdType;

class ProductIdType extends EntityIdType
{

    protected function getIdClassName(): string
    {
        return ProductId::class;
    }

    public function getName()
    {
        return 'product_id';
    }
}
