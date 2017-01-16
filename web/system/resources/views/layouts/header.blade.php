@if(Auth::user())
{{-- header web --}}
<style>
    a.header {
        font-family: lucida sans unicode;
        font-size: 1.1em;
        letter-spacing: 1px;
    }
    ul.topnav {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: rgb(150,0,0);
    }

    ul.topnav li {
        float: left;
        min-width: 160px;
    }
    ul.topnav li.right {
        float: right;
    }
    ul.topnav li a, .drop-btn {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    ul.topnav li a:hover, .drop-down:hover .drop-btn {
        background-color: rgb(55,55,55);
    }

    .drop-down-content {
        z-index: 1000;
        display: none;
        position: absolute;
        background-color: rgb(150,0,0);
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .drop-down-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .drop-down-content a:hover {background-color: #f1f1f1}

    .drop-down:hover .drop-down-content {
        display: block;
    }
    
    @media screen and (max-width: 600px){
        ul.topnav li.right, 
        ul.topnav li {
            float: none;
        }
    }
</style>
<ul class="topnav">
    <li style="margin-left: 5%;"><a class="header" href="{{ url('') }}">PROJECT MONITORING APP</a></li>
    <li class="drop-down right">
        <a href="#" class="drop-btn">Setting</a>
        <div class="drop-down-content">
            <a href="{{ url('user') }}">View User</a>
            <a href="{{ url('changepassword') }}">Change Password</a>
            <a href="{{ url('logout') }}">Log Out</a>
        </div>
    </li>
    <li class="drop-down right">
        <a href="#" class="drop-btn">Report</a>
        <div class="drop-down-content">
            <a href="{{ url('report') }}">Per Project Report</a>
            <a href="{{ url('report/month') }}">Monthly Report</a>
            <a href="{{ url('report/quarterly') }}">Quarterly Report</a>
            <a href="{{ url('report/annual') }}">Annual Report</a>
        </div>
    </li>
    <li class="drop-down right">
        <a href="#" class="drop-btn">Project</a>
        <div class="drop-down-content">
            <a href="{{ url('project') }}">On Going Project</a>
            <a href="{{ url('project/closed') }}">Closed Project</a>
            <a href="{{ url('project/archived') }}">Archived Project</a>
            <a href="{{ url('project/deleted') }}">Deleted Project</a>
        </div>
    </li>
    <li class="right"><a href="{{ url('notification') }}">Notification</a></li>
</ul>
{{--<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand header" href="{{ URL('/') }}">Project Monitoring App</a>
    </div>
    @if(Auth::user())
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('notification') }}">Notification</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Project <i class="glyphicon glyphicon-menu-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('project') }}">On Going Project</a></li>
                        <li><a href="{{ url('project/closed') }}">Closed Project</a></li>
                        <li><a href="{{ url('project/archived') }}">Archived Project</a></li>
                        <li><a href="{{ url('project/deleted') }}">Deleted Project</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <i class="glyphicon glyphicon-menu-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('report') }}">Per Project Report</a></li>
                        <li><a href="{{ url('report/month') }}">Month Report</a></li>
                        <li><a href="{{ url('report/quarterly') }}">Quarterly Report</a></li>
                        <li><a href="{{ url('report/annual') }}">Annual Report</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <i class="glyphicon glyphicon-menu-down"></i></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->position == 'Project Admin')
                            <li><a href="{{ url('user') }}">View User</a></li>
                        @endif
                        <li><a href="{{ url('changepassword') }}">Change Password</a></li>
                        <li><a href="{{ url('logout') }}">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif    
</nav>--}}
<script>
    ajaxLoad("{{ url('menu/notif') }}","notif");
</script>
@endif
