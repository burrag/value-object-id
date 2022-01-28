<?php declare(strict_types = 1);

namespace App\Core\Form;

use Nette\Forms\Controls\SelectBox;

/**
 * @phpstan-template T of \App\Core\Id\EntityId
 */
class IdSelectBox extends SelectBox
{
    /**  @var class-string<T> */
    private string $className;

    /** @param class-string<T> $className */
    public function __construct(string $className, $label = null, array|null $items = null)
    {
        parent::__construct($label, $items);
        $this->className = $className;
    }

    /** @return T|null */
    public function getValue()
    {
        $rawValue = parent::getValue();

        return $rawValue !== null ? $this->className::fromScalar((int) $rawValue) : null;
    }
}
