<?php declare(strict_types = 1);

namespace App\Component\ProductControl;

use App\Core\Form\IdSelectBox;
use App\Entity\Id\ProductId;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class ProductControl extends Control
{
    private IdSelectBox $selectBox;

    public function render(): void
    {
        $this->getTemplate()->render();
    }

    public function createComponentProductForm(): Form
    {
        $form = new Form();
        $this->selectBox = new IdSelectBox(ProductId::class, 'Product', []);
        $form->addComponent($this->selectBox, 'product');

        $form->onSuccess[] = function(){
            $id = $this->selectBox->getValue();
        };

        return $form;
    }
}
