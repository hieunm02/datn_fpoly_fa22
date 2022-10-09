@extends('layouts.client.client-master')
@section('title-page', 'chi tiết bài viết')
@section('content')
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">Bài viết</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
        <!-- Most popular -->
        <div class="container most_popular py-5">
            <div class="col-md-12 p-0">
                <h2 class="font-weight-bolder">{{ $news->title }}</h2>
                <p>
                    <span class="badge badge-secondary"><i class="feather-user"></i>
                        @foreach ($authors as $auth)
                            @if ($news->user_id == $auth->id)
                                {{ $auth->name }}
                            @endif
                        @endforeach
                    </span>
                    <span class="badge"><i class="feather-calendar p-1"></i> 02/10/2022</span>
                    <span class="badge badge-secondary"><i class="feather-eye"></i> 300+</span>
                </p>
                <p>
                    {!! $news->content !!}
                </p>
            </div>
            <h3 class="font-weight-bold my-3">Bài viết liên quan</h3>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-eye"></i>
                                    300+</span></div>
                            {{-- <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                            <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                            <a href="restaurant.html">
                                <img alt="#" src="img/trending1.png" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                    </a>
                                </h6>
                                <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae
                                    minima
                                    in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero
                                    nostrum
                                    sunt consequuntur doloremque vel illum harum ex numquam.</p>
                                <p class="text-gray mb-3 time"><span
                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                            class="feather-user-check"></i> Admin</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-eye"></i>
                                    300+</span></div>
                            {{-- <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                            <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                            <a href="restaurant.html">
                                <img alt="#" src="img/trending1.png" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                    </a>
                                </h6>
                                <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae
                                    minima
                                    in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero
                                    nostrum
                                    sunt consequuntur doloremque vel illum harum ex numquam.</p>
                                <p class="text-gray mb-3 time"><span
                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                            class="feather-user-check"></i> Admin</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-eye"></i>
                                    300+</span></div>
                            {{-- <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                            <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                            <a href="restaurant.html">
                                <img alt="#" src="img/trending1.png" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                    </a>
                                </h6>
                                <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae
                                    minima
                                    in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero
                                    nostrum
                                    sunt consequuntur doloremque vel illum harum ex numquam.</p>
                                <p class="text-gray mb-3 time"><span
                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                            class="feather-user-check"></i> Admin</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i
                                        class="feather-eye"></i>
                                    300+</span></div>
                            {{-- <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                            <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                            <a href="restaurant.html">
                                <img alt="#" src="img/trending1.png" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                    </a>
                                </h6>
                                <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae
                                    minima
                                    in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero
                                    nostrum
                                    sunt consequuntur doloremque vel illum harum ex numquam.</p>
                                <p class="text-gray mb-3 time"><span
                                        class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                            class="feather-user-check"></i> Admin</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        {{-- <div id="nav-bottom" class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
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
</div> --}}
    @endsection
    {{-- <script>
    window.addEventListener('scroll', function(ev) {

 var someDiv = document.getElementById('headerScroll');
 var distanceToTop = someDiv.getBoundingClientRect().top;
 function scrollFunction() {
        // do your stuff here;
        document.getElementById('nav-bottom').classList.remove('d-none');
        if (distanceToTop == 0 || distanceToTop > -80) {
        document.getElementById('nav-bottom').classList.add('d-none');

        }
    }
    window.onscroll = scrollFunction;
//  console.log(distanceToTop);
});
</script> --}}
