<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/homelink/bootstrap/css/bootstrap.min.css">
        <style>
            td {
                vertical-align: baseline!important;
            }
		.progress {
			float: left!important;
			margin-right: 10px;
			margin-bottom: 0;
		}
        </style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/homelink/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.alert').alert();
	</script>
    </head>
    <body>
        <br />
        <div class="container">
            {$menu}
		<br />
            {$breadCrumbs}
            {$content}
        </div>
    </body>
</html>

