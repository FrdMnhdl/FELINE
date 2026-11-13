<?php

namespace App\Http\Requests\Admin;

class UpdateCatRequest extends CatFormRequest
{
    /**
     * Allow keeping the existing photograph when updating cat information.
     *
     * @return array<int, mixed>
     */
    protected function imageRules(): array
    {
        return $this->baseImageRules(required: false);
    }
}
