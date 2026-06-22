<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopSettingsModel extends Model
{
    protected $table = 'shop_details';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'shop_name',
        'address',
        'phone',
        'email',
        'gst_number'
    ];

    protected $useTimestamps = false;
}