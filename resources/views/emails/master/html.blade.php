<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="utf-8">
    <style>
        ul {
            list-style: outside none none;
            margin-bottom: 0;
            padding-left: 0;
        }
    </style>
</head>
<body style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; background-color: #edf2f7; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">
<table class="table table-mail" style="width:575px; margin-top:25px" align="center">
    <tr>
        <td  style="padding:0px;width:650px" bgcolor="#ffffff" align="left">
            <table class="table_inner" align="left"  style="padding:15px">
                <tr>
                    <td align="left" class="logo" style="padding:0px;border-bottom:1px solid #edf2f7;">
                        <img src="{!! asset('/website/images/email/email_header.png')!!}"   border="0"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="margin:40px 0px">@yield('content')</div>
                    </td>
                </tr>
                <tr bgcolor="#ffffff" >
                    <td class="footer" style="border-top:1px solid #edf2f7;padding:7px 0px 0px 0px;font-size:14px;" bgcolor="#ffffff" bgcolor="#ffffff">
                        {{ trans('email.footer') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
