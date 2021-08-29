@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('layouts.flash')
<div class="jumbotron jumbotron-fluid"
    style="background-image: url('{{ asset('images/jumbotron.jpeg') }}'); background-size: cover; height: 600px; background-position: center">
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
