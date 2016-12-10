@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Auth::guest())
                <h2>{{$title}}</h2>
                @if( !$posts->count() )
                    <p>There is no post till now. Login and write a new post now!!!</p>
                @endif
            @else
                @if(!$posts->count())
                    <p>There is no post till now. Write a new post now.</p>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Add a blog post</h5>
                    </div>

                    <div class="panel-body">
                        <form class="form" method="POST" action="/home/post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="content" placeholder="What's on your mind?" class="form-control" required=""></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <input type="file" name="file_upload" class="form-control"> --}}
                                {{-- <p class="help-block"></p> --}}
                            {{-- </div> --}}
                            <input type="submit" value="Post" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            @endif

            <ul class="list-group">
                @foreach($posts as $post)
                    @if($post->active == 1)
                    <li class="list-group-item">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{-- {{$user->where('id','=',$post->user_id)->get()[0]['name']}} --}}
                                    {{-- <a href="#" class="btn btn-sm"><span class="glyphicon glyphicon-pencil"></span></a> --}}
                                    <a href="/profile/{{$post->user->id}}">{{ $post->user->name }}</a>
                                    @if(Auth::id() == $post->user->id)
                                        <a href="/{{$post->id}}/edit" class="btn btn-info pull-right" style="margin-top: -7px">Edit Post</a>
                                    @endif
                            </div>

                            <div class="panel-body">
                                <article>
                                    <div class="content">
                                        {{ $post->content }}
                                        {{-- <p><img src="images/1.jpg" alt="" width="500" height="500"></p> --}}
                                    </div>
                                </article>
                                <footer>
                                    <br/>
                                    Posted {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}}
                                    <p>{{ $post->getNumCommentsStr()}}</p>
                                </footer>
                            </div>
                            <div class="panel-footer">
                                @if($comments)
                                    @foreach($post->comment_post as $comment)
                                        <section id="comments">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="/profile/{{$comment->user_id}}">{{$user->where('id','=',$comment->user_id)->get()[0]['name']}}</a> says...
                                                </div>
                                                <div class="panel-body">
                                                    {{ $comment->comment }}
                                                    <br />
                                                    Posted {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </section>
                                    @endforeach
                                @endif
                                @if(Auth::guest())
                                    <p>Login to comment</p>
                                @else
                                    <form action="/home/comment" class="form" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="form-group">
                                            <textarea name="comment" placeholder="Write your comment here." class="form-control"></textarea>
                                        </div>
                                        <input type="submit" value="Comment" class="btn btn-primary">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </li>
                    <hr />
                    @endif
                @endforeach
                {{ $posts->links() }}
            </ul>
        </div>
    </div>
</div>
@endsection