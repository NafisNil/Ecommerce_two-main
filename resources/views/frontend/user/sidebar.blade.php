<ul>
    <li class="{{ \Request::is('user/dashboard') }}"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('user.order') }}">Orders</a></li>
    <li><a href="downloads.html">Downloads</a></li>
    <li><a href="{{ route('user.address') }}">Addresses</a></li>
    <li><a href="{{ route('user.account') }}">Account Details</a></li>
    <li><a href="{{ route('user.logout') }}">Logout</a></li>
</ul>