<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('') ?>assets/" data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Login Admin">
	<meta name="author" content="Admin">
	<title>Login</title>

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>>" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
	<!-- Icons. Uncomment required icon fonts -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/vendor/fonts/boxicons.css" />
	<!-- Core CSS -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url('') ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url('') ?>assets/css/demo.css" />
	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<!-- Page CSS -->
	<!-- Page -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/vendor/css/pages/page-auth.css" />
	<!-- Helpers -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr/toastr.min.css">
	<script src="<?= base_url('') ?>assets/vendor/js/helpers.js"></script>
	<script src="<?= base_url('') ?>assets/js/config.js"></script>
</head>

<body>
	<!-- Content -->

	<div class="container-xxl">

		<div class="authentication-wrapper authentication-basic container-p-y">

			<div class="authentication-inner">

				<!-- Register -->
				<div class="card">
					<div class="card-body">
						<!-- Logo -->
						<div class="text-center">
							<img src="<?= base_url('images/spk.png'); ?>" width="180" alt="" />
						</div>
						<div class="app-brand justify-content-center mt-2">

							<a href="<?= base_url(); ?>" class="app-brand-link gap-2">

								<span class="app-brand-text demo text-body fw-bolder">Login</span>
							</a>
						</div>
						<!-- /Logo -->

						<form id="formLogin" class="mb-3" onsubmit="auth(event, this)">
							<div class="mb-3 form-group">
								<label for="username" class="form-label"> Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus required />
							</div>
							<div class="mb-3 form-password-toggle form-group">
								<div class="d-flex justify-content-between">
									<label class="form-label" for="password">Password</label>
								</div>
								<div class="input-group input-group-merge">
									<input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
									<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
								</div>
							</div>
							<div class="mb-3">
								<button class="btn btn-primary d-grid w-100" type="submit" id="btn-submit">Log in</button>
							</div>
						</form>

						<!-- <p class="text-center">
							<span><b><= $title ?></b></span>
						</p> -->
					</div>
				</div>
				<!-- /Register -->
			</div>
		</div>
	</div>

	<!-- / Content -->

	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->

	<script src="<?= base_url('') ?>assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?= base_url('') ?>assets/vendor/libs/popper/popper.js"></script>
	<script src="<?= base_url('') ?>assets/vendor/js/bootstrap.js"></script>
	<script src="<?= base_url('') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>
	<script src="<?= base_url('assets/js/') ?>jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>assets/toastr/toastr.min.js"></script>
	<script src="<?= base_url('') ?>assets/vendor/js/menu.js"></script>
	<script src="<?= base_url('') ?>assets/js/main.js"></script>
	<script type="text/javascript">
		function auth(e, t) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "<?= base_url('login/proses') ?>",
				data: new FormData(t),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				beforeSend: function() {
					$('#btn-submit').html('<span class="text-center"><i class="spinner-border spinner-border-sm"></i> Loading...</span>')
					$('#btn-submit').attr('disabled', '');
					$('.form-control').attr('disabled', '');
				},
				success: function(response) {
					$('#btn-submit').html('Log in');
					$('#btn-submit').removeAttr('disabled');
					$('.form-control').removeAttr('disabled');

					if (response.status) {
						toastr.success(response.message);
						setTimeout(function() {
							window.location.href = response.url;
						}, 1200);
					} else {
						toastr.warning(response.message);
					}
				},
				error: function(response) {
					$('#btn-submit').removeAttr('disabled');
					$('.form-control').removeAttr('disabled');
					$('#btn-submit').html('Log in');
					$('#password').val('');

					let data = JSON.parse(response.responseText);
					toastr.warning(data.message);
				}
			});
		}
	</script>
</body>

</html>