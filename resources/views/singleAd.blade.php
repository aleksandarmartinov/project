@extends('layouts.master')

@section('main')
<div class="row">
    @if (isset($ad->image1))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $ad->image1 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif
    @if (isset($ad->image2))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $ad->image2 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif
    @if (isset($ad->image3))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $ad->image3 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif
    <div class="col-12">
        <div class="d-flex align-items-center">
        <h1 class="display-4">{{ $ad->title }}</h1>
        <button class="btn btn-success mx-5 px-5">
            <a href="{{ route('welcome') }}?cat={{ $category->name }}" class="text-light">{{ $category->name }}</a>
        </button>
        </div>
        <p class="py-5">{{$ad->body}}</p>
        <div class="row col-sm-2">
            <button class="float-left btn btn-warning py-2" disabled>{{ $ad->user->name }}</button>
            <button class="float-right btn btn-secondary py-2" disabled>Cena: {{ $ad->price }} rsd</button>
        </div>
        {{-- like --}}
        @if (auth()->check() && auth()->user()->id !== $ad->user_id)
        <div class="py-3">
            <form action="{{ route('like', $ad->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary float-left"><i class="fas fa-thumbs-up"></i> Like <span>{{ $likeCount }}</span> </button>
            </form>
        </div>
        @endif
    </div>

    @if (auth()->check() && auth()->user()->id !== $ad->user_id)
    <div class="row mt-3">
        <div class="col-6">
            <form action="{{ route('createMessage', ['id'=>$ad->id]) }}" method="POST">
                @csrf
                <textarea name="msg" class="form-control" placeholder="Send message to {{ $ad->user->name }}" cols="30" rows="10"></textarea><br>
                <button type="submit" class="btn btn-primary form-control">Send</button>
            </form>
            @error('msg')
            <p class="bg-warning">{{ $errors->first('msg') }}</p>
            @enderror
        </div>
    </div>
    @endif
@endsection
