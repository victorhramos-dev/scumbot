@extends('emails.partials.theme')

@section('page-title', 'Recuperação de Senha!')

@section('content')
    <!--[if (gte mso 9)|(IE)]>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
        <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                            <multiline label="lead">Olá <strong>{{ $notifiable->name }}</strong>.<br/><br/>Você acaba de receber seu link de recuperação de senha. Com ele você irá acessar nossa plataforma e cadastrar uma nova senha de acesso.<br></multiline>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                            <multiline label="cta link">
                                Para cadastrar sua nova senha utilize o seguinte link:<br>
                                <a href="{{ $link }}" target="_blank" style="color:#00a9a7;">{{ trans('auth.reset-password') }}</a>
                            </multiline>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;"></td>
                    </tr>
                </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
        </tr>
    </table>
    <![endif]-->
@endsection