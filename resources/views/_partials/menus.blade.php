@php
    $routeActive = Route::currentRouteName();
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>
@if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-users text-warning"></i>
            <span class="nav-link-text">Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'user-logs.index' ? 'active' : '' }}" href="{{ route('user-logs.index') }}">
            <i class="fas fa-key text-success"></i>
            <span class="nav-link-text">User Logs</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'timeoff-settings.index' ? 'active' : '' }}"
            href="{{ route('timeoff-settings.index') }}">
            <i class="fas fa-clock text-primary"></i>
            <span class="nav-link-text">Timeoff Settings</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'attendances.index' ? 'active' : '' }}"
            href="{{ route('attendances.index') }}">
            <i class="fas fa-calendar text-danger"></i>
            <span class="nav-link-text">Attendances</span>
        </a>
    </li>
@endif

@if (Auth::user()->role != 'admin')
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'submissions.conditions' ? 'active' : '' }}"
            href="{{ route('submissions.conditions') }}">
            <i class="fas fa-clock text-primary"></i>
            <span class="nav-link-text">Submission Conditional</span>
        </a>
    </li>
@endif

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'submissions.index' ? 'active' : '' }}"
        href="{{ route('submissions.index') }}">
        <i class="fas fa-envelope text-warning"></i>
        <span class="nav-link-text">Submissions</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
        <i class="fas fa-user-tie text-success"></i>
        <span class="nav-link-text">Profile</span>
    </a>
</li>
