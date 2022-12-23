<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            {{-- dashboard --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{ route('admin.dashboard') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            {{-- Thanh toán trực tiếp --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{ route('admin.thanh-toan-truc-tiep') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-printer"></i>
                    </span>
                    <span class="title">Đặt hàng trực tiếp</span>
                </a>
            </li>
            {{-- end-Thanh toán trực tiếp  --}}
            {{-- Orders --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-container"></i>
                    </span>
                    <span class="title">Đơn hàng</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('orders.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- end-orders --}}

            {{-- Bills --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Hóa đơn</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('bills.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- end-bills --}}
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
                </ul>
            </li>
            {{-- End News  --}}

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
                        <i class="bi bi-percent"></i>
                    </span>
                    <span class="title">Vouchers</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('vouchers.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- End Voucher --}}

            {{-- Staffs --}}
            @role('manager')
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <span class="title">Staffs</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('staffs.index') }}">Danh sách</a>
                        </li>
                    </ul>
                </li>
                {{-- End Staffs --}}
            @endrole
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

            {{-- Contacts  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-phone"></i>
                    </span>
                    <span class="title">Liên hệ</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.contacts.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- end-contacts --}}

            {{-- Chats  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-message"></i>
                    </span>
                    <span class="title">Chat</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.chats.message') }}">Chat</a>
                    </li>
                </ul>
            </li>
            {{-- end-chats --}}

            {{-- Comments  --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="bi bi-box"></i>
                    </span>
                    <span class="title">Bình luận</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('comments.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- end-Comments --}}

            {{-- Adress --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="bi bi-boxes"></i>
                    </span>
                    <span class="title">Địa chỉ</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('building.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- End Adress --}}

            {{-- Options --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fab fa-usb"></i>
                    </span>
                    <span class="title">Options</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('options.index') }}">Danh sách</a>
                    </li>
                </ul>
            </li>
            {{-- option-bills --}}
        </ul>
    </div>
</div>
