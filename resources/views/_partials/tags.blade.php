@if( $post->tags )
    @foreach($post->tags as $tag)
        <span class="badge bg-info text-white">{{$tag->name}}</span>
    @endforeach
@endif
