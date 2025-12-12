<div style="padding: 2rem;">
    <p class="mb-4 text-muted" style="font-size: 0.9rem;">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>Password berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="form-group-custom">
                    <label for="update_password_current_password" class="form-label-custom required">
                        <i class="bi bi-lock"></i> Password Saat Ini
                    </label>
                    <input id="update_password_current_password" name="current_password" type="password" class="form-control-custom" autocomplete="current-password" />
                    @error('current_password', 'updatePassword')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group-custom">
                    <label for="update_password_password" class="form-label-custom required">
                        <i class="bi bi-key"></i> Password Baru
                    </label>
                    <input id="update_password_password" name="password" type="password" class="form-control-custom" autocomplete="new-password" />
                    @error('password', 'updatePassword')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-custom">
                    <label for="update_password_password_confirmation" class="form-label-custom required">
                        <i class="bi bi-shield-check"></i> Konfirmasi Password Baru
                    </label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control-custom" autocomplete="new-password" />
                    @error('password_confirmation', 'updatePassword')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-2">
            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-check-circle"></i> Update Password
            </button>
        </div>
    </form>
</div>
