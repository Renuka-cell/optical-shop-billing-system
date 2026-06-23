<?php

namespace App\Models;

use CodeIgniter\Model;


class InvoiceModel extends Model
{
    protected $table = 'invoices';

    protected $primaryKey = 'id';

    protected $allowedFields = [

    'customer_id',
    'created_by',
    'invoice_number',

    'frame_type',
    'frame_quantity',
    'frame_price',

    'glass_type',
    'glass_quantity',
    'glass_price',

    'lens_type',

    'total_amount',
    'paid_amount',
    'due_amount',

    'payment_status',
    'payment_mode',

    'right_sph',
    'right_cyl',
    'right_axis',
    'right_add',

    'left_sph',
    'left_cyl',
    'left_axis',
    'left_add',

    'date'
];
}