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
                        <a href="{{route('products.index')}}">List Products</a>
                    </li>
                    <li>
                        <a href="{{route('products.create')}}">Create Products</a>
                    </li>
                </ul>
            </li>
            {{-- End Products --}}

            {{-- Menus  --}}

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-appstore"></i>
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

        </ul>
    </div>
</div>


