<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\UnsignedMediumIntegerType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class UnsignedMediumIntegerTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('unsignedMediumInteger', (new UnsignedMediumIntegerType())->columnType());
    }
}
