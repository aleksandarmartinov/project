@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8">
            <h3 class="text-center">{{ $ad->title }}</h3>

            <div class="row p-3">
                    @if (isset($ad->image1))
                        <div class="col-6 offset-3">
                            <img id="main-image" src="/ad_images/{{ $ad->image1 }}" class="img-fluid">
                        </div>
                    @endif
                <div class="col-6 offset-3">
                    <div class="row">
                        @if (isset($ad->image2))
                        <div class="col-6">
                            <img src="/ad_images/{{ $ad->image2 }}" class="thumb img-fluid">
                        </div>
                        @endif
                        @if (isset($ad->image3))
                        <div class="col-6">
                            <img src="/ad_images/{{ $ad->image3 }}" class="thumb img-fluid">
                        </div>
                        @endif
                    </div>
                </div>
            </div><br>
            <div class="row p-3">
                <h4>{{ $ad->body }}</h4>
            </div><br>
            <div class="row p-3">
                <div class="col-6">
                    <button class="btn btn-warning"><a href="{{ route('home.edit', ['id'=>$ad->id]) }}" class="btn btn-warning">Izmeni Oglas</a></button>
                </div>
                <div class="col-6">
                    <form action="{{ route('adDelete', ['id'=>$ad->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger float-end" onclick="return confirm('Are you sure you want to delete this post?')">Obrisi Oglas</button>
                    </form>
                </div>
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