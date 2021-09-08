@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('layouts.flash')
<div id="carouselExampleControls" class="carousel slide mb-3" data-ride="carousel">
  <div class="carousel-inner" style="height: 500px">
    <div class="carousel-item active">
      <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="..." style="height:500px">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="..." style="height:500px">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="..." style="height:500px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<h4 class="display-4 text-center text-bold">Produk Kami</h4>
<div class="container mt-5">
    <div class="row">
        @foreach($recentProducts as $product)
        <div class="col-sm-3">
            <div class="card">
                <img src="{{ asset('images/product' . '/' . $product->file) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="" class="btn btn-success">Detail</a>
                        </div>
                        <div class="col-sm-8">
                            <a href="{{ route('cartUserCreate', ['id' => $product->id]) }}" class="btn btn-primary">+
                                Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Testimonial Section -->
<h4 class="display-4 text-center text-bold mt-5">Testimonial Kami</h4>
<div class="container mt-5">
    <div class="row">
        @foreach($recentTestimonials as $testimonial)
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $testimonial->user->name }}</h5>
                    <p class="lead">" <em>{{ $testimonial->text }}</em> "</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
