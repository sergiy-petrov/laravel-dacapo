<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\SmallIntegerType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class SmallIntegerTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('smallInteger', (new SmallIntegerType())->columnType());
    }
}
