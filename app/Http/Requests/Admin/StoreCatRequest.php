<?php

namespace App\Http\Requests\Admin;

class StoreCatRequest extends CatFormRequest
{
    /**
     * Require a valid cat photograph when creating a new record.
     *
     * @return array<int, mixed>
     */
    protected function imageRules(): array
    {
        return $this->baseImageRules(required: true);
    }
}
