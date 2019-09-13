@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">
    @if(count($posts)== 0)
        <div class="text-center">
            <h1>Está vazio!!</h1><br>
            <h2>Crie um Postagem e compartilhe com o mundo!</h2><br>
            <h3>\(◉⩊◉)/</h3>
        </div>
    @else
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="" style="text-transform:capitalize;">{{$post->name}}</h3>
                        <img class="card-img-top" src="{{$post->image_path}}" alt="Card image cap" style="padding:10%;">
                        <p>Descrição: {{$post->description}}</p> 
                    @if($post->user_id =! auth()->user()->id)
                        <a class="btn" href="{{route('like', ['idPost' => $post->id])}}">
                            {{$post->like}} Like: <img width="110%" src="{{ asset('images/like.svg') }}">
                        </a>
                    @else
                        <a class="btn" href="{{route('unlike', ['idPost' => $post->id])}}">
                            {{$post->like}} Dislike: <img width="75%" src="{{ asset('images/dislike.svg') }}">
                        </a>
                    @endif
                    <p>Comentarios:</p>
                        <form action="{{route('comments')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="text">
                            </div>
                            <input type="hidden" value="{{$post->id}}" name="post_id">
                            <button type="submit" class="btn btn-dark">Comentar</button>
                        </form>
                        @foreach($comment as $comments)
                            @if ($comments->post_id == $post->id)
                                <p>{{$comments->text}}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach   
        </div>
    @endif
</div>

</div>

@endsection