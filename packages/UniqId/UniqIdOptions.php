<?php

namespace Packages\UniqId;

final class UniqIdOptions
{
    protected readonly string $field;

    protected readonly int $length;

    public static function make(): UniqIdOptions
    {
        return new self();
    }

    public function saveTo(string $field = 'uid'): UniqIdOptions
    {
        $this->field = $field;

        return $this;
    }

    public function length(int $length = 10): UniqIdOptions
    {
        $this->length = $length;

        return $this;
    }
}
