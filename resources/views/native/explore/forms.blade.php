<scroll-view class="w-full bg-theme-background">
    <column class="w-full p-5 gap-5">

        {{-- TEXT INPUT — OUTLINED --}}
        <text class="text-lg font-semibold text-theme-on-background">Text Input — Outlined</text>

        <outlined-text-input class="w-full" label="Name"     placeholder="Jane Doe" native:model.blur="name" />
        <outlined-text-input class="w-full" label="Email"    placeholder="you@example.com" keyboard="email" leading-icon="email" native:model.blur="email" />
        <outlined-text-input class="w-full" label="Password" placeholder="••••••••" secure leading-icon="lock" />
        <outlined-text-input class="w-full" label="Bio"      placeholder="Tell us about yourself..." multiline :max-lines="4" />

        <text class="text-sm text-theme-on-surface-variant">Name: {{ $name }} · Email: {{ $email }}</text>

        {{-- TEXT INPUT — FILLED --}}
        <text class="text-lg font-semibold mt-2 text-theme-on-background">Text Input — Filled</text>

        <filled-text-input class="w-full" label="Search" placeholder="Search anything..." leading-icon="search" />
        <filled-text-input class="w-full" label="Price"  prefix="$" suffix=".00" keyboard="decimal" />

        <divider class="my-2" />

        {{-- SLIDER --}}
        <text class="text-lg font-semibold text-theme-on-background">Slider</text>

        <column class="gap-1">
            <text class="text-sm text-theme-on-surface-variant">On release (blur)</text>
            <slider native:model.blur="slideBlur" :min="0" :max="100" class="w-full"/>
            <text class="text-[20] text-theme-on-background">Value: {{ $slideBlur }}</text>
        </column>

        <column class="gap-1">
            <text class="text-sm text-theme-on-surface-variant">Debounced (150ms)</text>
            <slider native:model.debounce.150ms="slideDebounced" :min="0" :max="100" class="w-full"/>
            <text class="text-[20] text-theme-on-background">Value: {{ $slideDebounced }}</text>
        </column>

        <column class="gap-1">
            <text class="text-sm text-theme-on-surface-variant">Live (every drag tick)</text>
            <slider native:model.live="slideValue" :min="0" :max="100" class="w-full"/>
            <text class="text-[20] text-theme-on-background">Value: {{ $slideValue }}</text>
        </column>

        <divider class="my-2" />

        {{-- TOGGLE --}}
        <text class="text-lg font-semibold text-theme-on-background">Toggle</text>
        <toggle native:model="notificationsOn" label="Notifications"           class="w-full"/>
        <toggle native:model="subscribed"      label="Subscribe to newsletter" class="w-full"/>
        <toggle :value="true" label="Disabled (always on)" disabled            class="w-full"/>

        <divider class="my-2" />

        {{-- CHECKBOX --}}
        <text class="text-lg font-semibold text-theme-on-background">Checkbox</text>
        <checkbox native:model="subscribed"    label="Subscribe to newsletter"        class="w-full"/>
        <checkbox native:model="termsAccepted" label="I accept the terms and conditions" class="w-full"/>
        <text class="text-sm text-theme-on-surface-variant">
            subscribed: {{ $subscribed ? 'yes' : 'no' }} · terms: {{ $termsAccepted ? 'yes' : 'no' }}
        </text>

        <divider class="my-2" />

        {{-- SELECT --}}
        <text class="text-lg font-semibold text-theme-on-background">Select</text>
        <select
            native:model="favoriteLanguage"
            label="Favorite language"
            placeholder="Pick one..."
            :options="['PHP', 'Swift', 'Kotlin', 'TypeScript', 'Rust', 'Go']"
            class="w-full"
        />
        <text class="text-sm text-theme-on-surface-variant">Selected: {{ $favoriteLanguage }}</text>

        <divider class="my-2" />

        {{-- RADIO GROUP --}}
        <text class="text-lg font-semibold text-theme-on-background">Radio Group</text>
        <radio-group native:model="pricingPlan" label="Pricing plan" class="w-full">
            <radio value="free" label="Free — $0/mo" />
            <radio value="pro"  label="Pro — $19/mo" />
            <radio value="team" label="Team — $49/mo" />
        </radio-group>
        <text class="text-sm text-theme-on-surface-variant">Chosen: {{ $pricingPlan }}</text>

    </column>
</scroll-view>
