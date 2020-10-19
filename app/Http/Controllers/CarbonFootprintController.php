<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CarbonFootprintService;
use App\Http\Traits\ApiResponse;

class CarbonFootprintController
{
	use ApiResponse;

	private $carbonFootprintService;

	public function __construct(CarbonFootprintService $carbonFootprintService)
	{
		$this->carbonFootprintService = $carbonFootprintService;
	}

	public function show(Request $request)
	{
		$data = $request->query();

		$validator = \Validator::make($data, [
			'activity' => 'required|numeric|min:0|not_in:0',
			'activity_type' => 'required',
			'country' => 'required',
			'mode' => 'required',
		]);

		if ($validator->fails()) {
			return $this->error($validator->errors(), 400);
		}
		
		return $this->carbonFootprintService->getCarbonFootprint($data);
	}
}
