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
        $profile = $this->financialModelingClient->getCompanyProfile($symbol,'profile');

        return response()->json($profile);
    }

    public function getCompanyQuote(Request $request, $symbol)
    {
        $quote = $this->financialModelingClient->getCompanyData($symbol,'quote');

        return response()->json($quote);
    }

}
