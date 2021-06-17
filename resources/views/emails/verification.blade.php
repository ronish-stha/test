<tr>
    <td>
        <h3 style="color:#fff;background:#e12c2c; text-align: center; padding:10px 0;font-size:22px;">Verify your account</h3>
    </td>
</tr>
<tr>
    <td>
        <div style="padding:20px 0;">Hi {{ $user['first_name'] }} {{ $user['last_name'] }}, your account has been
            created successfully. Please click the button below to activate your account.
        </div>
    </td>
</tr>
<tr>
    <td align="center">
        <a href="{{ env('APP_URL') }}/user/verify/{{ $user->verifyUser->token }}"
           style="text-decoration:none">
            <h3 style="color:#fff;background:#e12c2c; text-align: center; padding:10px 30px; text-transform: uppercase; font-size:22px; margin:20px 0; display: inline-block;">
                Activate</h3>
        </a>
    </td>
</tr>
