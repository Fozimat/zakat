<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('dashboard.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>

                </a>
            </li>
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('muzakki.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Data Muzakki</span>
                </a>
            </li>

            @if (Auth::user()->level == 'SUPER ADMIN')
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('amil.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-solution"></i>
                    </span>
                    <span class="title">Data Amil Zakat</span>
                </a>
            </li>
            @endif

            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('zakat.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Pembayaran Zakat</span>
                </a>
            </li>

            @if (Auth::user()->level == 'ADMIN')
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('zakat_mal.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Perhitungan Zakat Mal</span>
                </a>
            </li>
            @endif

            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('penerima.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Penerima Zakat</span>
                </a>
            </li>

            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('laporan.index') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-printer"></i>
                    </span>
                    <span class="title">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</div>