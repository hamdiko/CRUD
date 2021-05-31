@extends('layouts.app');
@section('content')

	<div class="container">
		<h3>Create Project</h3>
		@include('includes.errors')
		<form action="/projects" method="post">
			@csrf
			<div class="form-group">
				<label for="exampleInputEmail1">Title</label>
				<input type="text" name="title" class="form-control {{$errors->has('title')?'is-invalid':''}}" id="name" value="{{old('title')}}" required>
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Description</label>
				<textarea class="form-control {{$errors->has('description')?'is-invalid':''}}" id="description" name="description" rows="3" required>{{old('description')}}</textarea>
			</div>

			<button type="submit" class="btn btn-primary">Create Project</button>
		</form>

	</div>
@endsection