<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\LongTextType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class LongTextTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('longText', (new LongTextType())->columnType());
    }
}
