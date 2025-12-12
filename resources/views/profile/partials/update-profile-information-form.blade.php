<div style="padding: 2rem;">
    <p class="mb-4 text-muted" style="font-size: 0.9rem;">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>Data profil berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group-custom">
                    <label for="name" class="form-label-custom required">
                        <i class="bi bi-person"></i> Nama
                    </label>
                    <input id="name" name="name" type="text" class="form-control-custom" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    @error('name')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-custom">
                    <label for="email" class="form-label-custom required">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input id="email" name="email" type="email" class="form-control-custom" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @error('email')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-muted small mb-1">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-underline">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-success small mb-0">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-2">
            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-check-circle"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
