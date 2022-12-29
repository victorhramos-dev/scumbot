<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user">
            	<a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                    	<span class="user-name font-weight-bolder">{{ $loggedUser->name }}</span>
                    	<span class="user-status">Administrador</span>
                    </div>

                    <span class="avatar">
                    	<img class="round" src="https://pngimage.net/wp-content/uploads/2018/05/avatar-png-icon-4.png" height="40" width="40">
                    	<span class="avatar-status-online"></span>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                	<a class="dropdown-item" href="{{ route('admin.profile') }}">
                		<i class="mr-50" data-feather="user"></i> @lang('dictionary.profile')
                	</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item dialog-confirm" href="{{ route('admin.logout') }}">
                    	<i class="mr-50" data-feather="power"></i> @lang('dictionary.logout')
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>