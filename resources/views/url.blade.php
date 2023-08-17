@extends('layouts.app')

@section('content')
<div class="container">

    
    <form action="/url/{{$url->id}}"  method="POST" >
        
        @method('PATCH')
        @csrf

        <div class="row">
            <h2> Edit Url</h2>
        </div>

        <div class="row mb-3">
            <label for="website" class="col-md-4 col-form-label">Website Name</label>
            <input id="website" 
            type="text"
            class="form-control @error('website') is-invalid @enderror" 
            name="website" 
            value="{{ old('website') ?? $url->website}}"  
            autocomplete="website" 
            autofocus>
        
            @error('website')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <div class="row mb-3">
            <label for="url" class="col-md-4 col-form-label">Original Url</label>
            <input id="url" 
            type="text"
            class="form-control @error('url') is-invalid @enderror" 
            name="url" 
            value="{{ old('url')  ?? $url->url}}"  
            autocomplete="url" 
            autofocus>
        
            @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
             @enderror

        </div>


        <div class='row'>

            <div class="form-check">
            <input type="radio" id="activate" name="url_status" value="active" class="form-check-input" {{$url->is_active ? 'checked' : ''}}>
            <label for="activate" class="col-md-4 col-form-label">Activated</label><br>
            </div>

            <div class="form-check">
            <input type="radio" id="deactivate" name="url_status" value="deactive" class="form-check-input" {{$url->is_active ? '' : 'checked'}}>
            <label for="deactivate" class="col-md-4 col-form-label">Deactivated</label><br>
            </div>

        </div>

        <div class="row pt-4">
            <button class="btn btn-primary">Save Url</button>
        </div>
    
    </form>
   
</div>
@endsection
