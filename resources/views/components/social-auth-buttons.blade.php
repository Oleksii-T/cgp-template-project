<div style="display:flex; justify-content: space-around; font-size: 12px; margin-top: 20px;">
    {{-- Login with Google --}}
    <div class="flex items-center justify-end mt-4">
        <a href="{{ url('auth/google') }}"
           style="background: #4285F4; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
            Sign In with Google
        </a>
    </div>
    {{-- Login with GitHub --}}
    <div class="flex items-center justify-end mt-4">
        <a class="btn" href="{{ url('auth/github') }}"
           style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
            Sign In with GitHub
        </a>
    </div>
    {{-- Login with Facebook --}}
    <div class="flex items-center justify-end mt-4">
        <a class="btn" href="{{ url('auth/facebook') }}"
           style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
            Sign In with Facebook
        </a>
    </div>
</div>
