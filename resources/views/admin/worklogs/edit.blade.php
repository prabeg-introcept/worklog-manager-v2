@include('templates.header')
@include('templates.admin-nav')

<h2>Edit Worklog</h2>

@include('templates.flash-message')

<form action="{{ route('admin.worklogs.update', [$worklog->id]) }}" method="POST">
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
                value="{{ $worklog->created_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT) }}"
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
                value="{{ $worklog->updated_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT) }}"
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

<div class="container">
    <h3>Feedbacks</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Created At</th>
            <th scope="col">Feedback</th>
        </tr>
        </thead>
        <tbody>
        @forelse($worklog->feedbacks as $feedback)
            <tr>
                <td>
                    {{$feedback->created_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT)}}
                </td>
                <td>
                    {{ $feedback->description }}
                </td>
            </tr>
        @empty
            <td>
                <div class="d-flex flex-fill justify-content-center">
                    {{ \App\Constants\EmptyTable::FEEDBACKS }}
                </div>
            </td>
        @endforelse
        </tbody>
    </table>
</div>

@include('templates.footer')
