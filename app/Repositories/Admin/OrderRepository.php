<?php

namespace App\Repositories\Admin;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_number',
        'status',
        'payment_status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ];
    }
}
