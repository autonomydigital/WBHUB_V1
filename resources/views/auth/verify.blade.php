@extends('layouts.master-without-nav')
@section('title', 'Verify Email')
@section('content')

<div class="auth-page-wrapper pt-5">
   
    <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index" class="d-inline-block auth-logo">
                                <img src="{{ URL::asset('build/images/big-logo.png')}}" alt="" height="130">
                            </a>
                        </div>
                    <p class="mt-3 fs-15 fw-medium">Connecting businesses in the Whitsundays</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4>Verify Your Email</h4>
                                <p>Please enter the 4‑digit code sent to <span class="fw-semibold">{{ auth()->user()->email }}</span></p>
                            </div>

                            {{-- Error Message --}}
                            @if ($errors->has('code'))
                                <div class="alert alert-danger text-center">
                                    {!! $errors->first('code') !!}
                                </div>
                            @endif

                            {{-- Success Message --}}
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Frontend Validation Error Placeholder --}}
                            <div id="frontend-error" class="alert alert-danger text-center d-none"></div>

                            <form id="verify-form" method="POST" action="{{ route('verification.verify') }}">
                                @csrf
                                <input type="hidden" name="code" id="verification-code">

                                <div class="row">
                                    @for($i = 1; $i <= 4; $i++)
                                        <div class="col-3 mb-3">
                                            <input type="text"
                                                   class="form-control form-control-lg text-center"
                                                   maxlength="1"
                                                   id="digit{{ $i }}-input"
                                                   onkeyup="moveToNext(this, {{ $i+1 }})"
                                                   required>
                                        </div>
                                    @endfor
                                </div>

                                <button type="button" class="btn btn-success w-100" onclick="submitVerification()">Confirm</button>
                            </form>

                            <div class="mt-4 text-center">
                                <form method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0">Resend Code</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- footer -->
     <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> WBHub - Brought to you by Whitsunday Web</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    
</div>

@endsection

@section('script')
<script>
    function submitVerification() {
        const code = Array.from({ length: 4 }, (_, i) =>
            document.getElementById(`digit${i+1}-input`).value.trim()
        ).join('');
    
        const errorBox = document.getElementById('frontend-error');
    
        if (code.length < 4) {
            errorBox.textContent = "Please enter a 4-digit code.";
            errorBox.classList.remove('d-none');
            return;
        }
    
        errorBox.classList.add('d-none'); // hide error if valid
        document.getElementById('verification-code').value = code;
        document.getElementById('verify-form').submit();
    }

    // Autofocus to next digit field
function moveToNext(currentInput, nextIndex) {
    const maxLength = currentInput.getAttribute('maxlength');
    const currentLength = currentInput.value.length;

    if (currentLength >= maxLength) {
        const nextInput = document.getElementById(`digit${nextIndex}-input`);
        if (nextInput) {
            nextInput.focus();
        }
    }
}
    </script>
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection