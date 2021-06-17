<tr>
    <td>
        <h3 style="color:#fff;background:#e12c2c; text-align: center; padding:10px 0;font-size:22px;">Document
            Disapproved</h3>
    </td>
</tr>
<tr>
    <td>
        <div style="padding:20px 0;">Hi {{ ucfirst($user['first_name']) }} {{ ucfirst($user['last_name']) }}, We're
            sorry to say that we couldn't approve your documents as they were not valid. Please upload a valid document
            and try again.
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
