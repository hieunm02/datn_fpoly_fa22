@extends('layouts.client.client-master')
@section('title-page', 'chi tiết bài viết')
@section('content')
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <a class="toggle togglew toggle-2" href="#"><span></span></a>
        <h4 class="font-weight-bold m-0 text-white">Bài viết</h4>
    </div>
</div>
<!-- Most popular -->
<div class="container most_popular py-5">
    <div class="col-md-12 p-0">
        <h2 class="font-weight-bolder">Lorem ipsum dolor sit amet, consetetur sadipscing</h2>
        <p>
            <span class="badge badge-secondary"><i class="feather-user"></i> Admin</span>
            <span class="badge"><i class="feather-calendar p-1"></i> 02/10/2022</span>
            <span class="badge badge-secondary"><i class="feather-eye"></i> 300+</span>
        </p>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
        </p>
    </div>
    <h3 class="font-weight-bold my-3">Bài viết liên quan</h3>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-eye"></i> 300+</span></div>
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
                        <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae minima in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero nostrum sunt consequuntur doloremque vel illum harum ex numquam.</p>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-user-check"></i> Admin</span></p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-3 mb-3">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-eye"></i> 300+</span></div>
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
                        <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae minima in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero nostrum sunt consequuntur doloremque vel illum harum ex numquam.</p>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-user-check"></i> Admin</span></p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-3 mb-3">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-eye"></i> 300+</span></div>
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
                        <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae minima in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero nostrum sunt consequuntur doloremque vel illum harum ex numquam.</p>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-user-check"></i> Admin</span></p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-3 mb-3">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-eye"></i> 300+</span></div>
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
                        <p class="mb-3 newsHide">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae minima in repellat consequuntur animi nam optio molestiae asperiores quo distinctio? Libero nostrum sunt consequuntur doloremque vel illum harum ex numquam.</p>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-user-check"></i> Admin</span></p>
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