{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Nepal Travel')</title>

    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts for Nepali vibe -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fef9e6;
            /* warm nepali rice paper tone */
        }

        /* Sidebar - inspired by mountain earthy tones */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #1e2a2e 0%, #0f1a1f 100%);
            color: #f5e6d3;
            padding: 25px 15px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #d4a373;
            overflow-y: auto;
        }

        .sidebar h3 {
            font-size: 1.5rem;
            font-weight: 600;
            border-left: 4px solid #e9b35f;
            padding-left: 15px;
            margin-bottom: 35px;
            color: #ffedd5;
        }

        .sidebar h3 i {
            color: #e9b35f;
            margin-right: 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e2d4c8;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar a i {
            width: 24px;
            font-size: 1.2rem;
            color: #e9b35f;
        }

        .sidebar a:hover {
            background: rgba(233, 179, 95, 0.15);
            color: #ffe6c7;
            transform: translateX(5px);
        }

        .sidebar a:hover i {
            color: #f4c77a;
        }

        /* main content */
        .main-content {
            margin-left: 280px;
            padding: 30px 35px;
        }

        /* Top header bar */
        .top-header {
            background: white;
            border-radius: 28px;
            padding: 12px 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0e2ce;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .page-title {
            font-weight: 700;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #b85c1a, #e9b35f);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
        }

        .page-title i {
            color: #d97706;
            margin-right: 8px;
        }

        .logout-btn {
            background: #8b3c1c;
            border: none;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 500;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #a04e2a;
            transform: scale(1.02);
        }

        /* card design - pahad style (mountain) */
        .card-box {
            border-radius: 28px;
            padding: 22px 20px;
            color: white;
            transition: 0.3s;
            box-shadow: 0 12px 20px -10px rgba(0, 0, 0, 0.2);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-box::after {
            content: "🏔️";
            position: absolute;
            bottom: 5px;
            right: 15px;
            font-size: 55px;
            opacity: 0.15;
            pointer-events: none;
        }

        .card-box h5 {
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .card-box h2 {
            font-weight: 800;
            font-size: 2.8rem;
            margin-bottom: 0;
        }

        .bg-trek {
            background: linear-gradient(145deg, #0f5c6b, #0a7e8c);
        }

        .bg-destination {
            background: linear-gradient(145deg, #2b6e3c, #3faa5c);
        }

        .bg-package {
            background: linear-gradient(145deg, #c26b1a, #e68a2e);
        }

        .bg-contact {
            background: linear-gradient(145deg, #b23c1c, #d45a34);
        }

        /* responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .top-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
                text-align: center;
            }
        }

        /* fancy scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #2c3e2f;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #e9b35f;
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body>

    @include('layouts.sidebar')

    <div class="main-content">
        @include('layouts.header')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
