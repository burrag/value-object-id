<?php declare(strict_types = 1);

namespace App\Core\Id;

interface IEntityId
{
    /**
     * @return mixed
     */
    public function toScalar();
}
