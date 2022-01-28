<?php declare(strict_types = 1);

namespace App\Entity;

use App\Entity\Id\CategoryId;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity]
class Category
{
    #[Id]
    #[ORM\Column(type: 'category_id')]
    #[ORM\GeneratedValue('NONE')]
    private CategoryId $id;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $title;

    public function __construct(CategoryId $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


}
