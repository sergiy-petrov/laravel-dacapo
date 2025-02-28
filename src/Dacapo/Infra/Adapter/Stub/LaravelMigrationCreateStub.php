<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Infra\Adapter\Stub;

use UcanLab\LaravelDacapo\Dacapo\Domain\MigrationFile\Stub\MigrationCreateStub;

final class LaravelMigrationCreateStub implements MigrationCreateStub
{
    /**
     * @return string
     */
    public function getStub(): string
    {
        $filename = base_path('stubs/dacapo.migration.create.stub');

        if (file_exists($filename)) {
            return (string) file_get_contents($filename);
        }

        return (string) file_get_contents(__DIR__ . '/dacapo.migration.create.stub');
    }

    /**
     * @return array<int, string>
     */
    public function getNamespaces(): array
    {
        return [
            'use Illuminate\Database\Migrations\Migration;',
            'use Illuminate\Database\Schema\Blueprint;',
            'use Illuminate\Support\Facades\Schema;',
        ];
    }
}
