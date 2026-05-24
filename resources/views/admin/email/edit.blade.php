@extends('layouts.admin')

@section('title', 'Edit Email Configuration')
@section('page-title', 'Edit Email Configuration')

@section('content')

    <form method="POST" action="{{ route('admin.email.update', $emailSetting->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-5 rounded-xl border">

                <h3 class="font-semibold mb-4">SMTP Settings</h3>

                <input name="mailer" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->mailer }}">

                <input name="host" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->host }}">

                <input name="port" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->port }}">

                <input name="username" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->username }}">

                <input name="password" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->password }}">

                <input name="encryption" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->encryption }}">

            </div>

            <div class="bg-white p-5 rounded-xl border">

                <h3 class="font-semibold mb-4">Sender Info</h3>

                <input name="from_address" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->from_address }}">

                <input name="from_name" class="w-full border p-2 rounded mb-2" value="{{ $emailSetting->from_name }}">

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ $emailSetting->is_active ? 'checked' : '' }}>
                    Active
                </label>

                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                    Update Configuration
                </button>

            </div>

        </div>

    </form>

@endsection
