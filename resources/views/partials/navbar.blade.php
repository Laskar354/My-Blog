{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand fst-italic fw-bold" href="/">My-Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link {{ Request::is("/") ? "active fw-bold": "" }} " aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is("about") ? "active fw-bold": "" }} " href="/about">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is("posts*") ? "active fw-bold": "" }} " href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is("categories*") ? "active fw-bold": "" }} " href="/categories">Categories</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <p class="d-inline"><i class="bi bi-person-circle"></i>  {{auth()->user()->name}}</p>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="/logout" method="post">
                    @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</li></button>
                    </form>
                </ul>
            </li>
            @else
                <li class="nav-item">
                    <a href="/login" class="nav-link"> <i class="bi bi-arrow-right-square"></i> Sign-in </a>
                </li>
            @endauth
            </ul>


        </div>
    </div>
</nav>