@extends('layouts.client.client-master')
@section('title-page', 'Bài viết')
@section('content')
<div class="d-none">
    <div class="bg-primary border-bottom p-3 d-flex align-items-center">
        <a class="toggle togglew toggle-2" href="#"><span></span></a>
        <h4 class="font-weight-bold m-0 text-white">Bài viết</h4>
    </div>
</div>
<!-- Most popular -->
<div class="container most_popular py-5">
    <h2 class="font-weight-bold mb-3">Bài viết</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
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
@endsection