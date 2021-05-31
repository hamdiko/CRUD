@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				@if(session()->get('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
				@endif
			</div>
			<div class="col-sm-12">

				<h3>Registrants</h3>

				<div>
					<a style="margin: 19px;" href="{{ route('registrants.create')}}" class="btn btn-primary">New
						Registrant</a>
				</div>
				<table class="table table-striped">
					<thead>
					<tr>
						<td>ID</td>
						<td>Name</td>
						<td>Email</td>
						<td>Job Title</td>
						<td>City</td>
						<td>Country</td>
						<td colspan=2>Actions</td>
					</tr>
					</thead>
					@if(!empty($registrants))
						<tbody>
						@foreach($registrants as $registrant)
							<tr>
								<td>{{$registrant->id}}</td>
								<td>{{$registrant->first_name}} {{$registrant->last_name}}</td>
								<td>{{$registrant->email}}</td>
								<td>{{$registrant->job_title}}</td>
								<td>{{$registrant->city}}</td>
								<td>{{$registrant->country}}</td>
								<td>
									<a href="{{ route('registrants.edit',$registrant->id)}}" class="btn btn-primary">Edit</a>
								</td>
								<td>
									<form action="{{ route('registrants.destroy', $registrant->id)}}" method="post">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger" type="submit">Delete</button>
									</form>
								</td>
							</tr>
						@endforeach

						</tbody>
					@else
						<tfoot>
						<tr>
							<td colspan="8">No data</td>
						</tr>
						</tfoot>
					@endif
				</table>
				<div>
				</div>
			</div>
		</div>
		<flash class="alert-flash" message="{{ session('flash') }}" ></flash>
	</div>

@endsection