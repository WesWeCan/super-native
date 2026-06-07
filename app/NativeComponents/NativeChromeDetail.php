<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\Layouts\Builders\NavAction;
use Native\Mobile\Edge\Layouts\Builders\NavBarOptions;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

/**
 * Pushed detail screen — sits on top of `NativeChromeDemo` in the
 * NavigationStack to exercise multi-level stack behavior:
 *
 *  1. User on /native-chrome taps "View detail" → PHP navigate() →
 *     publishes new tree at /native-chrome/detail.
 *  2. NavigationCoordinator's `receive()` sees new URI, appends to path.
 *  3. SwiftUI NavigationStack animates the push.
 *  4. User edge-swipes back → SwiftUI shrinks path → coordinator detects
 *     and fires sendSystemBackEvent → PHP back() → re-publishes
 *     /native-chrome → coordinator no-ops since the URI matches root.
 *  5. User sees /native-chrome again with state preserved (counter etc.).
 */
class NativeChromeDetail extends NativeComponent
{
    public function navTitle(): string
    {
        return 'Detail';
    }

    public function navigationOptions(): ?NavBarOptions
    {
        return NavBarOptions::make()
            ->subtitle('Pushed via NavigationStack')
            ->action(NavAction::make('star')->icon('star')->press('toggleStar'));
    }

    public bool $starred = false;

    public function toggleStar(): void
    {
        $this->starred = ! $this->starred;
    }

    /** Push the first recursive deep level — stack on top of this stacked screen. */
    public function pushDeeper(): void
    {
        $this->navigate('/native-chrome/deep/1')
            ->transition(Transition::SlideFromRight);
    }

    public function render(): View
    {
        return view('native-chrome-detail');
    }
}
