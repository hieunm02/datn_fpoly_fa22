<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">

            {{-- Products --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Products</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('products.index')}}">Danh sách sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{route('products.create')}}">Tạo mới sản phẩm</a>
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
                        <a href="{{route('menus.index')}}">Danh sách</a>
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
                        <a href="{{route('news.index')}}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{route('news.create')}}">Tạo mới</a>
                    </li>
                </ul>
            </li>
            {{-- End News  --}}

            {{-- Vouchers  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-percent"></i>
                    </span>
                    <span class="title">Mã giảm giá</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('vouchers.index')}}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{route('vouchers.create')}}">Tạo mới</a>
                    </li>
                </ul>
            </li>
            {{-- End Vouchers  --}}

        </ul>
    </div>
</div>