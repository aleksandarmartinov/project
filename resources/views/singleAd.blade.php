@extends('layouts.master')

@section('main')
<div class="row">
    @if (isset($single_ad->image1))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $single_ad->image1 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif
    @if (isset($single_ad->image2))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $single_ad->image2 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif    
    @if (isset($single_ad->image3))
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/ad_images/{{ $single_ad->image3 }}" class="img-fluid">
                </div>
            </div>
        </div>
    @endif
    <div class="col-12">
        <h1 class="display-4">{{ $single_ad->title }} <span class="btn btn-success"><a href="{{ route('welcome') }}?cat={{ $category->name }}" class="text-light">{{ $category->name }}</a></span> </h1>      
        <p>{{$single_ad->body}}</p><br>
        <div class="row col-sm-2">
        <button class="float-left btn btn-warning" disabled>{{ $single_ad->user->name }}</button>
        <button class="float-right btn btn-danger" disabled>{{ $single_ad->price }} rsd</button>
        </div>
        <br>
        {{-- like --}}
        @if (auth()->check() && auth()->user()->id !== $single_ad->user_id)
        <div class="card-body">
            <p class="card-text">Likes: {{ $likeCount }}</p>
            <form action="{{ route('like', $single_ad->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Like</button>
            </form>
        </div>
        @endif

    </div>

    @if (auth()->check() && auth()->user()->id !== $single_ad->user_id)
    <div class="row mt-3">
        <div class="col-6">
            <form action="{{ route('sendMessage', ['id'=>$single_ad->id]) }}" method="POST">
                @csrf
                <textarea name="msg" class="form-control" placeholder="Send message to {{ $single_ad->user->name }}" cols="30" rows="10"></textarea><br>
                <button type="submit" class="btn btn-primary form-control">Send</button>
            </form>
            @if (session()->has('AdMessage'))
                <div class="alert alert-success">
                    {{ session()->get('AdMessage') }}
                </div>
            @endif
        </div>
    </div>
    @endif
@endsection