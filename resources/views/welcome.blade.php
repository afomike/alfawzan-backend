@extends('layouts.app')

@section('title', 'Welcome - Alfawzan Driving School')

@section('content')
<div class="container py-5">
    <div class="rounded-4 mb-5 overflow-hidden" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 60%, #a78bfa 100%);">
        <div class="row align-items-center g-0">
            <div class="col-lg-7 p-5">
                <span class="badge fw-semibold px-3 py-2 mb-4 d-inline-block" style="background: rgba(255,255,255,0.2); color: white; font-size: 0.8rem; letter-spacing: 0.5px;">
                    <i class="ti ti-certificate me-1"></i>FRSC &amp; KASTLEA Accredited Institution
                </span>
                <h1 class="fw-bold mb-3 text-white" style="font-size: clamp(2rem, 4vw, 3rem); line-height: 1.15;">
                    Drive with Confidence.<br>Learn from Experts.
                </h1>
                <p class="mb-5" style="color: rgba(255,255,255,0.85); font-size: 1.1rem; line-height: 1.7; max-width: 520px;">
                    Alfawzan Driving School Ltd. is a fully licensed road safety training institution delivering professional driver education to individuals and organizations across Nigeria.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('driving-school.register') }}" class="btn btn-lg fw-bold px-4" style="background: white; color: #6366f1; border: none;">
                        <i class="ti ti-user-plus me-2"></i>Register Now
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-lg fw-semibold px-4" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.5);">
                        <i class="ti ti-login me-2"></i>Login
                    </a>
                </div>
            </div>
            <div class="col-lg-5 p-4 p-lg-5">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-4 rounded-3 h-100 text-center" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                            <div class="fw-bold mb-1 text-white" style="font-size: 1.75rem;">5+</div>
                            <div style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">Training Programs</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3 h-100 text-center" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                            <div class="fw-bold mb-1 text-white" style="font-size: 1.75rem;"><i class="ti ti-shield-check"></i></div>
                            <div style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">FRSC Licensed</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3 h-100 text-center" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                            <div class="fw-bold mb-1 text-white" style="font-size: 1.75rem;"><i class="ti ti-award"></i></div>
                            <div style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">KASTLEA Certified</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3 h-100 text-center" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                            <div class="fw-bold mb-1 text-white" style="font-size: 1rem;"><i class="ti ti-phone me-1"></i></div>
                            <div style="color: rgba(255,255,255,0.8); font-size: 0.8rem;">+234 803 848 2622</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="ti ti-eye text-primary icon-lg"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Vision</h6>
                            <p class="text-muted small mb-0">To become Nigeria's leading center of excellence in professional driving and road safety training.</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="ti ti-target text-success icon-lg"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Mission</h6>
                            <p class="text-muted small mb-0">To deliver high-quality, technology-driven driving education that empowers learners.</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="ti ti-star text-info icon-lg"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Core Values</h6>
                            <p class="text-muted small mb-0">Safety First, Professionalism, Integrity, Innovation, Customer Care.</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="ti ti-award text-warning icon-lg"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Accreditation</h6>
                            <p class="text-muted small mb-0">Fully licensed and accredited by FRSC & KASTLEA standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12">
            <h3 class="text-center mb-4 fw-bold">Our Training Programs</h3>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-user text-primary icon-2xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Learner Driver Training</h5>
                    <p class="text-muted">Comprehensive training for new drivers covering all aspects of safe driving practices and road regulations.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-briefcase text-success icon-2xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Professional/Commercial Certification</h5>
                    <p class="text-muted">Specialized training for commercial drivers with certification programs aligned with industry standards.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-shield-check text-info icon-2xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Defensive & Advanced Driving</h5>
                    <p class="text-muted">Advanced techniques and defensive driving strategies for experienced drivers seeking to enhance their skills.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-refresh text-warning icon-2xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Refresher Courses</h5>
                    <p class="text-muted">Update your driving knowledge and skills with our comprehensive refresher courses designed for all driver levels.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-building text-danger icon-2xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Fleet Driver Management & Consultancy</h5>
                    <p class="text-muted">Corporate solutions for fleet management, driver training, and consultancy services for organizations.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="ti ti-credit-card text-primary icon-3xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Easy Payments</h5>
                    <p class="text-muted">Accept payments online or via reference IDs. Integrated with Paystack for secure, seamless transactions.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="ti ti-file-type-pdf text-success icon-3xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Document Management</h5>
                    <p class="text-muted">Upload and manage PDF documents effortlessly. Students can easily access and download their documents anytime.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="ti ti-receipt text-info icon-3xl"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Auto Receipts</h5>
                    <p class="text-muted">Automatically generate professional receipts with digital signatures for every successful payment transaction.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
