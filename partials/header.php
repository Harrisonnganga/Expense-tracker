<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/dashboard"><span>Daily Expense Tracker</span></a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-user"></span> <?php echo $_SESSION['user_name'] ?? 'User'; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/profile"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="/logout"><span class="fa fa-sign-out"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</header>