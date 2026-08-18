<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome to {{ config('app.name') }}</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 15px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: #0d6efd;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .content {
            padding: 35px 30px;
        }

        .content h2 {
            margin-top: 0;
            color: #212529;
        }

        .content p {
            font-size: 15px;
            line-height: 1.7;
        }

        .user-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .user-info p {
            margin: 8px 0;
        }

        .btn {
            display: inline-block;
            background: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 15px;
        }

        .footer {
            background: #f8f9fa;
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="email-wrapper">

    <div class="email-container">

        {{-- Header --}}
        <div class="header">
            <h1>Welcome to {{ config('app.name') }} 🎉</h1>
        </div>

        {{-- Content --}}
        <div class="content">

            <h2>Hello {{ $user->name }},</h2>

            <p>
                Welcome to <strong>{{ config('app.name') }}</strong>!
                Your account has been successfully created.
            </p>

            <p>
                We are happy to have you with us. You can now log in
                and start using your account.
            </p>

            {{-- User Information --}}
            <div class="user-info">

                <p>
                    <strong>Name:</strong>
                    {{ $user->name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $user->email }}
                </p>

                <p>
                    <strong>Registered:</strong>
                    {{ $user->created_at->format('d M Y')?? date('d M Y') }}
                </p>

            </div>

            {{-- Login Button --}}
            <div style="text-align: center; margin: 30px 0;">

                <a href="{{ url('/login') }}" class="btn">
                    Login to Your Account
                </a>

            </div>

            <p>
                If you have any questions, feel free to contact our
                support team.
            </p>

            <p>
                Thanks,<br>
                <strong>{{ config('app.name') }} Team</strong>
            </p>

        </div>

        {{-- Footer --}}
        <div class="footer">

            <p>
                © {{ date('Y') }} {{ config('app.name') }}.
                All rights reserved.
            </p>

            <p>
                This is an automated email. Please do not reply directly
                to this email.
            </p>

        </div>

    </div>

</div>

</body>
</html>