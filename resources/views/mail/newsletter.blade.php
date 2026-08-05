@extends('mail.master')

@section('title', $newsletter->title)
@section('preheader', $newsletter->title)

@section('content')
    <!-- BÜLTEN BAŞLIĞI -->
    <h1 style="margin: 0 0 20px 0; font-size: 24px; font-weight: normal; color: #17202a; font-family: serif;">
        {{ $newsletter->title }}
    </h1>

    <p style="margin: 0 0 15px 0;">
        Hello,
    </p>

    <div style="margin: 0 0 20px 0; font-size: 16px; line-height: 1.6; color: #333333; font-family: sans-serif;">
        {!! $newsletter->body !!}
    </div>

    @if(!empty($newsletter->button_text) && !empty($newsletter->button_link))
        <table border="0" cellspacing="0" cellpadding="0" style="margin: 30px 0;">
            <tr>
                <td align="center" style="border-radius: 3px;" bgcolor="#17202a">
                    <a href="{{ $newsletter->button_link }}" target="_blank" style="font-size: 16px; font-family: sans-serif; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 3px; border: 1px solid #17202a; display: inline-block; font-weight: bold;">
                        {{ $newsletter->button_text }}
                    </a>
                </td>
            </tr>
        </table>
    @endif

    <!-- ALT BİLGİ -->
    <p style="margin: 30px 0 0 0; font-size: 14px; color: #666666;">
        If you have any questions, feel free to reply to this email.<br><br>
        Best regards,<br>
        <strong>Erdoor Team</strong>
    </p>
@endsection
