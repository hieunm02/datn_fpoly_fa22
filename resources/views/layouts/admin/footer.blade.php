<!-- Core Vendors JS -->
<script src="{{ asset('assets/js/vendors.min.js') }}"></script>

<!-- page js -->
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>

<!-- Core JS -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
<script>
    $(function() {
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);
        socket.on('sendNotifyToClient', (data) => {
            var toastHTML = `<div class="toast fade hide" data-delay="3000">
                                <div class="toast-header">
                                    <i class="anticon anticon-info-circle text-primary m-r-5"></i>
                                    <strong class="mr-auto">Thông báo</strong>
                                    <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="toast-body">
                                    Có thông báo mới!
                                </div>
                            </div>`

            $('#notification-toast').append(toastHTML)
            $('#notification-toast .toast').toast('show');
            setTimeout(function() {
                $('#notification-toast .toast:first-child').remove();
            }, 3000);
            if (data.type == 'comment') {
                $('#innerNotify').prepend(`
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-gold avatar-icon">
                                                    <i class="anticon anticon-message"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">${data.user_name} đã bình luận</p>
                                                    <p class="m-b-0"><small>${data.date}</small></p>
                                                </div>
                                            </div>
                                        </a>
            `);
            } else if (data.type == 'order') {
                $('#innerNotify').prepend(`
                    <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark">Đơn hàng mới từ ${data.user_name}</p>
                                        <p class="m-b-0"><small>${data.date}</small></p>
                                    </div>
                                </div>
                            </a>
            `);
            } else {
                $('#innerNotify').prepend(`
                                        <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                    <i class="anticon anticon-mail"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">Liên hệ từ ${data.user_name}</p>
                                                    <p class="m-b-0"><small>${data.date}</small></p>
                                                </div>
                                            </div>
                                        </a>
            `);
            }

        });
    });
</script>
@notifyJs
@yield('layouts.admin.footer')