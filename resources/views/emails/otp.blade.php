<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 40px;">
<div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px;">
    <h2 style="color: #2c3e50;">RateMyApartment Verification</h2>
    <p style="font-size: 16px; color: #555;">
        Hi there! 👋 <br><br>
        Use the following One-Time Password (OTP) to complete your login:
    </p>

    <h1 style="text-align: center; letter-spacing: 5px; font-size: 36px; color: #3498db; margin: 20px 0;">
        {{ $otp }}
    </h1>

    <p style="font-size: 15px; color: #555;">
        This code will expire in <strong>5 minutes</strong>. Please do not share it with anyone.
    </p>

    <p style="font-size: 14px; color: #999; margin-top: 30px;">
        &copy; {{ date('Y') }} RateMyApartment. All rights reserved.
    </p>
</div>
</body>
</html>
