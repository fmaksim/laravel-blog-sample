@include('blog.partials.header')

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}"><img src="/img/logo.png" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a href="{{route('home')}}">Homepage</a></li>
                </ul>

                <ul class="nav navbar-nav text-uppercase pull-right">
                    @if(Auth::check())
                        <li><a href="contact.html">My profile</a></li>
                        <li>
                            <form class="logout-form" action="{{route('logout')}}" method="POST">
                                {{csrf_field()}}
                                <a href="#" onclick="this.parentNode.submit();"> Logout</a>
                            </form>
                        </li>
                    @else
                        <li><a href="{{route('register.form')}}">Register</a></li>
                        <li><a href="{{route('login.form')}}">Login</a></li>
                    @endif
                </ul>

            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')

@include('blog.partials.footer')

<!-- js files -->
<script type="text/javascript" src="/js/blog.js"></script>
</body>
</html>