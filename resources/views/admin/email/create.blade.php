@extends('layouts.admin')

@section('title', 'Add Email Configuration')
@section('page-title', 'Add Email Configuration')

@section('content')

    <form method="POST" action="{{ route('admin.email.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-5 rounded-xl border">
                <h3 class="font-semibold mb-4">SMTP Settings</h3>

                <div class="space-y-3">

                    <input name="mailer" class="w-full border p-2 rounded" placeholder="smtp">

                    <input name="host" class="w-full border p-2 rounded" placeholder="smtp.gmail.com">

                    <input name="port" class="w-full border p-2 rounded" placeholder="587">

                    <input name="username" class="w-full border p-2 rounded" placeholder="email@gmail.com">

                    <input name="password" class="w-full border p-2 rounded" placeholder="App Password">

                    <input name="encryption" class="w-full border p-2 rounded" placeholder="tls">

                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border">
                <h3 class="font-semibold mb-4">Sender Info</h3>

                <input name="from_address" class="w-full border p-2 rounded mb-3" placeholder="from email">

                <input name="from_name" class="w-full border p-2 rounded mb-3" placeholder="from name">

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1">
                    Active
                </label>

                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                    Save Configuration
                </button>
            </div>

        </div>

    </form>

@endsection
