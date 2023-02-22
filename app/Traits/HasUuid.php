<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Binds creating/saving events to create UUIDs (and also prevent them from being overwritten).
     *
     * @return void
     */
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });

        static::saving(function ($model) {
            $original_uuid = $model->getOriginal('uuid');

            if ($original_uuid !== $model->uuid) {
                $model->uuid = $original_uuid;
            }
        });
    }

    public function scopeUuid($query, $uuid, $first = true)
    {
        if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $search = $query->where('uuid', $uuid);

        return $first ? $search->firstOrFail() : $search;
    }

    public function scopeIdOrUuId($query, $id_or_uuid, $first = true)
    {
        if (!is_string($id_or_uuid) && !is_numeric($id_or_uuid)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        if (preg_match('/^([0-9]+|[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12})$/', $id_or_uuid) !== 1) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $search = $query->where(function ($query) use ($id_or_uuid) {
            $query->where('id', $id_or_uuid)
                ->orWhere('uuid', $id_or_uuid);
        });

        return $first ? $search->firstOrFail() : $search;
    }
}
