<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>We Have Responded</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f6f8fb; margin:0; padding:0;">

    <div
        style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:10px; overflow:hidden; border:1px solid #e5e7eb;">

        {{-- HEADER --}}
        <div style="background:#16a34a; padding:20px; color:#fff;">
            <h2 style="margin:0; font-size:18px;">We Have Responded to Your Message</h2>
            <p style="margin:5px 0 0; font-size:13px; opacity:0.9;">
                Thank you for contacting us
            </p>
        </div>

        {{-- BODY --}}
        <div style="padding:20px;">

            <p style="font-size:14px;">Hello <b>{{ $contact->name }}</b>,</p>

            <p style="font-size:13px; color:#374151;">
                We have reviewed your inquiry and here is our response:
            </p>

            {{-- ORIGINAL MESSAGE --}}
            <div style="margin:15px 0;">
                <h4 style="font-size:13px; color:#374151;">Your Message</h4>
                <div style="background:#f9fafb; padding:12px; border-left:4px solid #2563eb;">
                    {{ $contact->message }}
                </div>
            </div>

            {{-- ADMIN RESPONSE --}}
            @if ($contact->admin_notes)
                <div style="margin:15px 0;">
                    <h4 style="font-size:13px; color:#374151;">Our Response</h4>
                    <div style="background:#ecfdf5; padding:12px; border-left:4px solid #16a34a;">
                        {{ $contact->admin_notes }}
                    </div>
                </div>
            @endif

            <p style="margin-top:20px; font-size:13px;">
                If you have further questions, feel free to reply to this email.
            </p>

            <p style="font-size:13px;">
                Thank you,<br>
                <b>{{ setting('site_name') }}</b>
            </p>

        </div>

        {{-- FOOTER --}}
        <div style="background:#f3f4f6; padding:12px; text-align:center; font-size:12px; color:#6b7280;">
            We typically respond within 24–48 hours.
        </div>

    </div>

</body>

</html>
