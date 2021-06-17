<tr>
    <td>
        <h3 style="color:#fff;background:#e12c2c; text-align: center; padding:10px 0;font-size:22px;">Document
            Submitted</h3>
    </td>
</tr>
<tr>
    <td>
        <div style="padding:20px 0;">Hi {{ ucfirst($user['first_name']) }} {{ ucfirst($user['last_name']) }}, Your
            details and documents have successfully been submitted for verification.
            We'll get back to you shortly.
        </div>
    </td>
</tr>
<tr>
    <td align="center">
        <a href="{{ env('APP_URL') }}"
           style="text-decoration:none">
            <h3 style="color:#fff;background:#e12c2c; text-align: center; padding:10px 30px; text-transform: uppercase; font-size:22px; margin:20px 0; display: inline-block;">
                Go to Site</h3>
        </a>
    </td>
</tr>
