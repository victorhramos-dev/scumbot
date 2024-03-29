<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <span class="brand-logo">
                        <img src="{{ asset('img/logo-white.png') }}" class="navbar-brand-img">
                    </span>
                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation--main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header">
                <span>Gerenciamento</span><i data-feather="more-horizontal"></i>
            </li>

            @shield('player.index')
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="{{ route('admin.players.index') }}">
                        <i data-feather="users"></i> <span class="menu-title text-truncate">@lang('dictionary.players')</span>
                    </a>
                </li>
            @endshield

            @shield('drone.index')
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="{{ route('admin.drones.index') }}">
                        <i class="fas fa-robot"></i> <span class="menu-title text-truncate">@lang('dictionary.drones')</span>
                    </a>
                </li>
            @endshield

            <li class="navigation-header">
                <span>Sistema</span><i data-feather="more-horizontal"></i>
            </li>

            @shield('administrator.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.administrators.index') }}">
                        <i class="fas fa-fw fa-user-shield text-red"></i> <span class="menu-title text-truncate">@lang('dictionary.administrators')</span>
                    </a>
                </li>
            @endshield

            @shield('settings.general')
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="{{ route('admin.settings.index') }}">
                        <i data-feather='sliders'></i> <span class="menu-title text-truncate">@lang('dictionary.settings')</span>
                    </a>
                </li>
            @endshield
        </ul>
    </div>
</div>