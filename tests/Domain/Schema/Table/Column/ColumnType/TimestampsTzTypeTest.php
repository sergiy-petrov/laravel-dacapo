<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\Domain\Schema\Table\Column\ColumnType;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\Column\ColumnType\TimestampsTzType;
use UcanLab\LaravelDacapo\Test\TestCase;

final class TimestampsTzTypeTest extends TestCase
{
    public function testResolve(): void
    {
        $this->assertSame('timestampsTz', (new TimestampsTzType())->columnType());
    }
}
