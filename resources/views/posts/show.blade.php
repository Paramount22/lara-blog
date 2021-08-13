@extends('layouts.app')
@section('title', $post->title)

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3" id="post-{{$post->id}}">
                <h3 class="card-header">{{$post->title}}</h3>
                @if ( $post->file )
                    <img src="{{asset('images')}}/{{$post->file}}" alt="{{$post->title}}">
                @else
                    <img src="{{asset('no-image')}}/no-image.jpg" alt="No image">
                @endif
                <div class="card-body">
                    <div class="post-info d-flex justify-content-between align-items-center">
                        <p class="card-text">
                            <span class="badge bg-primary text-white">{{$post->category->name}}</span>

                        </p>

                        <p class="card-text">
                            {{$post->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <p class="card-text large-text"> {!! nl2br($post->body) !!} </p>
                </div>

                <div class="card-body">

                    <a href="{{route('posts')}}" class="card-link">Back</a>
                </div>

                <div class="card-body">
                    @include('_partials.tags')
                </div>
                <div class="card-footer text-muted">
                    @<strong>{{$post->user->name}}</strong>
                </div>
            </div>

        </div>
    </div>




@endsection
