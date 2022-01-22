<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnName;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnType;

final class NullableUuidMorphsType implements ColumnType
{
    /**
     * @var string|null
     */
    private ?string $args;

    public function __construct(?string $args = null)
    {
        $this->args = $args;
    }

    /**
     * @param ColumnName $columnName
     * @return string
     */
    public function createMigrationMethod(ColumnName $columnName): string
    {
        if ($this->args) {
            return sprintf("->nullableUuidMorphs('%s', '%s')", $columnName->getName(), $this->args);
        }

        return sprintf("->nullableUuidMorphs('%s')", $columnName->getName());
    }
}
