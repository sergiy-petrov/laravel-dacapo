<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\BigIntegerType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class BigIntegerTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('bigInteger', (new BigIntegerType())->columnType());
    }
}
