<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnType;

use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnName;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\ColumnType;

class SmallIncrementsType implements ColumnType
{
    /**
     * @param ColumnName $columnName
     * @return string
     */
    public function createMigrationMethod(ColumnName $columnName): string
    {
        return sprintf("->smallIncrements('%s')", $columnName->getName());
    }
}
