@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 py-5">
            @include('home.partials.sidebar')
        </div>
        <div class="col-8">
            <h1 class="text-center py-1">Dodajte Vas Oglas</h1>
            <form action="{{ route('home.saveAd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Title" value="{{old('title')}}" class="form-control @if($errors->has('title')) {{'is-invalid'}} @endif"><br>
                @error('title')
                <p class="bg-warning">{{ $errors->first('title') }}</p>
                @enderror
                <textarea name="body" placeholder="Body" class="form-control @if($errors->has('body')) {{'is-invalid'}} @endif" cols="30" rows="10">{{old('body')}}</textarea><br>
                @error('body')
                <p class="bg-warning">{{ $errors->first('body') }}</p>
                @enderror
                <input type="number" name="price" placeholder="Price" class="form-control @if($errors->has('price')) {{'is-invalid'}} @endif"><br>
                @error('price')
                <p class="bg-warning">{{ $errors->first('price') }}</p>
                @enderror
                <input type="file" name="image1" class="form-control @if($errors->has('price')) {{'is-invalid'}} @endif"><br>
                <p class="bg-warning invalid-feedback">One picture must be added at least</p>
                <input type="file" name="image2" class="form-control"><br>
                <input type="file" name="image3" class="form-control"><br>
                <select name="category" class="form-control form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
                </select><br>
                <button type="submit" class="btn btn-primary">Save</button>   
            </form>
        </div>
    </div>
</div>
@endsection