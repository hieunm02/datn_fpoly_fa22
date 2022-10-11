<header class="section-header" id="headerScroll">
    <section class="header-main shadow-sm bg-white">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-1">
                    <a href="home.html" class="brand-wrap mb-0">
                        <img alt="#" class="img-fluid" src="{{asset('img/logo_web.png')}}">
                    </a>
                    <!-- brand-wrap.// -->
                </div>
                {{-- <div class="col-3 d-flex align-items-center m-none">
                    <div class="dropdown mr-3">
                        <a class="text-dark dropdown-toggle d-flex align-items-center py-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div><i class="feather-map-pin mr-2 bg-light rounded-pill p-2 icofont-size"></i></div>
                            <div>
                                <p class="text-muted mb-0 small">Select Location</p>
                                Jawaddi Ludhiana...
                            </div>
                        </a>
                        <div class="dropdown-menu p-0 drop-loc" aria-labelledby="navbarDropdown">
                            <div class="osahan-country">
                                <div class="search_location bg-primary p-3 text-right">
                                    <div class="input-group rounded shadow-sm overflow-hidden">
                                        <div class="input-group-prepend">
                                            <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i class="feather-search"></i></button>
                                        </div>
                                        <input type="text" class="shadow-none border-0 form-control" placeholder="Enter Your Location">
                                    </div>
                                </div>
                                <div class="p-3 border-bottom">
                                    <a href="home.html" class="text-decoration-none">
                                        <p class="font-weight-bold text-primary m-0"><i class="feather-navigation"></i> New York, USA</p>
                                    </a>
                                </div>
                                <div class="filter">
                                    <h6 class="px-3 py-3 bg-light pb-1 m-0 border-bottom">Choose your country</h6>
                                    <div class="custom-control  border-bottom px-0 custom-radio">
                                        <input type="radio" id="customRadio1" name="location" class="custom-control-input">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio1">Afghanistan</label>
                                    </div>
                                    <div class="custom-control  border-bottom px-0 custom-radio">
                                        <input type="radio" id="customRadio2" name="location" class="custom-control-input" checked="">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio2">India</label>
                                    </div>
                                    <div class="custom-control  border-bottom px-0 custom-radio">
                                        <input type="radio" id="customRadio3" name="location" class="custom-control-input">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio3">USA</label>
                                    </div>
                                    <div class="custom-control  border-bottom px-0 custom-radio">
                                        <input type="radio" id="customRadio4" name="location" class="custom-control-input">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio4">Australia</label>
                                    </div>
                                    <div class="custom-control  border-bottom px-0 custom-radio">
                                        <input type="radio" id="customRadio5" name="location" class="custom-control-input">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio5">Japan</label>
                                    </div>
                                    <div class="custom-control  px-0 custom-radio">
                                        <input type="radio" id="customRadio6" name="location" class="custom-control-input">
                                        <label class="custom-control-label py-3 w-100 px-3" for="customRadio6">China</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- col.// -->
                <div class="col-11">
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- search -->
                        {{-- <a href="search.html" class="widget-header mr-4 text-dark">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-search h6 mr-2 mb-0"></i> <span>Search</span>
                            </div>
                        </a>
                        <!-- offers -->
                        <a href="offers.html" class="widget-header mr-4 text-white btn bg-primary m-none">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-disc h6 mr-2 mb-0"></i> <span>Offers</span>
                            </div>
                        </a> --}}
                        <!-- signin -->
                        @if (is_null(Session::get('user_name')))
                        <a href="/login" class="widget-header mr-4 text-dark m-none">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-user h6 mr-2 mb-0"></i> <span>Sign in</span>
                            </div>
                        </a>
                        <!-- my account -->
                        @else
                        <div class="dropdown mr-4 m-none">
                            <a href="#" class="dropdown-toggle text-dark py-3 d-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img alt="#" src="{{asset('img/user/1.jpg')}}" class="img-fluid rounded-circle header-user mr-2 header-user"> {{ Session::get('user_name')}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="profile.html">My account</a>
                                <a class="dropdown-item" href="faq.html">Delivery support</a>
                                <a class="dropdown-item" href="contact-us.html">Contant us</a>
                                <a class="dropdown-item" href="terms.html">Term of use</a>
                                <a class="dropdown-item" href="privacy.html">Privacy policy</a>
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </div>
						@endif
                        <!-- signin -->
                        <a href="checkout.html" class="widget-header mr-4 text-dark">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-shopping-cart h6 mr-2 mb-0"></i> <span>Cart</span>
                            </div>
                        </a>
                        <a class="toggle1" id="clickMenus1">
                            <span> <i class="feather-align-justify fs-30"></i></span>
                        </a>
                    </div>
                    <!-- widgets-wrap.// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- container.// -->
    </section>
    <!-- header-main .// -->

</header>
{{-- header-footer --}}
<div id="nav-bottom" class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
    <div class="row">
        <div class="col">
            <a href="home.html" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-home text-dark"></i></p>
                Home
            </a>
        </div>
        <div class="col">
            <a href="most_popular.html" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-map-pin"></i></p>
                Trending
            </a>
        </div>
        <div class="col bg-white rounded-circle mt-n4 px-3 py-2">
            <div class="bg-danger rounded-circle mt-n0 shadow">
                <a href="checkout.html" class="text-white small font-weight-bold text-decoration-none">
                    <i class="feather-shopping-cart"></i>
                </a>
            </div>
        </div>
        <div class="col selected">
            <a href="favorites.html" class="text-danger small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-heart"></i></p>
                Favorites
            </a>
        </div>
        <div class="col">
            <a href="profile.html" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-user"></i></p>
                Profile
            </a>
        </div>
    </div>
</div>
{{-- end-header-footer --}}
{{-- siderbar nav --}}
<nav id="navSiderBar" class="hc-offcanvas-nav hc-nav-1 nav-levels-overlap nav-position-left disable-body"
    style="visibility: visible;">
    <div class="nav-container" style="">
        <div id="subOverlay" class="nav-wrapper nav-wrapper-0"> {{-- edit  sub-level-open--}}
            <div class="nav-content">
                <h2>BeeFood</h2>
                <ul>
                    <li>
                        <div class="nav-item-wrapper"><a href="home.html" class="nav-item"><i
                                    class="feather-home mr-2"></i> Homepage</a></div>
                    </li>
                    <li>
                        <div class="nav-item-wrapper"><a href="my_order.html" class="nav-item"><i
                                    class="feather-list mr-2"></i> My Orders</a></div>
                    </li>
                    <li>
                        <div class="nav-item-wrapper"><a href="favorites.html" class="nav-item"><i
                                    class="feather-heart mr-2"></i> Favorites</a></div>
                    </li>
                    <li>
                        <div class="nav-item-wrapper"><a href="trending.html" class="nav-item"><i
                                    class="feather-trending-up mr-2"></i> Trending</a></div>
                    </li>
                    <li>
                        <div class="nav-item-wrapper"><a href="checkout.html" class="nav-item"><i
                                    class="feather-list mr-2"></i> Checkout</a></div>
                    </li>
                    <li>
                        <div class="nav-item-wrapper"><a href="map.html" class="nav-item"><i
                                    class="feather-map-pin mr-2"></i> Live Map</a></div>
                    </li>
                    <li id="menu-sub" class="nav-parent"><input type="checkbox" id="hc-nav-1-1-1" value="g6ckvfwmm5e"> {{-- edit  level-open--}}
                        <div class="nav-item-wrapper"><a href="#" id="subClick" class="nav-item"><i
                                    class="feather-grid mr-2"></i> Danh mục<span class="nav-next"></span></a></div>
                        <div class="nav-wrapper nav-wrapper-1">
                            <div class="nav-content">
                                <h2>Danh mục</h2>
                                <ul>
                                    <li class="nav-back">
                                        <div id="closeSubNav" class="nav-item-wrapper"><a href="#">BeeFood<span></span></a>
                                        </div>
                                    </li>
                                    <?php 
                                        $menus = DB::table('menus')->get();
                                    ?>
                                    @foreach ($menus as $menu)
                                    <li>
                                        <div class="nav-item-wrapper"><a href="privacy.html" class="nav-item">{{ $menu->name }}</a></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="bottom-nav">
                    <li class="email">
                        <div class="nav-item-wrapper"><a class="text-danger nav-item" href="home.html">
                                <p class="h5 m-0"><i class="feather-home text-danger"></i></p>
                                Home
                            </a></div>
                    </li>
                    <li class="github">
                        <div class="nav-item-wrapper"><a href="faq.html" class="nav-item">
                                <p class="h5 m-0"><i class="feather-message-circle"></i></p>
                                FAQ
                            </a></div>
                    </li>
                    <li class="ko-fi">
                        <div class="nav-item-wrapper"><a href="contact-us.html" class="nav-item">
                                <p class="h5 m-0"><i class="feather-phone"></i></p>
                                Help
                            </a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div id="overlay" class="overlay-nav"></div>