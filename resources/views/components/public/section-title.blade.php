@props([
    'title',
    'subtitle' => null,
    'actionText' => null,
    'actionUrl' => null,
])

<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    @if($actionText && $actionUrl)
        <a href="{{ $actionUrl }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
            {{ $actionText }}
        </a>
    @endif
</div>