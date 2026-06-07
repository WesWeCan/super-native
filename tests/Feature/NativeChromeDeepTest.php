<?php

use App\NativeComponents\NativeChromeDeep;
use Native\Mobile\Edge\CallbackRegistry;
use Native\Mobile\Edge\NativeElementCollector;

/**
 * Build a NativeChromeDeep at a given stack level by running its mount()
 * with the route param the NativeRouter would have injected.
 */
function makeDeep(int $level): NativeChromeDeep
{
    $component = new NativeChromeDeep;
    $component->setParams(['level' => (string) $level]);
    $component->mount();

    return $component;
}

it('reflects the pushed stack level in its title', function () {
    expect(makeDeep(1)->navTitle())->toBe('Level 1');
    expect(makeDeep(4)->navTitle())->toBe('Level 4');
});

it('clamps invalid levels to at least one', function () {
    expect(makeDeep(0)->level)->toBe(1);

    $component = new NativeChromeDeep;
    $component->setParams([]);
    $component->mount();

    expect($component->level)->toBe(1);
});

it('renders the deep blade with the current and next level', function () {
    NativeElementCollector::reset();
    NativeElementCollector::setCallbacks(new CallbackRegistry);

    view('native-chrome-deep', [
        'level' => 3,
        'tapCount' => 0,
    ])->render();

    $tree = NativeElementCollector::collect()->toArray(new CallbackRegistry);
    $json = json_encode($tree);

    expect($json)
        ->toContain('Level 3')
        ->toContain('Level 4');
});

it('tracks taps independently on the level', function () {
    $component = makeDeep(2);

    expect($component->tapCount)->toBe(0);

    $component->bump();
    $component->bump();

    expect($component->tapCount)->toBe(2);
});
