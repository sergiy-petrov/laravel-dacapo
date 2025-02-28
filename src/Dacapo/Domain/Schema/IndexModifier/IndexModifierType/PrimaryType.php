<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Domain\Schema\IndexModifier\IndexModifierType;

final class PrimaryType implements IndexModifierType
{
    public function __construct()
    {
    }

    public function getUpMethodName(): string
    {
        return 'primary';
    }

    public function getDownMethodName(): string
    {
        return 'dropPrimary';
    }
}
