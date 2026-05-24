<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f6f8fb; margin:0; padding:0;">

    <div
        style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:10px; overflow:hidden; border:1px solid #e5e7eb;">

        {{-- HEADER --}}
        <div style="background:#2563eb; padding:20px; color:#fff;">
            <h2 style="margin:0; font-size:18px;">New Contact Message</h2>
            <p style="margin:5px 0 0; font-size:13px; opacity:0.9;">
                A user has submitted a new inquiry from your website
            </p>
        </div>

        {{-- BODY --}}
        <div style="padding:20px; color:#111827;">

            {{-- USER INFO --}}
            <div style="margin-bottom:15px;">
                <h3 style="font-size:14px; margin-bottom:10px; color:#374151;">Customer Details</h3>

                <p style="margin:4px 0;"><b>Name:</b> {{ $contact->name }}</p>
                <p style="margin:4px 0;"><b>Email:</b> {{ $contact->email }}</p>

                @if ($contact->phone)
                    <p style="margin:4px 0;"><b>Phone:</b> {{ $contact->phone }}</p>
                @endif

                @if ($contact->country)
                    <p style="margin:4px 0;"><b>Country:</b> {{ $contact->country }}</p>
                @endif
            </div>

            {{-- INQUIRY INFO --}}
            <div style="margin-bottom:15px;">
                <h3 style="font-size:14px; margin-bottom:10px; color:#374151;">Inquiry Details</h3>

                <p style="margin:4px 0;"><b>Subject:</b> {{ $contact->subject }}</p>
                <p style="margin:4px 0;"><b>Type:</b> {{ ucfirst($contact->inquiry_type) }}</p>

                @if ($contact->trek_or_package)
                    <p style="margin:4px 0;"><b>Service:</b> {{ $contact->trek_or_package }}</p>
                @endif

                @if ($contact->travel_date)
                    <p style="margin:4px 0;"><b>Travel Date:</b> {{ $contact->travel_date }}</p>
                @endif

                @if ($contact->group_size)
                    <p style="margin:4px 0;"><b>Group Size:</b> {{ $contact->group_size }}</p>
                @endif
            </div>

            {{-- MESSAGE --}}
            <div style="margin-top:15px;">
                <h3 style="font-size:14px; margin-bottom:10px; color:#374151;">Message</h3>

                <div style="background:#f9fafb; padding:12px; border-left:4px solid #2563eb; border-radius:6px;">
                    {{ $contact->message }}
                </div>
            </div>

        </div>

        {{-- FOOTER --}}
        <div style="background:#f3f4f6; padding:12px; text-align:center; font-size:12px; color:#6b7280;">
            This message was sent from your website contact form.
        </div>

    </div>

</body>

</html>
