@include('templates.header')

<h1>Worklog Manager</h1>
<h2>Login Form</h2>

@if ($message = Session::get('userRegistrationStatus'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($message = Session::get('userLoginStatus'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action={{ route('user.login') }} method="POST">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username*: </label>
        <input
            type="text"
            class="form-control"
            name="username"
            value="{{ old('username') }}"
        />
        <!-- Error -->
        @error('username')
        <div class="error-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password*: </label>
        <input
            type="password"
            class="form-control"
            name="password"
            value="{{ old('password') }}">
        @error('password')
        <div class="error-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<br>
<div>
    <p>Not Registered? <a href="{{ route('user.register') }}">Register Here</a></p>
</div>

@include('templates.footer')
