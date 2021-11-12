<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Worklog Manager</title>
</head>
<body>
<div class="container">
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
                <option selected value="1">Digital Marketing</option>
                <option value="2">Project Management</option>
                <option value="3">Design</option>
                <option value="4">Development</option>
                <option value="5">QA</option>
                <option value="6">Customer Support</option>
            </select>
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
            <label for="confirmPassword" class="form-label">Confirm Password*: </label>
            <input
                type="password"
                class="form-control"
                name="confirmPassword"
                value="{{ old('confirmPassword') }}">
            @error('confirmPassword')
            <div class="error-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <br>
    <div>
        <p>Already Registered? <a href="{{ route('user.login') }}">Login Here</a></p>
    </div>
</div>

</body>
</html>
