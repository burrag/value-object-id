<?php declare(strict_types = 1);

namespace App\Core\Id;


abstract class EntityId implements IEntityId, \Stringable
{
    private int $id;

    final private function __construct(int $id)
    {
        $this->id = $id;
    }

    public function equals(EntityId $other): bool
    {
        return $this::class === $other::class && $this->id === $other->id;
    }

    public function toScalar(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->toScalar();
    }

    public static function fromScalar(int $scalar): static
    {
        return new static($scalar);
    }
}
