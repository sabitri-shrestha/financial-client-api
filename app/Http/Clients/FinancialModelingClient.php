<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class FinancialModelingClient
{

    protected $baseUrl = 'https://financialmodelingprep.com/api/v3/';

    public function getCompanyData($symbol, $module)
    {
        $response = Http::get("{$this->baseUrl}/{$module}/{$symbol}?apikey=" . config('services.financial_modeling.api_key'));

        return $response->json();
    }
}
