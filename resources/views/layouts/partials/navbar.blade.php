<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top d-print-none" id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo">@yield('title')</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            Stats
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="accountLinkOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountLinkOptions">
                        <a class="dropdown-item" href="{{ url('/') }}">Home</a>
{{--                        <a class="dropdown-item" href="{{ url('my-profile') }}">My Profile</a>--}}
                        {{--<a class="dropdown-item" href="{{ url('edit-profile') }}">Edit Profile</a>--}}
                        <a class="dropdown-item portal-logout" href="{{url('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('js')
    <script>
        $('li.child.active:first').parents('li').addClass('active');
        $('li.child.active:first').parents('div.collapse').addClass('in');

        $('.portal-logout').on('click', function() {
            $('#portal-logout-form').submit();
        });
    </script>
@endpush
