<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Merxpress</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            font-size: 16px;
        }
        span {
            color: #e74c3c; /* Example color for emphasis */
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            h1 {
                font-size: 24px;
            }
            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to Merxpress</h1>
    <p>Hey {{ $name }}</p>
    <p>We at Merx<span class=''>press</span> would like to welcome you to our platform. We are excited to have you on board!</p>
</body>
</html>