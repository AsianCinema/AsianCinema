<div class="ratio-bar">
    <div class="container-fluid">
        <ul class="list-inline">
            <li>
                <a href="{{ route('profile', ['username' => auth()->user()->slug, 'id' => auth()->user()->id]) }}">
                    <span class="badge-user text-bold" style="color:{{ auth()->user()->group->color }};">
                        <strong>{{ auth()->user()->username }}</strong>
                        @if (auth()->user()->getWarning() > 0)
                            <i class="{{ config('other.font-awesome') }} fa-exclamation-circle text-orange" aria-hidden="true" data-toggle="tooltip"
                               data-original-title="@lang('common.active-warning')"></i>
                        @endif
                    </span>
                </a>
            </li>
            <li>
                <span class="badge-user text-bold" style="color:{{ auth()->user()->group->color }}; background-image:{{ auth()->user()->group->effect }};">
                    <i class="{{ auth()->user()->group->icon }}"></i>
                    <strong> {{ auth()->user()->group->name }}</strong>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-arrow-up text-green"></i>
                    {{ auth()->user()->getUploaded() }}
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-arrow-down text-red"></i>
                    {{ auth()->user()->getDownloaded() }}
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-sync-alt text-blue"></i>
                    {{ auth()->user()->getRatioString() }}
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-exchange text-orange"></i>
                    {{ auth()->user()->untilRatio(config('other.ratio')) }}
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-upload text-green"></i>
                        <a href="{{ route('user_active', ['slug' => auth()->user()->slug, 'id' => auth()->user()->id]) }}"
                            title="@lang('torrent.my-active-torrents')">
                            <span class="text-blue"> {{ auth()->user()->getSeeding() }}</span>
                        </a>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-download text-red"></i>
                        <a href="{{ route('user_active', ['slug' => auth()->user()->slug, 'id' => auth()->user()->id]) }}"
                            title="@lang('torrent.my-active-torrents')">
                            <span class="text-blue"> {{ auth()->user()->getLeeching() }}</span>
                        </a>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-exclamation-circle text-orange"></i>
                        <a href="#" title="@lang('torrent.hit-and-runs')">
                            <span class="text-blue"> {{ auth()->user()->getWarning() }}</span>
                        </a>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-coins text-gold"></i>
                        <a href="{{ route('bonus') }}" title="@lang('user.my-bonus-points')">
                            <span class="text-blue"> {{ auth()->user()->getSeedbonus() }}</span>
                        </a>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-star text-gold"></i>
                        <a href="{{ route('profile', ['username' => auth()->user()->username, 'id' => auth()->user()->id]) }}"
                            title="@lang('user.my-fl-tokens')">
                            <span class="text-blue"> {{ auth()->user()->fl_tokens }}</span>
                        </a>
                </span>
            </li>
            <li>
                <span class="badge-user text-bold">
                    <i class="{{ config('other.font-awesome') }} fa-tv-retro" style=" font-size: 18px; color: rgb(255,255,255);"></i>
            @if (auth()->user()->torrent_layout == 1)
                <a href="{{ route('groupings') }}">
                    @elseif (auth()->user()->torrent_layout == 2)
                        <a href="{{ route('cards') }}">
                            @else
                                <a href="{{ route('torrents') }}">
                                    @endif
                                    <span class="text-blue"> @lang('torrent.torrents')</span>
                                </a>
                </span>
            </li>
        </ul>
    </div>
</div>
