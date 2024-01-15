<?php

namespace App\Http\Controllers;
use App\Http\Clients\FinancialModelingClient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancialController extends Controller
{
    protected  $financialModelingClient;

    public function __construct(FinancialModelingClient $financialModelingClient)
    {
        $this->financialModelingClient = $financialModelingClient;
    }

    public function index()
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }else{
            $user = auth()->user();
            return Inertia::render('Financial/Index',['user' => $user]);
        }

    }


    public function getCompanyProfile(Request $request, $symbol)
    {
        $cacheKey = 'profile_results_' . $symbol;
        if (Cache::has($cacheKey)) {
            $profile = Cache::get($cacheKey);
        } else {

            $profile = $this->financialModelingClient->getCompanyData($symbol,'profile');

            Cache::put($cacheKey, $profile, now()->addMinutes(60));
        }


        return response()->json($profile);
    }

    public function getCompanyQuote(Request $request, $symbol)
    {
        $cacheKey = 'quote_results_' . $symbol;
        if (Cache::has($cacheKey)) {
            $quote = Cache::get($cacheKey);
        } else {
            $quote = $this->financialModelingClient->getCompanyData($symbol, 'quote');
        }
        return response()->json($quote);
    }

}
