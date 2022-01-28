<?php declare(strict_types = 1);

namespace App\Presenters;

use App\Entity\Id\ProductId;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Presenter;

final class ProductPresenter extends Presenter
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    public function actionFind(ProductId $id): void
    {
        $product = $this->productRepository->getById($id);
    }

    public function actionSave(string $title): void
    {
        $product = new Product($this->productRepository->getNextId(), $title);
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        \dumpe($product);
    }
}
