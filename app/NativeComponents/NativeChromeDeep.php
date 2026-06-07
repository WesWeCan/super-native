<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\Layouts\Builders\NavAction;
use Native\Mobile\Edge\Layouts\Builders\NavBarOptions;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

/**
 * Recursive deep-stack screen — pushes a copy of itself with an
 * incrementing `level` so you can pile NavigationStack pushes
 * arbitrarily deep (stack on stacked on stacked…).
 *
 * Entry point is `NativeChromeDetail::pushDeeper()`, which pushes
 * `/native-chrome/deep/1`. From any level N, "Go deeper" pushes
 * `/native-chrome/deep/(N+1)`; "Pop to root" navigates straight back
 * to `/native-chrome`, collapsing every intermediate level at once.
 */
class NativeChromeDeep extends NativeComponent
{
    public int $level = 1;

    public int $tapCount = 0;

    public function mount(): void
    {
        $this->level = max(1, (int) $this->param('level', 1));
    }

    public function navTitle(): string
    {
        return "Level {$this->level}";
    }

    public function navigationOptions(): ?NavBarOptions
    {
        return NavBarOptions::make()
            ->subtitle("{$this->level} levels deep")
            ->action(NavAction::make('bump')->icon('plus.circle')->press('bump'));
    }

    public function bump(): void
    {
        $this->tapCount++;
    }

    /** Push the next level — the recursive "stack on stacked" step. */
    public function goDeeper(): void
    {
        $this->navigate('/native-chrome/deep/'.($this->level + 1))
            ->transition(Transition::SlideFromRight);
    }

    /** Collapse the entire stack back down to the root demo screen. */
    public function popToRoot(): void
    {
        $this->navigate('/native-chrome');
    }

    public function render(): View
    {
        return view('native-chrome-deep');
    }
}
