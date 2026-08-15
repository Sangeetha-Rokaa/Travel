<h2>Thank you for contacting us</h2>

<p>Hello {{ $contact->name }},</p>

<p>We have received your message:</p>

<blockquote style="background:#f9fafb; padding:10px; border-left:4px solid #3b82f6;">
    {{ $contact->message }}
</blockquote>

<p>We will reply soon.</p>

<br>

<p>
    Regards,<br>
    <b>{{ setting('site_name') }}</b>
</p>
