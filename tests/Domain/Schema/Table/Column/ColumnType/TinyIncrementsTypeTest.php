<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\TinyIncrementsType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class TinyIncrementsTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('tinyIncrements', (new TinyIncrementsType())->columnType());
    }
}
