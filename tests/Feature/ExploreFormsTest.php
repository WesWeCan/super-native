<?php

use App\NativeComponents\ExploreForms;
use Native\Mobile\Edge\CallbackRegistry;
use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeElementCollector;

/**
 * Render the Forms demo blade through the NativeElementCollector (the pure-PHP
 * render path, no native C extension) and collect every element type emitted.
 *
 * @return list<string>
 */
function renderFormsTypes(): array
{
    $component = new ExploreForms;

    NativeElementCollector::reset();
    NativeElementCollector::setCallbacks(new CallbackRegistry);

    view('native.explore.forms', [
        'name' => $component->name,
        'email' => $component->email,
        'slideValue' => $component->slideValue,
        'slideDebounced' => $component->slideDebounced,
        'slideBlur' => $component->slideBlur,
        'subscribed' => $component->subscribed,
        'termsAccepted' => $component->termsAccepted,
        'favoriteLanguage' => $component->favoriteLanguage,
        'pricingPlan' => $component->pricingPlan,
        'notificationsOn' => $component->notificationsOn,
    ])->render();

    $tree = NativeElementCollector::collect();

    $types = [];
    $walk = function (Element $element) use (&$walk, &$types): void {
        $types[] = $element->getType();
        foreach ($element->getChildren() as $child) {
            $walk($child);
        }
    };
    $walk($tree);

    return $types;
}

it('renders every form control in the demo', function () {
    $types = renderFormsTypes();

    expect($types)->toContain(
        'outlined_text_input',
        'filled_text_input',
        'slider',
        'toggle',
        'checkbox',
        'select',
        'radio_group',
        'radio',
    );
});

it('emits all three radio options inside the group', function () {
    $types = renderFormsTypes();

    expect(collect($types)->filter(fn ($type) => $type === 'radio')->count())->toBe(3);
});
