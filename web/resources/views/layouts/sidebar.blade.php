<h3>Project</h3>
<ul>
    <li><a href="{{ url('project') }}">All Project</a></li>
    <li><a href="#">On Going Project</a></li>
    <li><a href="#">Closed Project</a></li>
    <li><a href="#">Archive Project</a></li>
</ul>
<p></p>
<h3>Report</h3>
<ul>
    <li><a href="#">Report Per Project</a></li>
    <li><a href="#">Report Per Month</a></li>
    <li><a href="#">Report Per 3 Months</a></li>
    <li><a href="#">Report Per Year</a></li>
</ul>
<p></p>
<h3>Message</h3>
<ul>
    <li><a href="#">Inbox</a></li>
    <li><a href="#">Outbox</a></li>
</ul>
<p></p>
<h3>User</h3>
<ul>
    <li><a href="{{ url('user') }}">View User</a></li>
</ul>
<p></p>
<h3>Setting</h3>
<ul>
    <li><a href="#">{{ Auth::user() ? Auth::user()->name : "" }}</a></li>
    <li><a href="{{ url('logout') }}">Log Out</a></li>
</ul>
