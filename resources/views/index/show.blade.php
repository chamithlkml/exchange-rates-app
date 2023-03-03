<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exchange Rates</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	@vite('resources/css/app.css')
</head>
<body>
	<div id="app"></div>
	<script>
		var currencies = {!! json_encode($currencies) !!};
	</script>
	@vite('resources/js/app.js')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</html>