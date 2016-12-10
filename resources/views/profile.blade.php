@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>{{ $user->name }}</h4>
				</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-heading">
							Joined on {{$user->created_at->format('M d, Y \a\t h:i a') }}
						</div>
						<div class="panel-body">
							<style>
								.table-padding td{
									padding: 3px 8px;
								}
							</style>
							<table class="table-padding">
								<tr>
									<td>Total Posts</td>
									<td> {{$posts_count}}</td>
								</tr>
								<tr>
									<td>Total Comments</td>
									<td>{{ $comments_count }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Latest Posts</h4>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						@foreach($posts as $post)
						<li class="list-group-item">
							<div class="panel panel-default">
								<div class="panel-body">
									<article>
										<div class="content">
											{{$post->content}}
										</div>
									</article>
									<footer>
										<br/>
										Posted {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}}
										<p>{{ $post->getNumCommentsStr()}}</p>
									</footer>
								</div>
							</div>
						</li>
						@endforeach
						{{ $posts->links() }}
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection