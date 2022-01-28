<?php declare(strict_types = 1);

namespace App\Core\Id;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EntityIdType extends Type
{
    public function convertToPHPValue($sqlExpr, $platform): EntityId|null
    {
        if ($sqlExpr === null) {
            return null;
        }
        if (\is_int($sqlExpr) === false) {
            throw new \InvalidArgumentException('ID must be an integer.');
        }

        $class = $this->getIdClassName();
        \assert($class instanceof EntityId);

        return $class::fromScalar($sqlExpr);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int|null
    {
        if ($value === null) {
            return null;
        }
        if ($value instanceof IEntityId === false) {
            throw new \InvalidArgumentException('ID must be an instance of IEntityId.');
        }

        return $value->toScalar();
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($fieldDeclaration);
    }

    /** @return class-string */
    abstract protected function getIdClassName(): string;
}
