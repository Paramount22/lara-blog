@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('_partials.messages')
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    All Tags
                    <a href="{{route('tags.create')}}">New tag</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tags as $key=> $tag)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{ $tag->name  }}</td>
                                <td><a href="{{route('tags.edit', $tag)}}">
                                        <button class="btn btn-sm btn-outline-success">Edit</button>
                                    </a>
                                </td>

                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#exampleModal-{{$tag->id}}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{$tag->id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{route('tags.destroy', $tag)}}" method="POST">
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
                                                        Category will be deleted.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="alert alert-secondary" role="alert">
                                No tags yet!
                            </td>
                        @endforelse

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
