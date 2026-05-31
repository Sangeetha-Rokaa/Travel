@extends('layouts.app')
@section('title', 'Packages – Visit Nepal')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:4rem 2rem;">
    <h1 style="color:#fff;margin-bottom:2rem;">All Packages</h1>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:2rem;">
        @foreach($packages as $package)
            <div style="background:#111;border-radius:12px;overflow:hidden;">
                <img src="{{ $package['img'] }}" style="width:100%;height:180px;object-fit:cover;">
                
                <div style="padding:1rem;">
                    <h3 style="color:#fff;">{{ $package['name'] }}</h3>
                    <p style="color:#aaa;">{{ $package['days'] }} Days</p>

                    <a href="{{ route('packages.show', $package['slug']) }}">
                        View Details →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
