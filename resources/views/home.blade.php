@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
            <div class="mx-auto w-4/5 pb-10 py-3">
                <div class="border border-t-1 border-danger rounded-b bg-red-100 px-4 py-3 text-red-700 text-center">
                    {{ session()->get('message') }}
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4 py-4">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8">
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
