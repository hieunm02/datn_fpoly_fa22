$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function update(id) {
    $.get('edit-comment/' + id, function (data) {
        console.log(data);
        $('#content').val(data.comment.content);
    })
};

var id = $('#comment_id').val()
$('#saveUpdateForm').on('click', function (id) {
    saveUpdate(id);
});

function saveUpdate() {
    var content = $('#content').val();
    var id = $('#comment_id').val();
    console.log(id)
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url: 'rep-comments/' + id,
        type: "PUT",
        data: {
            id: id,
            content: content,
        }, dataType: 'json', success: function (data) {
            $('.modal-backdrop').removeClass('modal-backdrop');
            $('#edit-bookmark').removeAttr('style');
            $('#id' + data.comment.id).text(data.comment.content);
        }
    })
}
