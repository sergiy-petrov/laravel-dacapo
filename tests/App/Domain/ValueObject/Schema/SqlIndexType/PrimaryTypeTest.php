<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Test\App\Domain\ValueObject\Schema\SqlIndexType;

use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\SqlIndex;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\SqlIndexType\IndexType;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Schema\SqlIndexType\PrimaryType;
use UcanLab\LaravelDacapo\Test\TestCase;

class PrimaryTypeTest extends TestCase
{
    /**
     * @param string $expected
     * @param string $columns
     * @param string|null $name
     * @param string|null $algorithm
     * @dataProvider dataCreateIndexMigrationUpMethod
     */
    public function testCreateIndexMigrationUpMethod(string $expected, string $columns, ?string $name, ?string $algorithm): void
    {
        $indexType = new PrimaryType();
        $index = new SqlIndex($indexType, $columns, $name, $algorithm);
        $this->assertSame($expected, $indexType->createIndexMigrationUpMethod($index));
    }

    /**
     * @return array
     */
    public  function dataCreateIndexMigrationUpMethod(): array
    {
        return [
            'name:null' => [
                'expected' => "->primary(['test'])",
                'columns' => 'test',
                'name' => null,
                'algorithm' => null,
            ],
            'name:test_alias_index' => [
                'expected' => "->primary(['test'], 'test_alias_index')",
                'columns' => 'test',
                'name' => 'test_alias_index',
                'algorithm' => null,
            ],
        ];
    }

    /**
     * @param string $expected
     * @param string $columns
     * @param string|null $name
     * @dataProvider dataCreateIndexMigrationDownMethod
     */
    public function testCreateIndexMigrationDownMethod(string $expected, string $columns, ?string $name): void
    {
        $indexType = new PrimaryType();
        $index = new SqlIndex($indexType, $columns, $name);
        $this->assertSame($expected, $indexType->createIndexMigrationDownMethod($index));
    }

    /**
     * @return array
     */
    public  function dataCreateIndexMigrationDownMethod(): array
    {
        return [
            'name:null' => [
                'expected' => "->dropPrimary(['test'])",
                'columns' => 'test',
                'name' => null,
            ],
            'name:test_alias_index' => [
                'expected' => "->dropPrimary('test_alias_index')",
                'columns' => 'test',
                'name' => 'test_alias_index',
            ],
        ];
    }
}
