<!doctype html>
<html lang="{{ getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-with, initial-scale=1.0">
		
		<title>{{ env('APP_NAME') }}</title>

		<link rel="stylesheet" type="text/css" href="{{ asset('css/bulma.css') }}"/>

		<script src="{{ asset('js/vue.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
	</head>
	
	<body>
		<div id="app">
			@include('navbar.php')

			<div class="container">
				<div class="columns">
					{%content%}
				</div>
			</div>

			<div class="modal" :class="{'is-active': bShowAddPerson}">
				<div class="modal-background is-almost-not-transparent"></div>
				<div class="modal-card">
					<header class="modal-card-head is-stretched">
						<p class="modal-card-title">Add Person</p>
						<button class="delete" aria-label="close" onclick="vue.bShowAddPerson = false;"></button>
					</header>
					<section class="modal-card-body is-stretched">
						<form id="frmAddPerson" method="POST" action="{{ url('/person/add') }}">
							@csrf 

							<div class="field">
								<label class="label">Name</label>
								<div class="control">
									<input type="text" class="input" name="name" placeholder="Enter name..."/>
								</div>
							</div>

							<div class="field">
								<label class="label">Birthday</label>
								<div class="control">
									<input type="date" class="input" name="birthday"/>
								</div>
							</div>
						</form>
					</section>
					<footer class="modal-card-foot is-stretched">
						<button class="button is-success" onclick="document.getElementById('frmAddPerson').submit();">Add</button>
						<button class="button" onclick="vue.bShowAddPerson = false;">Close</button>
					</footer>
				</div>
			</div>
		</div>
	</body>
</html>