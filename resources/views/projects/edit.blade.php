@extends('layouts.app');
@section('content')

	<div class="container">
		<h3>Edit Project</h3>
		<form action="/projects/{{$project->id}}" method="post">
			@method('patch')
			@csrf
			<div class="form-group">
				<label for="exampleInputEmail1">Title</label>
				<input type="text" name="title" class="form-control" id="name" value="{{$project->title}}">
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Description</label>
				<textarea class="form-control" id="description" name="description" rows="3"> {{$project->description}}</textarea>
			</div>

			<button type="submit" class="btn btn-primary">Update Project</button>
		</form>
		<form action="/projects/{{$project->id}}" method="post">
			@method('delete')
			@csrf
			<button type="submit" class="btn btn-danger">Delete Project</button>
		</form>
	</div>
@endsection