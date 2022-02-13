<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Infra\Adapter;

use Illuminate\Filesystem\Filesystem;
use UcanLab\LaravelDacapo\Dacapo\Presentation\Shared\Storage\DatabaseMigrationsStorage;

final class LaravelDatabaseMigrationsStorage implements DatabaseMigrationsStorage
{
    /**
     * @param Filesystem $filesystem
     */
    public function __construct(private Filesystem $filesystem)
    {
    }

    /**
     * @param string $fileName
     * @param string $fileContents
     */
    public function saveFile(string $fileName, string $fileContents): void
    {
        $this->filesystem->put(database_path('migrations/' . $fileName), $fileContents);
    }
}
