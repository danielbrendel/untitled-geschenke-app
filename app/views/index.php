<div class="column is-2"></div>

<div class="column is-8">
	<h1>People</h1>

	<div class="people">
		@foreach ($people as $person)
			<a href="{{ url('/person/view/' . $person->get('id')) }}">
				<div class="person" style="background-image: url('{{ asset('img/avatars/' . $person->get('avatar')) }}');">
					<div class="person-overlay">
						<div class="person-info">
							<div class="person-info-name">{{ $person->get('name') }}</div>
						</div>
					</div>
				</div>
			</a>
		@endforeach
	</div>

	<div class="paragraph">
		<a class="button is-success" href="javascript:void(0);" onclick="window.vue.bShowAddPerson = true;">Add Person</a>
	</div>
</div>

<div class="column is-2"></div>
