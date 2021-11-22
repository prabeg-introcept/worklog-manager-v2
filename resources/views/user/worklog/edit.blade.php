@include('templates.header')
@include('templates.nav')

<h2>Edit Worklog</h2>

@include('templates.flash-message')


<form action="{{ route('worklogs.update', [$worklog->id]) }}" method="POST">
    @method('PUT')
    @csrf
    @php
        $currentUser = getCurrentUser()
    @endphp
    <div class="row">
        <div class="col">
            <label for="createdAt" class="form-label">Created At: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="date"
                value="{{ $worklog->created_at->format('Y-m-d, h:i A') }}"
            />
        </div>
        <div class="col">
            <label for="createdBy" class="form-label">Created By: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="username"
                value="{{ $worklog->user->username }}"
            />
        </div>
        <div class="col">
            <label for="department" class="form-label">Department: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="department"
                value="{{ $worklog->user->department->name }}"
            />
        </div>
        <div class="col">
            <label for="department" class="form-label">Updated At: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="department"
                value="{{ $worklog->updated_at->format('Y-m-d, h:i A') }}"
            />
        </div>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title*: </label>
        <input
            type="text"
            class="form-control"
            name="title"
            value="{{ $worklog->title }}"
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
        <textarea class="form-control" name="description" rows="3">{{ $worklog->description }}</textarea>
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
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@include('templates.footer')
