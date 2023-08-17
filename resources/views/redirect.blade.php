@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="height: 75vh;">
    <div class="text-center">

    @if($url->is_active)

        <h1>Redirecting to {{$url->website}}</h1>

        <h3>Original Url: <a href="{{$url->url}}">{{$url->url}}</a></h3>

        <a href="{{$url->url}}"><button class="btn btn-primary mr-1">Proceed</button></a>

    @else

        <h1>Sorry, this url is deactivated</h1>

    @endif

    </div>
</div>
@endsection
