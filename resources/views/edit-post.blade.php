@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Post
					</div>
					<div class="panel-body">
						<form method="post" action="edit">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<input type="hidden" name="post_id" value="{{ $post->id }}">
							<div class="form-group">
								<textarea name="content" class="form-control">{{ $post->content }}</textarea>
							</div>
							<div class="form-group">
								<input type="submit" name='save' class="btn btn-primary"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection