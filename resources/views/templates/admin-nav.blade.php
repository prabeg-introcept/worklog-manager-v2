<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.worklogs.index') }}">Worklogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.worklogs.create') }}">Add Worklog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
