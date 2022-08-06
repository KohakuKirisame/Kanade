<nav class="navbar navbar-dark bg-primary navbar-expand-lg shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/storage/kanade/logo.svg" style="height:64px;" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/">主面板</a>
                    </li>
                    @if(!(new \App\Models\Admin())->isDM(\Illuminate\Support\Facades\Session::get("uid")))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="enroll" role="button" data-bs-toggle="dropdown" aria-expanded="false">报名</a>
                            <ul class="dropdown-menu" aria-labelledby="enroll">
                                <li><a class="dropdown-item" href="/Enroll/Delegate">代表</a></li>
                                <li><a class="dropdown-item" href="/Enroll/Observer">观察员</a></li>
                                <li><a class="dropdown-item" href="/Enroll/Academic">学术团队</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Test">学测</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Seat">席位</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Files">文件</a>
                        </li>
                    @endif
                    @if((new \App\Models\Admin())->isSupAdmin(\Illuminate\Support\Facades\Session::get("uid")))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/User">用户</a>
                        </li>
                    @endif
                    @if((new \App\Models\Admin())->isDH(\Illuminate\Support\Facades\Session::get("uid")))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/Committee">委员会</a>
                        </li>
                    @endif
                    @if((new \App\Models\Admin())->isDM(\Illuminate\Support\Facades\Session::get("uid")))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/Delegate">代表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/Test">学测</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/Seat">席位</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Admin/Files">文件</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/About">关于</a>
                    </li>
                </ul>
                <div class="d-flex me-4">
                    <li class="nav-item dropdown" style="list-style: none">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="user" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{$user["name"]}}</a>
                        <ul class="dropdown-menu" aria-labelledby="user">
                            <li><a class="dropdown-item" href="{{$_ENV["Reimu_Url"]}}">个人资料</a></li>
                            <li><a class="dropdown-item" href="/Actions/LogOut">登出</a></li>
                        </ul>
                    </li>
                    <img src="{{$_ENV["Reimu_Url"]}}/storage/avatar/{{$user["avatar"]}}" class="rounded-circle" style="height: 48px" />
                </div>
            </div>
    </div>
</nav>