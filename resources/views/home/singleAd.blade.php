@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8">
            <h3 class="text-center">{{ $single_ad->title }}</h3>

            <div class="row p-3">
                    @if (isset($single_ad->image1))
                        <div class="col-6 offset-3">
                            <img id="main-image" src="/ad_images/{{ $single_ad->image1 }}" class="img-fluid">
                        </div>
                    @endif
                <div class="col-6 offset-3">
                    <div class="row">
                        @if (isset($single_ad->image2))
                        <div class="col-6">
                            <img src="/ad_images/{{ $single_ad->image2 }}" class="thumb img-fluid">
                        </div>
                        @endif
                        @if (isset($single_ad->image3))
                        <div class="col-6">
                            <img src="/ad_images/{{ $single_ad->image3 }}" class="thumb img-fluid">
                        </div>
                        @endif
                    </div>
                </div>
            </div><br>
            <div class="row p-3">
                <h4>{{ $single_ad->body }}</h4>
            </div><br>
            <div class="row p-3">
                <form action="{{ route('home.delete', ['id'=>$single_ad->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="col-2 btn btn-danger float-start">Obrisi Oglas</button>
                </form>
                <span class=""><a href="{{ route('home.edit', ['id'=>$single_ad->id]) }}" class="btn btn-warning">Izmeni Oglas</a></span>
            </div>      
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
    <script>
        let thumbs = document.querySelectorAll('.thumb');
        for (let i = 0; i < thumbs.length; i++) {
            const thumb = thumbs[i];
            thumb.addEventListener('click',function() {
                let mainImg = document.querySelector('#main-image');
                let mainImgSrc = mainImg.getAttribute('src');
                let src = this.getAttribute('src');
                mainImg.setAttribute('src',src);
                this.setAttribute('src',mainImgSrc);
            })
        }
    </script>
@endsection