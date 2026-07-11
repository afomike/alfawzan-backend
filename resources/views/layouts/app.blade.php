<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Alfawzan Driving School')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #8b5cf6;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            color: var(--gray-900);
            font-weight: 400;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 1.25rem 0;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
            color: var(--primary) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-brand i {
            font-size: 1.6rem;
        }
        
        i, .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .icon-lg {
            font-size: 1.5rem;
        }
        
        .icon-xl {
            font-size: 2rem;
        }
        
        .icon-2xl {
            font-size: 2.5rem;
        }
        
        .icon-3xl {
            font-size: 3rem;
        }
        
        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            padding: 0.625rem 1.125rem !important;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0 0.25rem;
            color: var(--gray-700) !important;
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
        }
        
        .card-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 2px solid var(--gray-100);
            padding: 1.75rem 2rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--primary);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card.success {
            border-top-color: var(--success);
        }
        
        .stat-card.warning {
            border-top-color: var(--warning);
        }
        
        .stat-card.info {
            border-top-color: var(--info);
        }
        
        .stat-card.danger {
            border-top-color: var(--danger);
        }
        
        .stat-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.75rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -2px;
            color: var(--gray-900);
            line-height: 1;
        }
        
        .stat-card p {
            margin: 0.75rem 0 0 0;
            color: var(--gray-600);
            font-size: 0.95rem;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }
        
        .stat-card i {
            position: absolute;
            bottom: 1.5rem;
            right: 1.5rem;
            font-size: 4rem;
            opacity: 0.08;
            color: var(--primary);
        }
        
        .stat-card.success i {
            color: var(--success);
        }
        
        .stat-card.warning i {
            color: var(--warning);
        }
        
        .stat-card.info i {
            color: var(--info);
        }
        
        .btn {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }
        
        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
        
        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .table th {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: var(--gray-600);
            border: none;
            padding: 1.5rem 1.25rem;
        }
        
        .table td {
            padding: 1.5rem 1.25rem;
            border-color: var(--gray-200);
            vertical-align: middle;
            font-family: 'Inter', sans-serif;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background: #f8fafc;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.75rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid var(--gray-300);
            padding: 0.875rem 1.25rem;
            transition: all 0.3s ease;
            font-weight: 400;
            font-family: 'Inter', sans-serif;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        
        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .page-header {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--gray-200);
        }
        
        .page-header h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: var(--gray-900);
            margin: 0;
            font-size: 2.25rem;
            letter-spacing: -1px;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            margin-top: 6rem;
            padding: 5rem 0 2.5rem;
        }
        
        footer h5 {
            font-family: 'Poppins', sans-serif;
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        
        footer a:hover {
            color: white;
            transform: translateX(4px);
        }
        
        footer p, footer li {
            color: rgba(255, 255, 255, 0.8);
            font-family: 'Inter', sans-serif;
        }
        
        footer .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 2rem;
        }
        
        footer .footer-bottom p {
            color: rgba(255, 255, 255, 0.9);
            font-family: 'Inter', sans-serif;
        }
        
        footer .footer-bottom a {
            color: white;
            font-weight: 600;
        }
        
        code {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.85rem;
            font-family: 'Fira Code', 'Courier New', monospace;
        }
        
        @media (max-width: 768px) {
            .stat-card h3 {
                font-size: 2rem;
            }
            
            .page-header h2 {
                font-size: 1.75rem;
            }
        }
        
        .min-vh-50 {
            min-height: 50vh;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="ti ti-car"></i>
                <span>Alfawzan Driving School</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="ti ti-dashboard me-1"></i>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.payment-references.*') ? 'active' : '' }}" href="{{ route('admin.payment-references.index') }}"><i class="ti ti-receipt me-1"></i>References</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.agent-links.*') ? 'active' : '' }}" href="{{ route('admin.agent-links.index') }}"><i class="ti ti-link me-1"></i>Agent Links</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}"><i class="ti ti-file-type-pdf me-1"></i>Documents</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}"><i class="ti ti-credit-card me-1"></i>Payments</a></li>
                        @elseif(auth()->user()->isAgent())
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}" href="{{ route('agent.dashboard') }}"><i class="ti ti-dashboard me-1"></i>Dashboard</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="ti ti-dashboard me-1"></i>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.payments.*') ? 'active' : '' }}" href="{{ route('user.payments.index') }}"><i class="ti ti-credit-card me-1"></i>Payments</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.documents.*') ? 'active' : '' }}" href="{{ route('user.documents.index') }}"><i class="ti ti-file-type-pdf me-1"></i>Documents</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.receipts.*') ? 'active' : '' }}" href="{{ route('user.receipts.index') }}"><i class="ti ti-receipt me-1"></i>Receipts</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="ti ti-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.profile.show') }}"><i class="ti ti-user me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="ti ti-logout me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="ti ti-login me-1"></i>Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('driving-school.register') }}"><i class="ti ti-user-plus me-1"></i>Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-xxl py-5 px-4 px-lg-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container-xxl px-4 px-lg-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="ti ti-car me-2"></i>Alfawzan Driving School Ltd.</h5>
                    <p class="mb-2 fw-semibold" style="color: rgba(255, 255, 255, 0.95);">Driving Knowledge, Building Confidence & Ensuring Safety.</p>
                    <p class="mb-3" style="color: rgba(255, 255, 255, 0.8);">A fully licensed driving and road safety training institution providing structured and professional driver training to individuals and organizations, emphasizing safety, discipline, and compliance with FRSC and KASTLEA standards.</p>
                    <div class="d-flex gap-3">
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-brand-facebook icon-xl"></i></a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-brand-twitter icon-xl"></i></a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-brand-instagram icon-xl"></i></a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-brand-linkedin icon-xl"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/">Home</a></li>
                        <li class="mb-2"><a href="{{ route('driving-school.register') }}">Register</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                        @auth
                        <li class="mb-2"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Training Programs</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#"><i class="ti ti-check me-2"></i>Learner Driver Training</a></li>
                        <li class="mb-2"><a href="#"><i class="ti ti-check me-2"></i>Professional/Commercial Certification</a></li>
                        <li class="mb-2"><a href="#"><i class="ti ti-check me-2"></i>Defensive & Advanced Driving</a></li>
                        <li class="mb-2"><a href="#"><i class="ti ti-check me-2"></i>Refresher Courses</a></li>
                        <li class="mb-2"><a href="#"><i class="ti ti-check me-2"></i>Fleet Driver Management</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Contact Information</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-mail me-2"></i>info@alfawzanresources.ng</li>
                        <li class="mb-2" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-phone me-2"></i>+234 803 848 2622</li>
                        <li class="mb-2" style="color: rgba(255, 255, 255, 0.8);"><i class="ti ti-map-pin me-2"></i>Kaduna, Nigeria</li>
                        <li class="mb-2 mt-3">
                            <span class="badge bg-success me-1">FRSC Accredited</span>
                            <span class="badge bg-primary">KASTLEA Certified</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0" style="color: rgba(255, 255, 255, 0.9);">
                            &copy; {{ date('Y') }} <strong style="color: white;">Alfawzan Driving School Ltd.</strong> All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                        <p class="mb-0" style="color: rgba(255, 255, 255, 0.9);">
                            Built by <a href="https://makeriweblinks.com.ng" target="_blank" style="color: white; font-weight: 600;">Makeri Weblinks Technologies</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
