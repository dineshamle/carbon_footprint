<?php

namespace App\Http\Repositories;

use App\Http\Traits\ApiResponse;
use App\Http\Models\CarbonFootprint;
use App\Http\Interfaces\CarbonFootprintInterface;
use DB;

class CarbonFootprintRepository implements CarbonFootprintInterface
{
    // Use ResponseAPI Trait in this repository
    use ApiResponse;

    public function storeCarbonFootprint($data)
    {
        try {
            $model = new CarbonFootprint;
            $model->activity = $data['activity'];
            $model->activity_type = $data['activity_type'];
            $model->country = $data['country'];
            $model->mode = $data['mode'];
            $model->carbon_footprint = $data['carbon_footprint'];
            $model->save();
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}