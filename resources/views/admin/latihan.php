<!DOCTYPE html>
<html>
<head>
	<title>TES</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">
	<table class="table table-bordered" id="table">
		<thead>
			<tr>
				<th>A</th>
				<th>B</th>
				<th>C</th>
				<th>D</th>
				<th>E</th>
			</tr>
		</thead>
	</table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$('#table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "/latihan",
    })
</script>
</body>
</html>