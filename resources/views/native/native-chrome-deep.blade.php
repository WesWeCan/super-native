<native:scroll-view class="w-full h-full bg-theme-surface">
    <native:column class="w-full p-5 gap-5">

        <native:column class="w-full gap-2">
            <native:text class="text-2xl font-bold">Level {{ $level }}</native:text>
            <native:text class="text-sm text-gray-500">
                You're now {{ $level }} {{ $level === 1 ? 'level' : 'levels' }} deep on the same
                NavigationStack. Each "Go deeper" pushes another copy of this screen with an
                incremented level — proving pushes stack on top of already-stacked pushes.
            </native:text>
        </native:column>

        <native:divider />

        <native:column class="w-full gap-2">
            <native:text class="text-base font-semibold">What to verify</native:text>
            <native:text class="text-sm text-gray-500">• Title updates to "Level {{ $level }}" each push</native:text>
            <native:text class="text-sm text-gray-500">• Edge-swipe / back chevron pops one level at a time</native:text>
            <native:text class="text-sm text-gray-500">• "Pop to root" collapses every level back to /native-chrome</native:text>
            <native:text class="text-sm text-gray-500">• Each level keeps its own tap count after popping back</native:text>
        </native:column>

        <native:column class="w-full p-4 rounded-xl bg-[#F1F5F9] gap-2">
            <native:text class="text-[11] font-semibold text-[#64748B]">TAPS ON THIS LEVEL</native:text>
            <native:text class="text-2xl font-bold text-[#0F172A]">{{ $tapCount }}</native:text>
        </native:column>

        <native:divider />

        <native:column @press="goDeeper" class="w-full px-4 py-3 rounded-xl bg-[#A855F7] items-center">
            <native:text class="text-white font-semibold">Go deeper → Level {{ $level + 1 }}</native:text>
        </native:column>

        <native:column @press="popToRoot" class="w-full px-4 py-3 rounded-xl bg-[#E2E8F0] items-center">
            <native:text class="font-semibold text-[#0F172A]">Pop to root</native:text>
        </native:column>

    </native:column>
</native:scroll-view>
