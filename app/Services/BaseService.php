<?php

namespace App\Services;


use http\Exception\RuntimeException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function getModel()
    {
        throw new RuntimeException('Not Implemented');
    }

    /**
     * @return Builder|null
     */
    public function getQuery(): ?Builder
    {
        return $this
            ->getModel()
            ->query();
    }
}
