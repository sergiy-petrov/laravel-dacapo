<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnType;

use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnName;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnType;

class DateTimeType implements ColumnType
{
    /**
     * @var int|null
     */
    protected ?int $args;

    public function __construct(?int $args = null)
    {
        $this->args = $args;
    }

    /**
     * @param ColumnName $columnName
     * @return string
     */
    public function createMigrationMethod(ColumnName $columnName): string
    {
        if (is_int($this->args)) {
            return sprintf("->dateTime('%s', %d)", $columnName->getName(), $this->args);
        }

        return sprintf("->dateTime('%s')", $columnName->getName());
    }
}
