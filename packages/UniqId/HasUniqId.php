<?php

namespace Packages\UniqId;

use Illuminate\Database\Eloquent\Model;

trait HasUniqId
{
    abstract public function getUniqIdOptions(): UniqIdOptions;

    protected static function bootHasUniqId(): void
    {
        static::creating(static function (Model $model) {
            $model->generateUniqId();
        });
    }

    protected function generateUniqId(): void
    {
        $options = $this->getUniqIdOptions();
        $field = $options->field ?? 'uid';
        $value = $this->generateUniqueUidValue();

        if (! $this->recordWithSameUidExists($field, $value)) {
            $this->$field = $value;
        } else {
            $this->generateUniqId();
        }
    }

    protected function generateUniqueUidValue(): string
    {
        $options = $this->getUniqIdOptions();

        return substr(
            base_convert(
                sha1(uniqid(time(), false)),
                16,
                36
            ),
            0,
            $options->length ?? 10
        );
    }

    protected function recordWithSameUidExists(string $field, string $value): bool
    {
        $query = static::select($field)->where($field, $value)->withoutGlobalScopes();

        if ($this->usesSoftDeletes()) {
            $query->withTrashed();
        }

        return $query->exists();
    }

    protected function usesSoftDeletes(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this), true);
    }
}
