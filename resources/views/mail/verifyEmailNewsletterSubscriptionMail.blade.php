@extends('mail.master')

@section('title', 'Verify Your Email Address')

@section('preheader', 'Thank you for subscribing to Erdoor. Please verify your email address to complete your subscription.')

@section('content')
    <h1 style="margin: 0 0 20px 0; font-size: 24px; font-weight: normal; color: #17202a; font-family: serif;">
        Welcome to Erdoor!
    </h1>

    <p style="margin: 0 0 15px 0;">
        Hello,
    </p>

    <p style="margin: 0 0 20px 0;">
        Thank you for subscribing to our newsletter. To start receiving our latest solid core composite interior door models, exclusive exhibitions, and special offers, please verify your email address by clicking the button below.
    </p>

    <table border="0" cellspacing="0" cellpadding="0" style="margin: 30px 0;">
        <tr>
            <td align="center" style="border-radius: 4px;" bgcolor="#17202a">
                <a href="{{ $verificationUrl }}" target="_blank" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 4px; border: 1px solid #17202a; display: inline-block; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">
                    Verify Email Address
                </a>
            </td>
        </tr>
    </table>

    <p style="margin: 0 0 20px 0; font-size: 13px; color: #888888;">
        If you didn’t request this subscription, you can safely ignore this email.
    </p>

    <p style="margin: 30px 0 0 0; font-size: 14px; color: #666666;">
        If you have any questions, feel free to reply to this email.<br><br>
        Best regards,<br>
        <strong>Erdoor Team</strong>
    </p>
@endsection
