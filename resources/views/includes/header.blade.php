<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="{{ url('/#page-top') }}">
        <span class="d-block d-lg-none">Nikolius Lau</span>
        <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{url('/')}}/assets/img/profile.jpg" alt="..." /></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/#about') }}">About</a></li>
            <!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/#experience') }}">Experience</a></li>-->
            <!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/#education') }}">Education & Skills</a></li>-->
            <!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('blog') }}">Blog</a></li>-->

            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('funproj') }}">Fun Projects</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('diaryprog') }}">Diary Programmer</a></li>

            @if( Auth::check() )
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('adm_manage_data') }}">Manage Data</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('logout') }}">Logout</a></li>
            @else
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
            @endif
            
        </ul>
    </div>
    <div class="footer-copy">&copy Nikolius 2020 - {{ date('Y') }}</div>
</nav>