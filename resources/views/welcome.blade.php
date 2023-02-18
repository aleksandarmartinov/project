@extends('layouts.master')

@section('main')
    <h1>Svi Oglasi</h1>
    <div class="row">
        <div class="col-3">
            <ul class="list-group list-group-flush">
                @foreach ($categories as $cat)
                    <li class="list-group-item bg-secondary">
                        <a href="{{ route('welcome') }}?cat={{ $cat->name }}" class="text-light">{{ $cat->name }}</a>
                    </li>
                @endforeach
                <li class="list-group-item bg-secondary">
                    <form action="{{ route('welcome') }}" method="GET">
                        <select name="type" class="form-control form-select">
                            <option value="lower" {{ (isset(request()->type) && request()->type == 'lower') ?
                             'selected' : '' }}>Cena rastuce</option>
                            <option value="upper" {{ (isset(request()->type) && request()->type == 'upper') ?
                             'selected' : '' }}>Cena opadajuce</option>
                        </select>
                        <button type="submit" class="btn btn-success form-control mt-2">Search</button>
                    </form>  
                </li>
            </ul>
        </div>
        <div class="col-9">
            <ul class="list-group">
                @foreach ($all_ads as $ad)
                <li class="list-group-item">
                    <a href="{{ route('singleAd', ['id'=>$ad->id]) }}">{{ $ad->title }}</a>
                    <span class="badge bg-warning text-dark"> {{$ad->price}} rsd</span>
                    <span class="badge bg-info text-dark float-end">Pregleda </span>
                </li>
                @endforeach
            </ul><br>
            <div class="d-flex justify-content-end">
               {{ $all_ads->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection