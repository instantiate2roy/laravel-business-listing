<div id='notification_message_div'>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="alert alert-danger">
                        Notice: <i>{{ $error }}</i>
                    </div>
                </div>
            </div>
        @break
    @endforeach
@endif

@if (session('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif
</div>
