<div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
    <div class="row">
        <div class="col">
            <a href="{{ url('/') }}" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-home text-dark"></i></p>
                Trang chủ
            </a>
        </div>
        <div class="col">
            <a href="{{ url('offers') }}" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-percent"></i></p>
                Giảm giá
            </a>
        </div>
        <div class="col bg-white rounded-circle mt-n4 px-3 py-2">
            <div class="bg-danger rounded-circle mt-n0 shadow">
                <a href="{{ url('carts') }}" class="text-white small font-weight-bold text-decoration-none">
                    <i class="feather-shopping-cart"></i>
                </a>
            </div>
        </div>
        <div class="col">
            <a href="{{ route('listProducts') }}" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-heart"></i></p>
                Sản phẩm
            </a>
        </div>
        <div class="col">
            <a href="{{ Auth::user() ? route('profile.index') : route('login') }}"
                class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="feather-user"></i></p>
                {{ Auth::user() ? 'Tài khoản' : 'Đăng nhập' }}
            </a>
        </div>
    </div>
</div>
<!-- footer -->
<footer class="section-footer border-top bg-dark">
    <div class="container">
        <section class="footer-top padding-y py-5">
            <div class="row">
                <aside class="col-md-5 footer-about">
                    <article class="d-flex pb-3">
                        <div>
                            <img src="{{ asset('assets/images/logo/BeeFood.png') }}" class="logo-footer mr-3 mb-5">
                            <h6 class="title text-white">Về cửa hàng</h6>
                            <p class="text-muted text-justify">Do lượng sinh viên của trường ngày một đông nên sau mỗi
                                ca học, lượng sinh viên ra vào căng tin luôn trật cứng. Điều đó cũng làm cho việc mua
                                bán trở lên khó khăn kể cả người bán đến người mua. Việc kiểm soát lượng hàng bán và
                                tiền hàng cũng sẽ dễ nhầm lẫn trong lúc đông sinh viên. Vì vậy để giải quyết vấn đề quá
                                tải ở canteen trường nên chúng em đã tạo ra 1 website để sinh viên và giảng viên dễ dàng
                                mua đồ cũng như vấn đề nêu trên.</p>
                        </div>
                    </article>
                </aside>
                <aside class="col-sm-2 col-md-2 text-white">

                </aside>
                <aside class="col-sm-3 col-md-5 text-white">
                    <ul class="list-unstyled hov_footer">
                        <div class="mapouter border-dark">
                            <div class="gmap_canvas">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639810443356!2d105.74459841485445!3d21.03812778599324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sfr!2s!4v1665498762239!5m2!1sfr!2s"
                                    width="100%" height="230" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </ul>
                </aside>
            </div>
            <div class="row">
                <aside class="col-md-9"></aside>
                <nav class="col-md-3">
                    <ul class="navbar me-auto">
                        <li class="nav-item"><a class="link-light" title="Facebook" target="_blank"
                                href="https://www.facebook.com/khanhshebly/"><button class="btn btn-outline-light">
                                    <i class="feather-facebook"> Facebook</i>
                                </button></a>
                        </li>
                        <li class="nav-item"><a class="link-light" title="Youtube" target="_blank"
                                href="https://youtu.be/Z3LZEN6qLVY"><button class="btn btn-outline-light">
                                    <i class="feather-youtube"> Youtube</i>
                                </button></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- row.// -->
        </section>
        <!-- footer-top.// -->
    </div>
    <!-- //container -->
    <section class="footer-copyright border-top py-3 bg-light">
        <div class="container justify-content-center d-flex align-items-center">
            <p class="mb-0"> © 2022 BEEEFOOD All rights reserved </p>
        </div>
    </section>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                                    <input class="form-control" placeholder="Mời nhập số điểm quy đổi"
                                        name="point_exchange" id="point_exchange" type="number">
                                    <p class="error small m-0" style="color:red">

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
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        id="btn-exchange-point">Đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>
