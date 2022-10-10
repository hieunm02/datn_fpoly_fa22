<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">

            {{-- Products --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Sản phẩm</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('products.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- End Products --}}

            {{-- Menus  --}}

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-bars"></i>
                    </span>
                    <span class="title">Danh mục</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('menus.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- End Menus  --}}

            {{-- News  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="far fa-newspaper"></i>
                    </span>
                    <span class="title">Tin tức</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('news.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('news.create') }}">Tạo mới</a>
                    </li>
                </ul>
            </li>
            {{-- End News  --}}

<<<<<<< HEAD
            {{-- Slides  --}}

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="bi bi-layers-half"></i>
                    </span>
                    <span class="title">Slides</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                    <span class="title">Tài khoản</span>
            {{-- Vouchers  --}}
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('slides.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- End Slides  --}}

            {{-- Voucher  --}}

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-percent"></i>
                    </span>
                    <span class="title">Mã giảm giá</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('vouchers.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('vouchers.create') }}">Tạo mới</a>
                    </li>
                </ul>
            </li>
            {{-- End Voucher  --}}


            {{-- Users  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-user-friends"></i>
                    </span>
                    <span class="title">Tài Khoản</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('users.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- end-users --}}
        </ul>
    </div>
</div>
