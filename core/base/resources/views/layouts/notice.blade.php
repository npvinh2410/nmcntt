@if(session('flash'))
    @foreach(session('flash') as $type => $message)
        <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            {!! $message !!}
        </div>
    @endforeach
@endif