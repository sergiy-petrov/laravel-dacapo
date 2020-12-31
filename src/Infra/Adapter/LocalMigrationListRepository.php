<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Infra\Adapter;

use Exception;
use Illuminate\Support\Facades\File;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Migration\MigrationFile;
use UcanLab\LaravelDacapo\App\Domain\ValueObject\Migration\MigrationFileList;
use UcanLab\LaravelDacapo\App\Port\MigrationListRepository;

class LocalMigrationListRepository implements MigrationListRepository
{
    protected string $basePath;

    /**
     * LocalMigrationListRepository constructor.
     */
    public function __construct()
    {
        $this->basePath = database_path('migrations');
    }

    /**
     * @return MigrationFileList
     */
    public function getFiles(): MigrationFileList
    {
        $files = File::files($this->getPath());

        $migrationFileList = new MigrationFileList();

        foreach ($files as $file) {
            try {
                $migrationFile = new MigrationFile($file->getFilename(), $file->getContents());
                $migrationFileList->add($migrationFile);
            } catch (Exception $exception) {
                // skip
            }
        }

        return $migrationFileList;
    }

    /**
     * @param MigrationFile $file
     */
    public function saveFile(MigrationFile $file): void
    {
        $path = $this->getPath($file->getName());

        File::put($path, $file->getContents());
    }

    /**
     * @param MigrationFile $file
     * @return bool
     */
    public function delete(MigrationFile $file): bool
    {
        File::delete($this->getPath($file->getName()));

        return true;
    }

    /**
     * @param string|null $fileName
     * @return string
     */
    protected function getPath(?string $fileName = null): string
    {
        if ($fileName) {
            return $this->basePath . '/' . $fileName;
        }

        return $this->basePath;
    }
}
