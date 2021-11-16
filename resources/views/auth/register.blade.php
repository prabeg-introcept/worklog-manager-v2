@include('templates.header')

<h1>Worklog Manager</h1>
<h2>Registration Form</h2>
<form action={{ route('user.register') }} method="POST">
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
        <label for="email" class="form-label">Email*: </label>
        <input
            type="email"
            class="form-control"
            name="email"
            value="{{ old('email') }}">
        <!-- Error -->
        @error('email')
        <div class="error-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="department" class="form-label">Department*: </label>
        <select class="form-select" name="department_id">
            @foreach($departments as $department)
                <option selected value=" {{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>
        @error('department_id')
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
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password*: </label>
        <input
            type="password"
            class="form-control"
            name="password_confirmation"
            value="{{ old('password_confirmation') }}">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<br>
<div>
    <p>Already Registered? <a href="{{ route('user.login') }}">Login Here</a></p>
</div>

@include('templates.footer')
