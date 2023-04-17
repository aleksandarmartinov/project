@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            Back to home
        </div>
        <div class="col-9">
            <h2>Poruka</h2>
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