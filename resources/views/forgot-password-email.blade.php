<html>

<head>
    <style>
        * {
            color: black;
        }

        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            max-height: fit-content;
            max-width: fit-content;
            text-align: center;
            padding: 2rem;
            line-height: 2rem;
            background-color: #ccc;
            border-radius: 1.5rem;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Selamat Datang di Website Survei</h3>
        <img src="https://svgshare.com/s/dSJ" alt="logo">
        <p style="color: #F8B94A; font-size: 1.2em; letter-spacing: .03em; font-weight: bold;">Survey</p>
        <p>Silahkan klik link di bawah ini untuk menyelesaikan verifikasi akunmu</p>
        <a href="http://survey-in.test/reset-password/{{ $token }}" style="background: #3F4FC8; border-radius: .5em; padding: 1rem 2rem; border-radius: 4px; text-decoration: none;
        color: white;
">Verifikasi</a>
    </div>
</body>

</html>