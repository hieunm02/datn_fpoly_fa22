@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="page-header d-flex align-items-center">
            <h2 class="header-title flex-fill">Trả lời vấn đề</h2>
        </div>
        <div class="card p-3">
            <h3>Chào bạn {{ $contacts->name }}</h3>
            <div id="showContent">
                Nội dung của mail...
            </div>
            <p>Chúng tôi xin chân thành cảm ơn bạn đã luôn ủng hộ chúng tôi!</p>
            <p>Thân ái</p>
            <strong>BeeFood</strong>
        </div>
        <div class="card">
            <form action="{{ route('admin.contacts.send-mail') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $contacts->id }}">
                <input type="hidden" name="name" value="{{ $contacts->name }}">
                <input type="hidden" name="email" value="{{ $contacts->email }}">
                <div class="row">
                    <div class="col-md-12">
                        <label class="font-weight-semibold" for="">Nội dung</label>
                        <textarea id="content" name="content">
                        </textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace('content', {});
                            var showContent = $('#showContent');

                            editor.on('change', function() {
                                var val = editor.getData();
                                showContent.html(val);
                                // console.log(editor.getData());
                            });
                        </script>
                    </div>
                </div>
                <button class="btn btn-primary mt-1">Send</button>
            </form>
        </div>
    </div>
@endsection
<script>
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
