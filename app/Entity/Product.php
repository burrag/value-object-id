<?php declare(strict_types = 1);

namespace App\Entity;

use App\Entity\Id\ProductId;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity]
class Product
{

    #[Id]
    #[ORM\Column(type: 'product_id')]
    #[ORM\GeneratedValue('NONE')]
    private ProductId $id;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $title;

    public function __construct(ProductId $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }
}
