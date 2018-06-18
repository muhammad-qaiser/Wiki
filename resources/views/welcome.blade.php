@extends('layouts.app')
@section('title')
<title>Wiki </title>
@stop
@section('content')

    <div class="card">
        <div class="card-header">Articles</div>
        
        
    </div>

    <div class="container ">
        <div class="row">
            @foreach($articles as $article)
            <a href="{{route('articleShow', ['id'=>$article->id])}}">
            <div class="col-sm-6 col-md-4 " style="margin-top: 10px;">
                <!-- Card -->
                <div class="card h-100" >

                <!-- Card image -->
                
                <img class="card-img-top" style="height: 12rem; object-fit: cover;" src="{{ URL::asset($article->imagePath) }}" alt="Card image cap">
                <!-- Card content -->
                <div class="card-body" style="height: 10rem; overflow:hidden;">

                <!-- Title -->
                <h5 class="card-title"><a>{{$article->title}}</a></h5>
                <!-- Text -->
                
                <p class="card-text" >{{$article->content}}</p>
                

                </div>
                <div class="card-footer">
                <!-- Button -->
                <p><small class="text-muted">{{$article->updated_at}} 
                </small>
                @if($article->user_id == Auth::id())
                    <a href="{{route('articleEdit', ['id'=>$article->id])}}"  class="btn btn-sm btn-info float-right">Edit
                    </a>
                @endif</p>
                </div>

                </div>
                <!-- Card -->
            </div>
            </a>
            @endforeach

        
        </div>
    </div>
    
@endsection
