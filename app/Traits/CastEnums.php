<?php

namespace App\Traits;

trait CastEnums
{
    /**
     * Automatically cast enum fields based on model $casts property.
     * This is useful for models that use enums and need to be casted to the correct type.
     */
    public function castEnums(array $attributes): array
    {
        $casts = $this->getCasts();

        foreach ($casts as $key => $type) {
            if (isset($attributes[$key]) && enum_exists($type)) {
                $attributes[$key] = $type::from($attributes[$key]);
            }
        }

        return $attributes;
    }
}
