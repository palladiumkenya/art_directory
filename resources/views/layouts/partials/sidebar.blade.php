<div class="sidebar" data-color="{{ $btn_color }}" data-background-color="{{ $color }}" data-image="{{ $sidebar_image }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{url('/')}}" class="simple-text logo-mini">
            AD
        </a>
        <a href="{{url('/')}}" class="simple-text logo-normal">
            ART DIRECTORY
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{is_null( auth()->user()->photo) ?  $avatar :  auth()->user()->photo }}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                <span>
                    <small>{{ auth()->user()->name }}</small>
                    <b class="caret"></b>
                </span>
                </a>
                <a class=" col-8 offset-2">
                    <span class="badge badge-secondary" style="font-size:9px;">{{auth()->user()->role->name}}</span>
                </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
{{--                        <li class="nav-item {{ ('my-profile' == $current_route->uri) ? 'active child' : '' }} ">--}}
{{--                            <a class="nav-link" href="{{ url('my-profile') }}">--}}
{{--                                <span class="sidebar-mini"> MP </span>--}}
{{--                                <span class="sidebar-normal"> My Profile </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item {{ ('edit-profile' == $current_route->uri) ? 'active child' : '' }}">--}}
{{--                            <a class="nav-link" href="{{ url('edit-profile') }}">--}}
{{--                                <span class="sidebar-mini"> EP </span>--}}
{{--                                <span class="sidebar-normal"> Edit Profile </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('logout')}}">
                                <span class="sidebar-mini"> L </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item {{ ('/' == $current_route->uri) ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>


{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link " data-toggle="collapse"  href="#directory">--}}
{{--                    <i class="material-icons">receipt</i>--}}
{{--                    <p> Questionnaires--}}
{{--                        <b class="caret"></b>--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--                <div class="collapse" id="directory">--}}
{{--                    <ul class="nav">--}}
{{--                        <li class="nav-item {{ ('directory' == $current_route->uri) ? 'active child' : '' }} ">--}}
{{--                            <a class="nav-link" href="{{url('directory')}}">--}}
{{--                                <span class="sidebar-mini"> Q </span>--}}
{{--                                <span class="sidebar-normal"> All Questionnaires </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item {{ ('questions' == $current_route->uri) ? 'active child' : '' }} ">--}}
{{--                            <a class="nav-link" href="{{url('questions')}}">--}}
{{--                                <span class="sidebar-mini"> Q </span>--}}
{{--                                <span class="sidebar-normal"> s </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}


            <li class="nav-item {{ ('facilities' == $current_route->uri) ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('/facilities')}}">
                    <i class="material-icons">local_hospital</i>
                    <p> Facilities </p>
                </a>
            </li>

            <li class="nav-item {{ ('messages/incoming' == $current_route->uri) ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('/messages/incoming')}}">
                    <i class="material-icons">chat</i>
                    <p> Incoming Messages </p>
                </a>
            </li>

            <li class="nav-item {{ ('messages/outgoing' == $current_route->uri) ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('/messages/outgoing')}}">
                    <i class="material-icons">chat_bubble_outline</i>
                    <p> Outgoing Messages </p>
                </a>
            </li>

           @if(auth()->user()->user_group == 1)  {{--sysadmin--}}





            <li class="nav-item ">
                <a class="nav-link " data-toggle="collapse"  href="#um">
                    <i class="material-icons">person</i>
                    <p> User Management
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="um">
                    <ul class="nav">
{{--                        <li class="nav-item {{ ('user_roles' == $current_route->uri) ? 'active child' : '' }} ">--}}
{{--                            <a class="nav-link" href="{{url('user_roles')}}">--}}
{{--                                <span class="sidebar-mini"> UR </span>--}}
{{--                                <span class="sidebar-normal"> User Roles </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item {{ ('users' == $current_route->uri) ? 'active child' : '' }} ">
                            <a class="nav-link" href="{{url('users')}}">
                                <span class="sidebar-mini"> AU </span>
                                <span class="sidebar-normal"> All Users </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif






            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" data-toggle="collapse" href="#componentsExamples">--}}
                    {{--<i class="material-icons">apps</i>--}}
                    {{--<p> Components--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="componentsExamples">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" data-toggle="collapse" href="#componentsCollapse">--}}
                                {{--<span class="sidebar-mini"> MLT </span>--}}
                                {{--<span class="sidebar-normal"> Multi Level Collapse--}}
                      {{--<b class="caret"></b>--}}
                    {{--</span>--}}
                            {{--</a>--}}
                            {{--<div class="collapse" id="componentsCollapse">--}}
                                {{--<ul class="nav">--}}
                                    {{--<li class="nav-item ">--}}
                                        {{--<a class="nav-link" href="#0">--}}
                                            {{--<span class="sidebar-mini"> E </span>--}}
                                            {{--<span class="sidebar-normal"> Example </span>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/buttons.html">--}}
                                {{--<span class="sidebar-mini"> B </span>--}}
                                {{--<span class="sidebar-normal"> Buttons </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/grid.html">--}}
                                {{--<span class="sidebar-mini"> GS </span>--}}
                                {{--<span class="sidebar-normal"> Grid System </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/panels.html">--}}
                                {{--<span class="sidebar-mini"> P </span>--}}
                                {{--<span class="sidebar-normal"> Panels </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/sweet-alert.html">--}}
                                {{--<span class="sidebar-mini"> SA </span>--}}
                                {{--<span class="sidebar-normal"> Sweet Alert </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/notifications.html">--}}
                                {{--<span class="sidebar-mini"> N </span>--}}
                                {{--<span class="sidebar-normal"> Notifications </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/icons.html">--}}
                                {{--<span class="sidebar-mini"> I </span>--}}
                                {{--<span class="sidebar-normal"> Icons </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/components/typography.html">--}}
                                {{--<span class="sidebar-mini"> T </span>--}}
                                {{--<span class="sidebar-normal"> Typography </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" data-toggle="collapse" href="#formsExamples">--}}
                    {{--<i class="material-icons">content_paste</i>--}}
                    {{--<p> Forms--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="formsExamples">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/forms/regular.html">--}}
                                {{--<span class="sidebar-mini"> RF </span>--}}
                                {{--<span class="sidebar-normal"> Regular Forms </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/forms/extended.html">--}}
                                {{--<span class="sidebar-mini"> EF </span>--}}
                                {{--<span class="sidebar-normal"> Extended Forms </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/forms/validation.html">--}}
                                {{--<span class="sidebar-mini"> VF </span>--}}
                                {{--<span class="sidebar-normal"> Validation Forms </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/forms/wizard.html">--}}
                                {{--<span class="sidebar-mini"> W </span>--}}
                                {{--<span class="sidebar-normal"> Wizard </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" data-toggle="collapse" href="#tablesExamples">--}}
                    {{--<i class="material-icons">grid_on</i>--}}
                    {{--<p> Tables--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="tablesExamples">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/tables/regular.html">--}}
                                {{--<span class="sidebar-mini"> RT </span>--}}
                                {{--<span class="sidebar-normal"> Regular Tables </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/tables/extended.html">--}}
                                {{--<span class="sidebar-mini"> ET </span>--}}
                                {{--<span class="sidebar-normal"> Extended Tables </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/tables/datatables.net.html">--}}
                                {{--<span class="sidebar-mini"> DT </span>--}}
                                {{--<span class="sidebar-normal"> DataTables.net </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" data-toggle="collapse" href="#mapsExamples">--}}
                    {{--<i class="material-icons">place</i>--}}
                    {{--<p> Maps--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="mapsExamples">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/maps/google.html">--}}
                                {{--<span class="sidebar-mini"> GM </span>--}}
                                {{--<span class="sidebar-normal"> Google Maps </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/maps/fullscreen.html">--}}
                                {{--<span class="sidebar-mini"> FSM </span>--}}
                                {{--<span class="sidebar-normal"> Full Screen Map </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="../examples/maps/vector.html">--}}
                                {{--<span class="sidebar-mini"> VM </span>--}}
                                {{--<span class="sidebar-normal"> Vector Map </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="../examples/widgets.html">--}}
                    {{--<i class="material-icons">widgets</i>--}}
                    {{--<p> Widgets </p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="../examples/charts.html">--}}
                    {{--<i class="material-icons">timeline</i>--}}
                    {{--<p> Charts </p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="../examples/calendar.html">--}}
                    {{--<i class="material-icons">date_range</i>--}}
                    {{--<p> Calendar </p>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>





    </div>
</div>

{{--<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">--}}
    {{--<!----}}
{{--Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"--}}
{{--Tip 2: you can also add an image using data-image tag--}}
{{--Tip 3: you can change the color of the sidebar with data-background-color="white | black"--}}
{{---->--}}
    {{--<div class="logo">--}}
        {{--<a href="{{ url('/') }}" class="simple-text">--}}
            {{--{{ config('app.name') }}--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="logo logo-mini">--}}
        {{--<a href="http://www.creative-tim.com" class="simple-text">--}}
            {{--Ct--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-wrapper">--}}
        {{--<div class="user">--}}
            {{--<div class="photo">--}}
                {{--<img src="{{ $avatar }}" id="avatar-img"/>--}}
            {{--</div>--}}
            {{--<div class="info">--}}
                {{--<a data-toggle="collapse" href="#collapseExample" class="collapsed">--}}
                    {{--<p><a href="{{ url('merchant/profile') }}">{{ $user_name }}</a></p>--}}
                    {{--<b class="caret"></b>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="collapseExample">--}}
                    {{--<ul class="nav">--}}
                        {{--<li>--}}
                            {{--<a href="#">My Profile</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">Edit Profile</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#" class="portal-logout">Logout</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<form id="portal-logout-form" action="{{ url('logout') }}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<ul class="nav">--}}
            {{--@if(count($menu))--}}
                {{--@foreach($menu as $item)--}}

                    {{--@if(!$item->parent)--}}
                        {{--<li class="{{ ($item->url == $current_route->uri) ? 'active' : '' }}">--}}
                    {{--@else--}}
                        {{--<li>--}}
                    {{--@endif--}}

                        {{--<a {{ ($item->parent) ? 'data-toggle=collapse' : '' }} href="{{ ($item->parent) ? $item->url . $item->id : url($item->url) }}">--}}
                            {{--<i class="material-icons">{{ $item->icon }}</i>--}}
                            {{--<p>--}}
                                {{--{{ $item->title }} {!! ($item->parent) ? '<b class="caret"></b>' : '' !!}</p>--}}
                        {{--</a>--}}
                        {{--@if($item->parent)--}}
                            {{--<div class="collapse" id="{{ $item->id }}">--}}
                                {{--<ul class="nav">--}}
                                    {{--@if(count($item->children))--}}
                                        {{--@foreach($item->children as $child)--}}
                                            {{--<li class="{{ ($current_route->uri == $child->url) ? 'active child' : '' }}">--}}
                                                {{--<a href="{{ url($child->url) }}"> {{ $child->title }} </a>--}}
                                            {{--</li>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</li>--}}

                {{--@endforeach--}}
            {{--@endif--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
@push('js')
    <script>
        $('li.child.active:first').parents('li').addClass('active');
        $('li.child.active:first').parents('div.collapse').addClass('show');

        $('.portal-logout').on('click', function() {
            $('#portal-logout-form').submit();
        });

        $(function() {
            $('#avatar-img').on('click', function() {
                location.href = '{{ url('merchant/profile') }}'
            });
        });
    </script>
@endpush
