<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
	<script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
</head>
<body>
	<div class="container">
		<div class="nav"><h1>{{ $title }}</h1></div>
		<dir class="row">
			<div class="col-md-12">
				<div class="col-md-8">
					<form action="addone" method="post">
						@csrf
						<div class="form-group">
							<label for="goods_name">Goods Name</label>
							<input type="text" name="goods_name" class="form-control" placeholder="required" id='goods_name'>
						</div>
						<div class="form-group">
							<label for="price">Price</label>
							<div class="input-group">
						  		<span class="input-group-addon">$</span>
						  		<input type="text" name="price" id="price" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="required">
						  		<span class="input-group-addon">.00</span>
							</div>
						</div>
						<div class="form-group">
							<label for="disprice">Discout Price</label>
							<div class="input-group">
						  		<span class="input-group-addon">$</span>
						  		<input type="text" name="disprice" id="disprice" class="form-control" aria-label="Amount (to the nearest dollar)">
						  		<span class="input-group-addon">.00</span>
							</div>
						</div>
						<div class="form-grop">
							<button type="submit" class="btn btn-danger">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</dir>
	</div>
</body>
</html>