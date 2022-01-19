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
				width: 100%;
				padding: 1rem 0;
				text-align: center;
			}
			.logo {
				margin: 0 auto;
			}
			.title {
				margin: 1rem;
				color: orange;
			}
			.content {
				margin: 0 auto;
				max-height: fit-content;
				max-width: 512px;
				padding: 1rem 2rem;
				background-color: #fafafa;
			}
			.content h3 {
				text-align: center;
                color: black;
			}
			.content p {
				text-align: justify;
				margin: 1rem 0;
                color: black;
			}
			.content .btn {
				display: inline-block;
				width: fit-content;
				padding: 0.5rem 1rem;
				background-color: #0d6efd;
				color: white;
				border-radius: 0.3rem;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<img
				class="logo"
				src="{{ $message->embed(asset('img/logo-2.png')) }}"
				alt="logo"
			/>
			<h2 class="title">Survei</h2>
			<div class="content">
				<h3>Hai {{ $name }}</h3>
				<p>
					Password Survei kamu dapat di atur ulang dengan mengklik
					tombol dibawah. Jika kamu merasa tidak meminta pengaturan
					ulang password, kamu dapat mengabaikan email ini.
				</p>
				<a
					class="btn"
					href="https://survey-kite.000webhostapp.com/reset-password/{{ $token }}"
					>Atur Ulang Password</a
				>
			</div>
		</div>
	</body>
</html>
