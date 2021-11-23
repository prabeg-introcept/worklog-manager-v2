@include('templates.header')
@include('templates.admin-nav')

<h2>Create Worklog</h2>
<form action="{{route('admin.worklogs.store')}}" method="post">
    @csrf
    @php
        $currentUser = getCurrentUser()
    @endphp
    <div class="row">
        <div class="col">
            <label for="createdAt" class="form-label">Date: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="date"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d, h:i A') }}"
            />
        </div>
        <div class="col">
            <label for="createdBy" class="form-label">Created By: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="username"
                value="{{ $currentUser->username }}"
            />
        </div>
        <div class="col">
            <label for="department" class="form-label">Department: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="department"
                value="{{ $currentUser->department->name }}"
            />
        </div>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title*: </label>
        <input
            type="text"
            class="form-control"
            name="title"
            value="{{old('title')}}"
        />
        <!-- Error-Title -->
        @error('title')
        <div class="error-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description*: </label>
        <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
        <!-- Error-Description -->
        @error('description')
        <div class="error-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <input
            type="hidden"
            class="form-control"
            name="user_id"
            value="{{ $currentUser->id }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@include('templates.footer')
