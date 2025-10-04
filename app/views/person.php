<div class="column is-2"></div>

<div class="column is-8">
	<h1>{{ $person->get('name') }}</h1>

	<img src="{{ asset('img/avatars/' . $person->get('avatar')) }}" alt="avatar"/>

	<div>
		<h2>Bio</h2>

		<table>
			<thead>
				<tr>
					<td>Attribute</td>
					<td>Value</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Name</td>
					<td>{{ $person->get('name') }}</td>
				</tr>

				<tr>
					<td>Birthday</td>
					<td>{{ $person->get('birthday') ?? 'N/A' }}</td>
				</tr>

				<tr>
					<td>Notes</td>
					<td>{{ $person->get('notes') ?? 'N/A' }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div>
		<h2>Presents</h2>

		<table>
			<thead>
				<tr>
					<td>Title</td>
					<td>Description</td>
					<td>Delivered</td>
					<td>Rating</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($presents as $present)
				<tr>
					<td><a href="{{ url('/present/view/' . $present->get('id')) }}">{{ $present->get('title') }}</a></td>
					<td>{{ $present->get('description') }}</td>
					<td>{{ $present->get('delivered') }}</td>
					<td>{{ $present->get('rating') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<a class="button is-success" href="javascript:void(0);" onclick="window.vue.bShowAddPresent = true;">Add Present</a></span>
	</div>

	<div class="paragraph">
		<span><a class="button is-danger" href="javascript:void(0);" onclick="window.vue.deletePerson({{ $person->get('id') }});">Delete</a></span>
        <span><a class="button" href="javascript:void(0);" onclick="history.back();">Go back</a></span>
	</div>
</div>

<div class="column is-2"></div>
