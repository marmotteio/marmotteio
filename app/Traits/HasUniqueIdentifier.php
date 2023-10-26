<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait HasUniqueIdentifier
{
    protected static function bootHasUniqueIdentifier()
    {
        static::created(function ($model) {
            $model->update([
                'qr_code' => $model->getUniqueIdentifier(),
            ]);
        });
    }

    /**
     * Generate a unique identifier for the model.
     */
    public function getUniqueIdentifier(): string
    {
        $identifier = class_basename($this).'-'.$this->id;

        return base64_encode($identifier);
    }

    public static function decodeUniqueIdentifier(string $encodedIdentifier): ?self
    {
        $decoded = base64_decode($encodedIdentifier);
        [$modelName, $id] = explode('-', $decoded, 2);

        if (class_basename(self::class) !== $modelName) {
            throw new ModelNotFoundException('Model not found for given identifier.');
        }

        return self::find($id);
    }
}
