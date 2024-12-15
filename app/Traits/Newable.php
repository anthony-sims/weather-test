<?php

declare(strict_types=1);

namespace App\Traits;

trait Newable
{
    /**
     * Create a new class instance.
     *
     * @return self
     */
    public static function new(): self
    {
        return new self();
    }
}
