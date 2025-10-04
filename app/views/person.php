<div class="column is-2"></div>

<div class="column is-8">
	<h1>{{ $person->get('name') }}</h1>

	<p>To be defined...</p>

	<div class="paragraph">
		<span><a class="button is-danger" href="javascript:void(0);" onclick="window.vue.deletePerson({{ $person->get('id') }});">Delete</a></span>
        <span><a class="button" href="javascript:void(0);" onclick="history.back();">Go back</a></span>
	</div>
</div>

<div class="column is-2"></div>
