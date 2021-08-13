@extends('layouts.app')
@section('title', 'Create Posts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('_partials.messages')
            <div class="card  mb-3">
                <div class="card-header">Create post</div>
                <div class="card-body text-primary">
                    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="text-dark" for="category">Select Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{old('title')}}"
                                   placeholder="Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="body">Text</label>
                            <textarea name="body" id="body" rows="3"
                                      class="form-control @error('body') is-invalid @enderror"
                                      placeholder="Text"
                            >{{old('body')}}</textarea>

                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="file">Picture (optional)</label>
                            <input type="file" id="file" class="form-control @error('file') is-invalid @enderror"
                                   name="file"
                                   >

                            @error('file')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary mb-4 mt-3" data-toggle="modal"
                                data-target="#exampleModal">
                            Attach tags
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tags</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            @foreach($tags as $tag)

                                                <label class="checkbox" for="">{{ $tag->name }}
                                                    <input class="mr-3" type="checkbox" name="tags[]" value="{{ $tag->id
                                                     }} ">
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">OK</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a class="btn btn-outline-primary" href="{{route('posts.index')}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
