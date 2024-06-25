<nav class="navbar navbar-dark navbar-expand-lg text-light fixed-top bgprimary">
    <div class="container-fluid">
        <!-- Left-aligned logo -->
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-4 w-auto fill-current text-light" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <div class="d-flex justify-content-between w-100">
                <!-- Center-aligned links -->
                <!-- links for student-->
                @if(Auth::user()->isStudent())
                <div class="d-flex justify-content-center flex-grow-1" style="margin-left: -35px;">
                    <ul class="navbar-nav mb-2 mb-lg-0" style="column-gap: 1REM;">
                        <li class="nav-item"><a href="Student" class="nav-link nav-hover fs-6">Home</a></li>
                        <li class="nav-item"><a href="/Rank" class="nav-link nav-hover fs-6">Rank</a></li>
                    </ul>
                </div>
                @endif

                <!-- links for creator-->
                @if(Auth::user()->isCreator())
                <div class="d-flex justify-content-center flex-grow-1" style="margin-left: -35px;">
                    <ul class="navbar-nav mb-2 mb-lg-0" style="column-gap: 1REM;">
                        <li class="nav-item "><a href="CreatorHomepage" class="nav-link nav-hover fs-6">Home</a></li>
                        <li class="nav-item "><a href="Draftpapers" class="nav-link nav-hover fs-6">Drafted Papers</a></li>
                        <li class="nav-item "><a href="#" class="nav-link nav-hover fs-6">Published Papers</a></li>
                    </ul>
                </div>
                @endif


                <!-- Right-aligned profile dropdown -->
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btncolor dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5"></i>
                        </button>
                        <ul class="text-light dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="/profile" class="dropdown-item ps-lg-3">Profile</a>  
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
