<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
			:root {
				font-family: Arial, Helvetica, sans-serif;
				line-height: 1.5rem;
			}
			* {
				margin: 0;
				padding: 0;
				box-sizing: 0;
			}
			.container {
				position: relative;
				height: 100vh;
				text-align: center;
				font-size: 1em;
			}
			.content {
				inset: 0;
				margin: auto;
				position: absolute;
				max-width: 360px;
				height: fit-content;
				padding: 1rem;
			}
			.content p {
				text-align: center;
				margin: 1rem 0;
			}
			.content a {
				color: #0d6efd;
			}
			.content a:hover {
				color: #33f;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<img src="{{ asset('img/logo-2.png') }}" alt="logo" />
				<p>
					Email untuk mengatur ulang password telah dikirim, harap cek
					email anda.
				</p>
				<a href="http://survey-in.test/">Kembali ke halaman login</a>
			</div>
		</div>
	</body>
</html>
