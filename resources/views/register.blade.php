<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>E-Leges</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 mt-5 pt-5">
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">Login</h1>
							<form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                @csrf
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Nama</label>
									<input id="name" type="text" class="form-control" name="name" value="" required autofocus>
									<div class="invalid-feedback">
										Nama is invalid
									</div>
								</div>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Email Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="align-items-center">
                                    <div class="form-check">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block w-100">
                                        Login
                                    </button>
                                </div>
                                
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>