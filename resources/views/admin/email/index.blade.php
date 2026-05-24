@extends('layouts.admin')

@section('title', 'Email Settings')
@section('page-title', 'Email Settings')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">SMTP Configuration</h2>

        <a href="{{ route('admin.email.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
            + Add Email Config
        </a>
    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="p-3">Mailer</th>
                    <th class="p-3">Host</th>
                    <th class="p-3">Port</th>
                    <th class="p-3">From</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($emails as $email)
                    <tr class="border-t">
                        <td class="p-3">{{ $email->mailer }}</td>
                        <td class="p-3">{{ $email->host }}</td>
                        <td class="p-3">{{ $email->port }}</td>
                        <td class="p-3">{{ $email->from_address }}</td>
                        <td class="p-3">
                            @if ($email->is_active)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('admin.email.edit', $email->id) }}" class="text-blue-600 text-sm">Edit</a>

                            <form action="{{ route('admin.email.delete', $email->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
