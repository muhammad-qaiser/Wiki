@extends('layouts.app')

@section('title')
<title>Wiki - Write Article</title>
@stop

@section('content')
    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>

    @endif



    <div class="panel panel-default">
        <div class="panel-heading text-center">
        <h4 class="text-cente">Share Ideas!!! </h>
        
        </div>
        <div class="panel-body">
            <form action="/saveArticle" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <textarea rows="5" cols="5" placeholder="Write Here..." name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tag_id" id="tags" class="form-control">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <input type="hidden" name="user_id" value="{{Auth::id()}}" />
                        <button class="btn btn-success" type="submit">Publish</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


@stop