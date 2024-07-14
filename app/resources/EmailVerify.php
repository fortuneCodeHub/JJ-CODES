<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verify Document</title>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
    <style>
        :root {
            --bg-black: black;
            --hover-blue: #4154f1;
            --bg-blue: #012970;
            --bg-blue2: #0d6efd;
            --whitelight: #ebebeb;
            --white: #ffffff;
            --bg-dark: #212529;
        }
        .fw-700 {
            font-weight: 700;
        }
        .fw-600 {
            font-weight: 600;
        }
        .fw-500 {
            font-weight: 500;
        }
        .verify {
            color: var(--white);
            background-color: var(--bg-dark);
            border: 2px solid var(--bg-blue2);
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 10px;
        }
        .head-brand {
            font-size: 12px;
            color: var(--white);
            font-weight: 700;
        }
        .head-brand span {
            font-size: 25px;
        }
    </style>
<body>

    <div class="container bg-black py-5">
        <div style="text-align: center;">
            <p class="head-brand" href="#"><span>JJ</span>-CODES</p>
        </div>
        <p class="fw-700 text-white mb-1">Woohoo! Welcome to JJ-CODES.</p>
        <p class="fw-600 text-white mb-1">Thanks for signing up with us.</p>
        <p class="fw-500 text-white mb-1">Click the link below to verify your email</p>
        <div class="my-3 py-3">
            <a href="<?=$url?>" class="verify" target="_blank" rel="noopener noreferrer">Verify Now</a>
        </div>
        <div class="mt-2 mb-2">
            <p class="my-2 text-white">Or copy the link below and paste in chrome browser</p>
            <p class="my-2 text-white"><?=$url?></p>
        </div>
        <div class="mt-2 mb-1 text-white">
            <p>Thanks <?=APPNAME?></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>