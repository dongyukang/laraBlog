<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SimpleBlog</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/articles">Home</a></li>
                @if(is_null($user) == false)
                    @if($isAdmin)
                        <li><a href="/articles/create">New Article</a></li>
                        <li><a href="#">Admin Panel</a></li>
                    @endif
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if(is_null($user))
                    <li><a href="/auth/login">Login</a></li>
                @else
                    <li> <a href="/auth/logout">Logout</a> </li>
                @endif

            </ul>
        </div><!--/.nav-collapse -->
    </div>;
</nav>