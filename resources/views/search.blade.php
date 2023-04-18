@extends('layouts.master')

@section('main')
    <div class="row">
        <div class="col-3">
            <h2 class="text-center p-4">Kategorije</h2>
            <ul class="list-group list-group-flush">
                @foreach ($categories as $cat)
                    <li class="list-group-item bg-secondary">
                        <a href="{{ route('welcome') }}?cat={{ $cat->name }}" class="text-light">{{ $cat->name }}</a>
                    </li>
                @endforeach
        </div>
    <div class="col-9">
        <h1 class="text-center py-4">Rezultati Pretrage</h1>
        <ul class="list-group">
            @foreach ($ads as $ad)
                <li class="list-group-item d-flex align-items-center">
                    <div class="ml-auto">
                        <img src="/ad_images/{{ $ad->image1 }}" alt="{{ $ad->title }}" class="me-3"     width="100">
                        <a href="{{ route('singleAd', ['id' => $ad->id]) }}" class="text-bold">{{   $ad->title }}</a>
                    </div> 
                    <div class="ms-auto">
                        <button class="badge bg-warning text-dark ms-auto"><i class="bi bi-eye-fill"> Cena: </i><span> {{ $ad->price }} rsd</span> </button>
                        <button class="badge bg-info text-dark ms-auto"><i class="bi bi-eye-fill"> Vidjeno</i><span> {{ $ad->adViews->count() }}</span> </button>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="d-flex justify-content-end">
            {{ $ads->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </div>
@endsection
