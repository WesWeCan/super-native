<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class ExploreForms extends NativeComponent
{
    public string $name = '';

    public string $email = '';

    public float $slideValue = 0.0;

    public float $slideDebounced = 50.0;

    public float $slideBlur = 25.0;

    public bool $subscribed = true;

    public bool $termsAccepted = false;

    public string $favoriteLanguage = 'PHP';

    public string $pricingPlan = 'pro';

    public bool $notificationsOn = true;

    public function navTitle(): string
    {
        return 'Forms';
    }

    public function render(): View
    {
        return view('native.explore.forms');
    }
}
