<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Infra\Adapter;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Schema;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\SchemaList;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Table\TableName;
use UcanLab\LaravelDacapo\Dacapo\Presentation\Shared\Exception\Console\DuplicatedTableNameException;
use UcanLab\LaravelDacapo\Dacapo\Presentation\Shared\Exception\Console\SchemaFileEmptyException;
use UcanLab\LaravelDacapo\Dacapo\Presentation\Shared\Storage\DatabaseSchemasStorage;
use function count;

final class LaravelDatabaseSchemasStorage implements DatabaseSchemasStorage
{
    /**
     * @param Filesystem $filesystem
     * @param string $filePath
     */
    public function __construct(
        private Filesystem $filesystem,
        private string $filePath,
    ) {
    }

    /**
     * @return SchemaList
     */
    public function getSchemaList(): SchemaList
    {
        $ymlFiles = array_map(fn ($f) => (string) $f->getRealPath(), $this->filesystem->files($this->filePath));

        $schemaBodies = [];

        foreach ($ymlFiles as $ymlFile) {
            $parsedYmlFile = Yaml::parseFile($ymlFile);

            if ($parsedYmlFile === null) {
                throw new SchemaFileEmptyException(sprintf('%s file is empty.', $ymlFile));
            }

            $intersectKeys = array_intersect_key($schemaBodies, $parsedYmlFile);

            if (count($intersectKeys) > 0) {
                throw new DuplicatedTableNameException(sprintf('Duplicate table name for `%s` in the schema YAML', implode(', ', array_keys($intersectKeys))));
            }

            $schemaBodies = array_merge($schemaBodies, $parsedYmlFile);
        }

        $list = [];
        foreach ($schemaBodies as $tableName => $tableAttributes) {
            $list[] = Schema::factory(new TableName($tableName), $tableAttributes);
        }

        return new SchemaList($list);
    }
}
