<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="pull-left">CORE :: HERALD</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{active('events.index')}}"><a href="{{route('events.index')}}">My Events</a></li>
                <li class="{{active('events.all')}}"><a href="{{route('events.all')}}">All Events</a></li>
                <li class="{{active('events.old')}}"><a href="{{route('events.old')}}">Past Events</a></li>
                @can('view', \nullx27\Herald\Models\Setting::class)
                    <li class="{{active('settings.index')}}"><a href="{{route('settings.index')}}">Settings</a></li>
                @endcan

            </ul>

            @if(Auth::check())
                <p class="navbar-text navbar-right">
                    Signed in as <strong>{{ Auth::user()->name }}</strong>
                    (<a href="{{route('auth.logout')}}" class="navbar-link">Logout</a>)
                </p>
            @else
                <p class="navbar-text navbar-right">
                    <a href="{{route('auth.login')}}">Login</a>
                </p>
            @endif
        </div>
    </div>
</div>