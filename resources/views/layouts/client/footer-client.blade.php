<div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
    <div class="row">
        <div class="col selected">
            <a href="home.html" class="text-danger small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-home text-danger"></i></p>
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
        <div class="col">
            <a href="favorites.html" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-heart"></i></p>
                Favorites
            </a>
        </div>
        <div class="col">
            <a href="{{route('profile.index')}}" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-user"></i></p>
                Profile
            </a>
        </div>
    </div>
</div>
<!-- footer -->
<footer class="section-footer border-top bg-dark">
    <div class="container">
        <section class="footer-top padding-y py-5">
            <div class="row">
                <aside class="col-md-4 footer-about">
                    <article class="d-flex pb-3">
                        <div><img alt="#" src="img/logo_web.png" class="logo-footer mr-3"></div>
                        <div>
                            <h6 class="title text-white">Về cửa hàng</h6>
                            <p class="text-muted">Do lượng sinh viên của trường ngày một đông nên sau mỗi ca học, lượng sinh viên ra vào căng tin luôn trật cứng. Điều đó cũng làm cho việc mua bán trở lên khó khăn kể cả người bán đến người mua. Việc kiểm soát lượng hàng bán và tiền hàng cũng sẽ dễ nhầm lẫn trong lúc đông sinh viên. Vì vậy để giải quyết vấn đề quá tải ở canteen trường nên chúng em đã tạo ra 1 website để sinh viên và giảng viên dễ dàng mua đồ cũng như vấn đề nêu trên.</p>
                        </div>
                    </article>
                </aside>
                <aside class="col-sm-3 col-md-2 text-white">
                    <ul class="list-unstyled hov_footer">
                        <li> <a href="{{ route('index') }}" class="text-muted">Trang Chủ</a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-2 text-white">
                    <ul class="list-unstyled hov_footer">
                        <li> <a href="{{ url('contact-us') }}" class="text-muted"> Liên Hệ </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-2 text-white">
                    <ul class="list-unstyled hov_footer">
                        <li> <a href="{{ url('carts') }}" class="text-muted"> Giỏ Hàng </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-2 text-white">
                    <ul class="list-unstyled hov_footer">
                        <li> <a href="/login" class="text-muted">
                            @if (is_null(Auth::user()))
                                Đăng Nhập
                            @else
                            <img alt="#" src="{{ Auth::user()->avatar }}" class="img-fluid rounded-circle header-user mr-2 header-user">
                           <a href="{{ route('profile.index') }}"> {{ Auth::user()->name }} </a>
                            @endif
                        </a></li>
                    </ul>
                </aside>
            </div>
            <!-- row.// -->
        </section>
        <!-- footer-top.// -->
    </div>
    <!-- //container -->
    <section class="footer-copyright border-top py-3 bg-light">
        <div class="container d-flex align-items-center">
            <p class="mb-0"> © 2020 BEEEFOOD All rights reserved </p>
            <p class="text-muted mb-0 ml-auto d-flex align-items-center">
                <a href="#" class="d-block"><img alt="#" src="img/appstore.png" height="40"></a>
                <a href="#" class="d-block ml-3"><img alt="#" src="img/playmarket.png" height="40"></a>
            </p>
        </div>
    </section>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quy đổi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="osahan-filter">
                    <div class="filter">
                        <!-- SORT BY -->
                        <!-- <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">SORT BY</h6>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio1f" name="location" class="custom-control-input" checked>
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio1f">Top Rated</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio2f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio2f">Nearest Me</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio3f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio3f">Cost High to Low</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio4f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio4f">Cost Low to High</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio5f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3" for="customRadio5f">Most Popular</label>
                        </div> -->
                        <!-- Filter -->
                        <!-- <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">FILTER</h6>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck1" checked>
                            <label class="custom-control-label py-3 w-100 px-3" for="defaultCheck1">Open Now</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck2">
                            <label class="custom-control-label py-3 w-100 px-3" for="defaultCheck2">Credit Cards</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck3">
                            <label class="custom-control-label py-3 w-100 px-3" for="defaultCheck3">Alcohol Served</label>
                        </div> -->
                        <!-- Filter -->
                        <!-- <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">ADDITIONAL FILTERS</h6>
                        </div> -->
                        <div class="px-3 pt-3">
                            <!-- <input type="range" class="custom-range" min="0" max="100" name="minmax"> -->
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Điểm</label>
                                    <input class="form-control" placeholder="Mời nhập số điểm quy đổi" name="point_exchange" id="point_exchange" type="number">
                                    <p class="error small m-0"  style="color:red">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Đóng</button>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-exchange-point">Đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>