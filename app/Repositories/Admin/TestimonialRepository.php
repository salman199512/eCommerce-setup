<?php

namespace App\Repositories\Admin;

use App\Models\Testimonial;
use App\Repositories\BaseRepository;

class TestimonialRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'role',
        'content',
        'status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Testimonial::class;
    }
}
