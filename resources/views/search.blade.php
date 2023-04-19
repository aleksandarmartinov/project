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
            <h1 class="text-center py-3">Svi Oglasi</h1>
            <section class="bg-light d-flex flex-wrap justify-content-center py-5" style="background-color: #eee; ">
              <div class="text-center container py-5">
                <div class="row">
                  @foreach ($ads as $ad)
                  <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card">
                      <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                        data-mdb-ripple-color="light">
                        <img src="/ad_images/{{ $ad->image1 }}" alt="{{ $ad->title }}"
                          class="w-100" />
                        <a href="#!">
                          <div class="mask">
                            <div class="d-flex justify-content-start align-items-end h-100">
                            </div>
                          </div>
                          <div class="hover-overlay">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                          </div>
                        </a>
                      </div>
                      <div class="card-body">
                        <a href="{{ route('singleAd', ['id' => $ad->id]) }}"" class="text-reset">
                          <h5 class="card-title mb-3">{{ $ad->title }}</h5>
                        </a>
                        <p><strong>{{ $ad->category->name }}</strong></p>
                        <h6 class="mb-3">{{ $ad->price }} rsd</h6>
                        <span><button class="btn btn-sm btn-outline-secondary" disabled>Vidjeno: {{ $ad->adViews->count() }}</button></span>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </section>
          </div>
        <div class="d-flex justify-content-end">
            {{ $ads->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
