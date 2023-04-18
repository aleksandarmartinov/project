@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2 py-5">
            <a href="{{ route('home.messages') }}" class="btn btn-dark form-control py-2">Back to messages</a>
        </div>
        <div class="col-10">
            <h2 class="text-center">Poruke</h2>
            <ul class="list-group">
                <li class="list-group-item mb-2">
                    <p class="d-flex justify-content-between align-items-center">Oglas : {{ $message->ad->title }}<span>{{ $message->created_at->format('d-m-Y') }}</span></p>
                    <p>From : {{ $message->sender->name }}</p>
                    <p><strong>{{ $message->text }}</strong></p>
                </li>
            </ul>    
        </div>
    </div>
</div>
@endsection