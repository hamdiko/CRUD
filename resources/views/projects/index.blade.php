@extends('layouts.app')
@section('content')
	<div class="container">

		<h3>My Projects</h3>
		<div>
			<a style="margin: 19px;" href="{{ route('projects.create')}}" class="btn btn-primary">
				New Project
			</a>
		</div>
		<ul>
		@foreach($projects as $project)
			<li><a href="/projects/{{$project->id}}">{{$project->title}}</a></li>
		@endforeach
		</ul>
	</div>
@endsection
