<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PremiumController extends Controller
{
    public function index()
    {
        return view('premium');
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'plan' => ['required', Rule::in(['monthly', 'yearly'])]
        ]);

        $plan = $validated['plan'];
        $priceId = $plan === 'yearly' ? 'price_1PLepUDrohl8A7ILuWjwKoch' : 'price_1PLepUDrohl8A7ILV7Fnqtpa';

        return $request->user()->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('dashboard') . '?premium=subscribed',
                'cancel_url' => route('premium.index'),
            ]);
    }

    public function billing(Request $request)
    {
        return $request->user()->redirectToBillingPortal();
    }
}
