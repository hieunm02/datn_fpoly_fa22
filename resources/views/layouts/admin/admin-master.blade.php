<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.admin.head')
</head>

<body>
    <div class="app">
        <div class="notification-toast top-right" id="notification-toast"></div>
        <div class="layout">
            <!-- Header START -->
            @include('layouts.admin.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            @include('layouts.admin.sidebar')
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">

                @yield('content')
                <!-- Content Wrapper START -->

                <!-- Content Wrapper END -->

            </div>
            <!-- Page Container END -->

            <!-- Search Start-->
            {{-- <div class="modal modal-left fade search" id="search-drawer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-between align-items-center">
                        <h5 class="modal-title">Search</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body scrollable">
                        <div class="input-affix">
                            <i class="prefix-icon anticon anticon-search"></i>
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="modal-body scrollable">
                            <div class="input-affix">
                                <i class="prefix-icon anticon anticon-search"></i>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <div class="m-t-30">
                                <h5 class="m-b-20">Files</h5>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-file-excel"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Quater
                                            Report.exl</a>
                                        <p class="m-b-0 text-muted font-size-13">by Finance</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-blue avatar-icon">
                                        <i class="anticon anticon-file-word"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Documentaion.docx</a>
                                        <p class="m-b-0 text-muted font-size-13">by Developers</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-purple avatar-icon">
                                        <i class="anticon anticon-file-text"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Recipe.txt</a>
                                        <p class="m-b-0 text-muted font-size-13">by The Chef</p>
                                    </div>
                                </div>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-red avatar-icon">
                                        <i class="anticon anticon-file-pdf"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Project
                                            Requirement.pdf</a>
                                        <p class="m-b-0 text-muted font-size-13">by Project Manager</p>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <h5 class="m-b-20">Members</h5>
                                <div class="d-flex m-b-30">
                                    <div class="avatar avatar-image">
                                        <img src="{{asset('assets/images/avatars/thumb-1.jpg')}}" alt="">
        </div>
        <div class="m-l-15">
            <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Erin
                Gonzales</a>
            <p class="m-b-0 text-muted font-size-13">UI/UX Designer</p>
        </div>
    </div>
    <div class="d-flex m-b-30">
        <div class="avatar avatar-image">
            <img src="{{asset('assets/images/avatars/thumb-2.jpg')}}" alt="">
        </div>
        <div class="m-l-15">
            <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Darryl
                Day</a>
            <p class="m-b-0 text-muted font-size-13">Software Engineer</p>
        </div>
    </div>
    <div class="d-flex m-b-30">
        <div class="avatar avatar-image">
            <img src="{{asset('assets/images/avatars/thumb-3.jpg')}}" alt="">
        </div>
        <div class="m-l-15">
            <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Marshall
                Nichols</a>
            <p class="m-b-0 text-muted font-size-13">Data Analyst</p>
        </div>
    </div>
    </div>
    <div class="m-t-30">
        <h5 class="m-b-20">News</h5>
        <div class="d-flex m-b-30">
            <div class="avatar avatar-image">
                <img src="{{asset('assets/images/others/img-1.jpg')}}" alt="">
            </div>
            <div class="m-l-15">
                <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">5 Best
                    Handwriting Fonts</a>
                <p class="m-b-0 text-muted font-size-13">
                    <i class="anticon anticon-clock-circle"></i>
                    <span class="m-l-5">25 Nov 2018</span>
                </p>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> --}}
    <!-- Search End-->


    <!-- Quick View END -->
    </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p class="m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
            <span>
                <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                <a href="" class="text-gray">Privacy &amp; Policy</a>
            </span>
        </div>
    </footer>

    @include('layouts.admin.footer')
</body>

</html>
