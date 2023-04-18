@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 py-5">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8 py-3">
            <h2 class="text-center">Vasi Oglasi</h2>
            <ul class="list-group">
                @foreach ($all_ads as $ad)
                    <li class="list-group-item">
                        <a href="{{ route('home.singleAd', ['id'=>$ad->id]) }}">
                            {{ $ad->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>     
    </div>
</div>
@endsection
