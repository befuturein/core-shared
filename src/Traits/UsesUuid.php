<?php

namespace BeFuture\CoreShared\Traits;

use Illuminate\Support\Str;

trait UsesUuid
{
    public static function bootUsesUuid(): void
    {
        static::creating(function ($model) {
            $column = method_exists($model, 'getUuidColumn')
                ? $model->getUuidColumn()
                : 'uuid';

            if (! $model->{$column}) {
                $model->{$column} = (string) Str::uuid();
            }
        });
    }

    public function getUuidColumn(): string
    {
        return property_exists($this, 'uuidColumn') ? $this->uuidColumn : 'uuid';
    }

    public function getUuid(): ?string
    {
        $column = $this->getUuidColumn();

        return $this->{$column} ?? null;
    }
}
