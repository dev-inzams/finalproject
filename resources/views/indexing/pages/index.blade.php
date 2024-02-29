@extends('indexing.layout.app')
@section('title', 'Home - JobPulse')
@section('content')
<div class="container mt-5">
 @include('indexing.components.hero-slider')
</div>


@include('indexing.components.job-card')
@include('indexing.components.canidate-card')
@include('indexing.components.job-category')
@endsection
