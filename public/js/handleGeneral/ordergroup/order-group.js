// tạo đường dẫn random 
    function rand_string(length)
    {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }


    var url = '';
    $('#create_group').on('click', function() {
        $('#link_group').html(`http://localhost:8000/order-group/` + rand_string(16)).then(
            url = $('#link_group').html()
        )
    })

// tạo room 
    function orderGroup(){
            history.pushState({}, "", url);
            let route = "{{ route('order-group') }}"
            let room = url
            let user_id = $('#user_id').val()
            let role = 'manager'
            let formData = new FormData()
            let token = "{{ csrf_token() }}"

            formData.append('room', room)
            formData.append('user_id', user_id)
            formData.append('role', role)
            formData.append('_token', token)

            $.ajax({
                url: route,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(response) {
                    if(response.success){
                        console.log(response.data);
                    }
                }
            })
        }
        $('#link_invite').html(location.href)
    //server
    // let ip_address = '127.0.0.1';
    // let socket_port = '3000';
    // let socket = io(ip_address + ':' + socket_port);

 

