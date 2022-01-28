<?php declare(strict_types = 1);

namespace App\Entity\Id;

use App\Core\Id\EntityIdType;

class CategoryIdType extends EntityIdType
{

    protected function getIdClassName(): string
    {
        return CategoryId::class;
    }

    public function getName()
    {
        return 'category_id';
    }
}
