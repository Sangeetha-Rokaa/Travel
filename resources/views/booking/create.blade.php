@extends('layouts.app')
@section('title', 'Book – ' . $item['name'])
@section('content')
<section style="padding:9rem 2rem 7rem;">
    <div style="max-width:780px;margin:0 auto;">

        <div style="text-align:center;margin-bottom:3rem;" data-aos="fade-up">
            <div class="section-badge" style="margin:0 auto 1rem;">
                <i class="fas fa-calendar-check"></i> Secure Booking
            </div>
            <h1 class="section-title">Book <span>Your Trip</span></h1>
        </div>

        <!-- Package preview -->
        <div style="display:flex;gap:1.5rem;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);
                    border-radius:18px;padding:1.5rem;margin-bottom:2.5rem;align-items:center;flex-wrap:wrap;"
             data-aos="fade-up" data-aos-delay="100">
            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                 style="width:110px;height:90px;object-fit:cover;border-radius:12px;flex-shrink:0;">
            <div style="flex:1;">
                <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:1.1rem;margin-bottom:6px;">
                    {{ $item['name'] }}
                </h3>
                <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                    <span style="color:rgba(255,255,255,.5);font-size:.85rem;">
                        <i class="fas fa-clock" style="color:var(--nepal-gold);margin-right:5px;"></i>{{ $item['days'] }} Days
                    </span>
                    <span style="font-family:'Cinzel',serif;color:var(--nepal-gold);font-size:1.2rem;font-weight:700;">
                        ${{ number_format($item['price']) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.09);
                    border-radius:22px;padding:2.5rem;"
             data-aos="fade-up" data-aos-delay="150">
            <h2 style="font-family:'Cinzel',serif;color:#fff;font-size:1.3rem;margin-bottom:.5rem;">
                Your Details
            </h2>
            <p style="color:rgba(255,255,255,.4);font-size:.85rem;margin-bottom:2rem;">
                Please fill in your details and we will confirm your booking within 24 hours.
            </p>

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package" value="{{ $item['name'] }}">
                <input type="hidden" name="price"   value="{{ $item['price'] }}">

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;">
                    <div>
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Full Name *</label>
                        <input type="text" name="full_name" class="form-input" placeholder="John Doe" required>
                    </div>
                    <div>
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Email Address *</label>
                        <input type="email" name="email" class="form-input" placeholder="john@example.com" required>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;">
                    <div>
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Phone Number *</label>
                        <input type="tel" name="phone" class="form-input" placeholder="+977 9800000000" required>
                    </div>
                    <div>
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Number of Persons</label>
                        <input type="number" name="persons" class="form-input" placeholder="2" min="1" max="20">
                    </div>
                </div>

                <div style="margin-bottom:1.2rem;">
                    <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Preferred Start Date</label>
                    <input type="date" name="start_date" class="form-input">
                </div>

                <div style="margin-bottom:1.8rem;">
                    <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Special Requests</label>
                    <textarea name="message" class="form-input" placeholder="Any dietary requirements, physical conditions or special requests..." style="height:110px;"></textarea>
                </div>

                <button type="submit" class="btn-gold" style="width:100%;justify-content:center;font-size:1rem;padding:16px;">
                    <i class="fas fa-lock"></i> Confirm Booking
                </button>

                <p style="text-align:center;color:rgba(255,255,255,.3);font-size:.78rem;margin-top:1rem;">
                    <i class="fas fa-shield-alt" style="color:var(--nepal-gold);margin-right:5px;"></i>
                    Your data is secure. No payment required at this stage.
                </p>
            </form>
        </div>

    </div>
</section>
@endsection