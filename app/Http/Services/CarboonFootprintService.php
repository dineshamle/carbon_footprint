<?php

namespace App\Http\Services;

use App\Http\Traits\ApiResponse;
use App\Http\Repositories\CarbonFootprintRepository;
use App\Http\Resources\CarboonFootprint;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use DB;

class CarbonFootprintService
{
    use ApiResponse;

    private $carbonFootprintRepository;

    public function __construct(CarbonFootprintRepository $carbonFootprintRepository)
    {
        $this->carbonFootprintRepository = $carbonFootprintRepository;
    }

    public function getCarbonFootprint($data)
    {
        try {
            //check if result set into cache, then return
            $cacheKey = 'carbonfootprint_'.$data['activity'].'_'.$data['activity_type'].'_'.$data['country'].'_'.$data['mode'];
            if (Cache::has($cacheKey)) {
                $carbonApiResBody = Cache::get($cacheKey);
            }else{
                //call carbon API to get response
                $carbonApiRes = Http::get(env('TRIPTOCARBON_API'), [
                    'activity' => $data['activity'],
                    'activityType' => $data['activity_type'],
                    'country' => $data['country'],
                    'mode' => $data['mode']
                ]);

                $carbonApiResBody = $carbonApiRes->body();
                $carbonApiResArr = json_decode($carbonApiResBody, true);

                // $tmp = new CarboonFootprint($carbonApiResBody);

                //if validation error in  response
                if(isset($carbonApiResArr['errorMessage'])){
                    return $this->error($carbonApiResBody, 400);
                }
                 //cache it for 1 day
                Cache::add($cacheKey, $carbonApiResBody, 86400);

                //store api response along with data in db
                $data['carbon_footprint'] = $carbonApiResArr['carbonFootprint'];
                $this->carbonFootprintRepository->storeCarbonFootprint($data);
            }

            //format response and return
            return $this->success('success', $carbonApiResBody);

        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}