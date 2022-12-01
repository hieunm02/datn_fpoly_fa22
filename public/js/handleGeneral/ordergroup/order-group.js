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

        
        $(function () {
            $('#building').change(function () {
                // $("").on("change", function (e) {
        
                id_building = this.value;
                // }
                var $floor = $('#floor');
                $floor.empty();
                var $room = $('#room');
                $room.empty();
                $.ajax({
                    type: 'GET',
                    url: "/carts/getFloor",
                    dataType: "JSON",
                    data: {
                        'id': id_building
                    },
                    success: function (data) {
                        // the next thing you want to do 
                        var $floor = $('#floor');
                        $floor.empty();
                        for (var i = 0; i < data.length; i++) {
                            $floor.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
                        }
                        // //manually trigger a change event for the contry so that the change handler will get triggered
                        $floor.change();
                        console.log(data);
                        // $('#show_order').reload();
                    }
                });
        
            });
        });

        $(function() {
            $('#floor').change(function () {
                // $("").on("change", function (e) {
                // id_building = document.getElementById('building').value;
                id_floor = this.value;
                // }
                $.ajax({
                    type: 'GET',
                    url: "/carts/getRoom",
                    dataType: "JSON",
                    data: {
                        'floor_id': id_floor,
                        // 'building_id': id_building,
                    },
                    success: function (data) {
                        // the next thing you want to do 
                        var $room = $('#room');
                        $room.empty();
                        for (var i = 0; i < data.length; i++) {
                            $room.append('<option id=' + data[i].id + ' value=' + data[i].name + '>' + data[i].name + '</option>');
                        }
                        // //manually trigger a change event for the contry so that the change handler will get triggered
                        $room.change();
                    }
                });
        
            });
        })

 

