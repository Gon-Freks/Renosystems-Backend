@extends('layouts.app')
@section('content')
<div class="container">
   <h1 class="display-4 text-center">ShortIt</h1>
   <p class="lead text-center">Shorten your long URLs to make them easier to share</p>
   <form action="url"  method="POST" >
      @csrf
      <div class="row mb-3">
         <label for="website" class="col-md-4 col-form-label">Website Name</label>
         <input id="website" 
            type="text"
            class="form-control @error('website') is-invalid @enderror" 
            name="website" 
            value="{{ old('website')}}"  
            autocomplete="website" 
            autofocus>
         @error('website')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="row mb-3">
         <label for="url" class="col-md-4 col-form-label">Url</label>
         <input id="url" 
            type="text"
            class="form-control @error('url') is-invalid @enderror" 
            name="url" 
            value="{{ old('url')}}"  
            autocomplete="url" 
            autofocus>
         @error('url')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="row pt-4 justify-content-center">
         <button class="btn btn-primary w-25">Shorten</button>
      </div>
   </form>


   <div style="padding-top: 100px">
      <table class="table table-hover table-bordered">
         <thead>
            <tr>
               <th scope="col" style="text-align: center;">#</th>
               <th scope="col" style="text-align: center;">Website</th>
               <th scope="col" style="text-align: center;">Clicks</th>
               <th scope="col" style="text-align: center;">Short URL</th>
            </tr>
         </thead>
         <tbody>

            @foreach ($urls as $url)

                <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td style="text-align: center;">{{$url->website}}</td>
                <td style="text-align: center;">{{$url->clicks}}</td>
                <td>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{$url->short_url}}" class="mr-2" >{{$url->short_url}}</a>
                        <div class="d-flex align-items-center">
                            <a href="/url/{{$url->id}}/edit"><button class="btn btn-primary mr-1">Edit</button></a>

                            <span>
                                <form action="/url/{{$url->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </span>
                            
                        </div>
                    </div>
                </td>
                </tr>

            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
