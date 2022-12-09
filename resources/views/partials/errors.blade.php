@if((session()->has('message')))
    <p>{{session()->get('message')}}</p>
@endif

@if(isset($messages) && is_array($messages))
    @foreach($messages as $error)
        <p>
            {{$error}}
        </p>
    @endforeach
@endif

