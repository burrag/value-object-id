<?php declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Id\CategoryId;
use App\Entity\Id\ProductId;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function getNextId(): ProductId
    {
        $conn = $this->entityManager->getConnection();
        $sql = $conn->getDatabasePlatform()?->getSequenceNextValSQL('product_id_seq');

        return ProductId::fromScalar((int) $conn->executeQuery($sql)->fetchOne());
    }

    public function getById(ProductId $id): Product
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb->select('p')
            ->from(Product::class, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    public function findProductInCategory(CategoryId $id): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb->select('p')
            ->from(Product::class, 'p')
            ->where('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }
}
