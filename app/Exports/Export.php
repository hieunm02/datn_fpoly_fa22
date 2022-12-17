<?php

namespace App\Exports;

use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return OrderProduct::select('nameProduct', 'quantity', 'price', 'total', 'user_name')->where('order_id', $this->order_id)->get();
    }
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array
    {
        return [
            'name',
            'quantity',
            "price",
            "total",
            'user_name'
        ];
    }

    public function map($orderProducts): array
    {
        return [
            $orderProducts->nameProduct,
            $orderProducts->quantity,
            $orderProducts->price,
            $orderProducts->total,
            $orderProducts->user_name
        ];
    }
}
