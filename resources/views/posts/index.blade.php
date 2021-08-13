@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @include('_partials.messages')
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    Posts
                    <a href="{{route('posts.create')}}">New post</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Text</th>
                            <th scope="col">Category</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $key=> $post)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    @if($post->file)
                                        <img src="{{asset('images')}}/{{$post->file}}" alt="{{$post->title}}"
                                             width="100">
                                    @else
                                        <img src="{{asset('no-image')}}/no-image.jpg" alt="No image" width="100">
                                    @endif

                                </td>
                                <td><a href="{{route('posts.show', $post)}}">{{ $post->title  }}</a> </td>
                                <td>{{ Str::limit($post->body, 30)   }}</td>

                                <td> <span class="badge badge-info">{{ $post->category->name  }}</span> </td>


                                <td class="tags-widt">
                                    @include('_partials.tags')
                                </td>

                                <td><a href="{{route('posts.edit', $post)}}">
                                        <button class="btn btn-sm btn-outline-success">Edit</button>
                                    </a>
                                </td>

                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#exampleModal-{{$post->id}}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{$post->id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{route('posts.destroy', $post)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Item will be deleted.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="alert alert-secondary" role="alert">
                                No posts yet!
                            </td>
                        @endforelse

                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
