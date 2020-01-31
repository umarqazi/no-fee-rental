
<div class="avtar">
    <img src="{{ Storage::url(mySelf()->profile_image ?? DUI) }}" alt="" />
    <span>{{ mySelf()->first_name.' '.mySelf()->last_name }} <i class="fa fa-chevron-down"></i></span>
    <ul>
        <li><a href="{{ route(whoAmI().'.index') }}">Dashboard </a></li>
        <li><a href="{{ route(whoAmI().'.showProfile') }}">Profile Setting </a></li>
        <li><a href="{{ route(whoAmI().'.logout') }}">Log Out </a></li>
    </ul>
</div>
