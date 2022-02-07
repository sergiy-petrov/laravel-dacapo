<?php declare(strict_types=1);

namespace UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnModifier;

use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnModifier\ColumnModifierArgs\BooleanColumnModifierArgs;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnModifier\ColumnModifierArgs\IntColumnModifierArgs;
use UcanLab\LaravelDacapo\Dacapo\Domain\Schema\Column\ColumnModifier\ColumnModifierArgs\StringColumnModifierArgs;
use UcanLab\LaravelDacapo\Dacapo\Domain\Shared\Exception\Schema\Column\ColumnModifier\InvalidArgumentException;
use function is_string;
use function is_bool;
use function is_int;

final class ColumnModifierFactory
{
    private const MAPPING_CLASS = [
        'always' => AlwaysModifier::class,
        'autoIncrement' => AutoIncrementModifier::class,
        'charset' => CharsetModifier::class,
        'collation' => CollationModifier::class,
        'comment' => CommentModifier::class,
        'default' => DefaultModifier::class,
        'defaultRaw' => DefaultRawModifier::class,
        'from' => FromModifier::class,
        'generatedAs' => GeneratedAsModifier::class,
        'index' => IndexModifier::class,
        'nullable' => NullableModifier::class,
        'storedAs' => StoredAsModifier::class,
        'unique' => UniqueModifier::class,
        'unsigned' => UnsignedModifier::class,
        'useCurrent' => UseCurrentModifier::class,
        'useCurrentOnUpdate' => UseCurrentOnUpdateModifier::class,
        'virtualAs' => VirtualAsModifier::class,
    ];

    /**
     * @param string $name
     * @param string|bool|int|null $value
     * @return ColumnModifier
     */
    public static function factory(string $name, $value): ColumnModifier
    {
        if ($class = self::MAPPING_CLASS[$name] ?? null) {
            if (is_string($value)) {
                return new $class(new StringColumnModifierArgs($value));
            } elseif (is_bool($value)) {
                return new $class(new BooleanColumnModifierArgs($value));
            } elseif (is_int($value)) {
                return new $class(new IntColumnModifierArgs($value));
            }

            return new $class(null);
        }

        throw new InvalidArgumentException(sprintf('%s column modifier does not exist', $name));
    }
}
