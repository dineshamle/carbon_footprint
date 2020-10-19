<?php

namespace App\Http\Interfaces;


interface CarbonFootprintInterface
{
    /**
     * Get carbon footprint
     * 
     * @method  GET api/carbonfootprint
     * @access  public
     */
    public function storeCarbonFootprint($data);
    
}