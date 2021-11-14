<?php declare(strict_types = 1);

namespace App\Presenters;

use App\Repository\ProductRepository;
use Nette\Application\UI\Presenter;

final class ProductPresenter extends Presenter
{

    public function __construct(
        private ProductRepository $productRepository,
    ) {
        parent::__construct();
    }

    public function actionDefault(int $id): void
    {
        $product = $this->productRepository->getById($id);
        bdump($product->getTitle());
    }
}