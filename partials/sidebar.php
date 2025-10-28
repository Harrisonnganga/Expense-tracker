<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="<?php echo asset('images/user.png'); ?>" class="img-responsive" alt="User Image">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $_SESSION['user_name'] ?? 'User'; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li class="active"><a href="/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li><a href="/expenses/add"><em class="fa fa-plus-circle">&nbsp;</em> Add Expense</a></li>
        <li><a href="/expenses"><em class="fa fa-list-alt">&nbsp;</em> Manage Expenses</a></li>
        <li><a href="/reports"><em class="fa fa-bar-chart">&nbsp;</em> Reports</a></li>
        <li><a href="/profile"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
        <li><a href="/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div>