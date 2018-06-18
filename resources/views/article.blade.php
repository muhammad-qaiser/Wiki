@extends('layouts.app')
@section('title')
<title>Wiki -{{$article->title}} </title>
@stop

@section('aboutAuthor')
<li class="list-group-item">
    <h5>About Author</h5>
    <p>{{$user->name}} Joined Wiki on {{$user->created_at->toDateString()}}. {{$user->name}} have posted {{$userArticle->count()}} articles on Wiki so far.</p>
    @foreach($userArticle as $a)
        <a href="{{route('articleShow', ['id'=>$a->id])}}">{{$a->title}} </a></br>
    @endforeach
    
</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
        <h4 class="card-title">{{$article->title}}</h4>
        </div>
        <div class="card-body">

            <img class="card-img-top" style="height: 17rem; object-fit: cover;" src="{{ URL::asset($article->imagePath) }}" alt="Card image cap">
    
            <!-- Text -->
            
            <p class="card-text" style="margin-top:10px" >{{$article->content}}</p>
            

        </div>

        <div class="card-footer">
        <p ><small class="text-muted">Created at: {{$article->created_at}}</small>
            <small class="text-muted float-right">Last Updated: {{$article->updated_at}}</small>
            </p>
            <div class="centered text-center">
                @if($article->user_id == Auth::id())
                    <a href="{{route('articleEdit', ['id'=>$article->id])}}"  class="btn btn-sm btn-info ">Edit
                    </a>

                    <a href="{{route('articleDelete', ['id'=>$article->id])}}"  class="btn btn-sm btn-danger">Delete
                    </a>
                @endif
            </div>
        </div>
             
    
    </div>

          
@endsection
