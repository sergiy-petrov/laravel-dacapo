<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnModifier;

final class AutoIncrementModifier extends ColumnModifier
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'autoIncrement';
    }
}
