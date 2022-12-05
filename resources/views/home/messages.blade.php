@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8">
             <h2>Sve Poruke</h2>
             <ul class="list-group">
                 @foreach ($messages as $message)
                     <li class="list-group-item mb-2">
                        <p>
                            Oglas: {{ $message->ad->title }} {{-- ubacena relacija sa Ad-om u Model\Message --}}
                            <span class="float-end">
                                {{ $message->created_at->format('d-m-Y') }}
                            </span> 
                        </p>
                        <p>
                            From: {{ $message->sender->name }} {{-- ubacena relacija sa User-om u Model\Message --}}
                        </p>
                        <p><strong>{{ $message->text }}</strong></p>
                        <a href="{{ route('home.reply', ['sender_id'=>$message->sender->id,'ad_id'=>$message->ad_id]) }}">Reply</a>
                     </li>
                 @endforeach
             </ul>
        </div>
    </div>
</div>
@endsection