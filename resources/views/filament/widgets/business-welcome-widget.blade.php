@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <x-filament-panels::avatar.user
            size="lg"
            :user="$user"
            loading="lazy"
        />

        <div class="fi-account-widget-main">
            <h2 class="fi-account-widget-heading">
                {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }} {{ filament()->getUserName($user) }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                You are managing: <span class="font-semibold">{{ $this->getTenant()->name }}</span>
            </p>
        </div>

        <form
            action="{{ filament()->getLogoutUrl() }}"
            method="post"
            class="fi-account-widget-logout-form"
        >
            @csrf

            <x-filament::button
                color="gray"
                :icon="\Filament\Support\Icons\Heroicon::ArrowLeftOnRectangle"
                :icon-alias="\Filament\View\PanelsIconAlias::WIDGETS_ACCOUNT_LOGOUT_BUTTON"
                labeled-from="sm"
                tag="button"
                type="submit"
            >
                {{ __('filament-panels::widgets/account-widget.actions.logout.label') }}
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
