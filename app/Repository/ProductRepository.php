<?php declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function getById(int $id): Product
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb->select('p')
            ->from(Product::class, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}