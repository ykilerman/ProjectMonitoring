<style>
    aside {
        border-right: 3px inset #EEE;
        border-radius: 30px;
    }
    aside h3 {
        border: 2px outset #eee;
        border-radius: 5px 20px;
        background-color: #eee;
        padding: 5px 7px;
        font-family: verdana;
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    li a {
        display: block;
        padding: 4px;
        border-left: 5px solid #aaa;
        cursor: pointer;
        margin-bottom: 1px;
        transition: background-color 1s;
    }
    li a:hover {
        background-color: #aaa;
        color: #fff;
        font-weight: bolder;
        text-decoration: none;
    }
</style>
<h3>Project</h3>
<ul>
    <li><a href="{{ url('project') }}">On Going Project</a></li>
    <li><a href="{{ url('project/closed') }}">Closed Project</a></li>
    <li><a href="{{ url('project/archived') }}">Archived Project</a></li>
    <li><a href="{{ url('project/deleted') }}">Deleted Project</a></li>
</ul>
<p></p>
<h3>Report</h3>
<ul>
    <li><a href="{{ url('report') }}">Project Report</a></li>
    <li><a href="{{ url('report/month') }}">Month Report</a></li>
    <li><a href="{{ url('report/quarterly') }}">Quarterly Report</a></li>
    <li><a href="{{ url('report/annual') }}">Annual Report</a></li>
</ul>
<p></p>
<h3>Message</h3>
<ul>
    <li><a href="{{ url('message') }}">Inbox</a></li>
    <li><a href="{{ url('message/outbox') }}">Outbox</a></li>
</ul>
<p></p>
<h3>User</h3>
<ul>
    <li><a href="{{ url('user') }}">View User</a></li>
</ul>
<p></p>
<h3>Setting</h3>
<ul>
    <li><a href="{{ url('changepassword') }}">Change Password</a></li>
    <li><a href="{{ url('logout') }}">Log Out</a></li>
</ul>
