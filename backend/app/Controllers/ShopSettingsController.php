<?php

namespace App\Controllers;

use App\Models\ShopSettingsModel;

class ShopSettingsController extends BaseController
{
    public function getShopSettings()
    {
        $model = new ShopSettingsModel();

        $shop = $model->first();

        if (!$shop) {

            return $this->response->setJSON([
                'shop_name' => '',
                'address' => '',
                'phone' => '',
                'email' => '',
                'gst_number' => ''
            ]);
        }

        return $this->response->setJSON($shop);
    }

    public function saveShopSettings()
    {
        $model = new ShopSettingsModel();

        $data = $this->request->getJSON(true);

        $existing = $model->first();

        if ($existing) {

            $model->update(
                $existing['id'],
                $data
            );

        } else {

            $model->insert($data);
        }

        return $this->response->setJSON([
            'message' => 'Shop details saved successfully'
        ]);
    }
}