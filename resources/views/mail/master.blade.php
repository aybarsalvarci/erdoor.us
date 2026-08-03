<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #f7f4ef; }

        @media screen and (max-width: 600px) {
            .email-container { width: 100% !important; padding: 10px !important; }
            .fluid { max-width: 100% !important; height: auto !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f4ef; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

<div style="display: none; font-size: 1px; color: #f7f4ef; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
    @yield('preheader', 'Erdoor - Yeni nesil kompozit iç kapı sistemleri.')
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed; background-color: #f7f4ef;" id="bodyTable">
    <tr>
        <td align="center" style="padding: 40px 0;">

            <table border="0" cellpadding="0" cellspacing="0" width="600" class="email-container" style="background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">

                <tr>
                    <td align="center" style="padding: 30px 40px; background-color: #17202a;">
                        <!-- Logoyu saran arka plan kutusu (Görseldeki beyaz/gri kutu efekti için) -->
                        <table border="0" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; border-radius: 8px;">
                            <tr>
                                <td align="center" style="padding: 12px 24px;">
                                    <a href="{{ config('app.url') }}" target="_blank" style="text-decoration: none; display: inline-block;">
                                        <img src="{{ asset($settings->logo) }}"
                                             alt="{{ $settings->title ?? 'ERDOOR' }}"
                                             style="max-height: 45px; width: auto; display: block; border: 0; outline: none; text-decoration: none;">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 40px 30px; color: #333333; font-size: 16px; line-height: 1.6;">
                        @yield('content')
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 30px; background-color: #f3f0ea; color: #707881; font-size: 12px; line-height: 1.5;">
                        <p style="margin: 0 0 10px 0;">{{$settings->footer_copyright}}</p>
                        <p style="margin: 0;">
                            This email was sent to you because you signed up for our newsletter. To unsubscribe,
                            <a href="#" style="color: #17202a; text-decoration: underline;">click here</a>.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
</body>
</html>
