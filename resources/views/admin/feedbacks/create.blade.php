@include('templates.header')
@include('templates.admin-nav')

<h2>Add Feedback</h2>

@include('templates.flash-message')

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
    <label for="title" class="form-label">Title: </label>
    <input
        type="text"
        class="form-control"
        name="title"
        readonly
        value="{{ $worklog->title }}"
    />
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description: </label>
    <textarea class="form-control" name="description" rows="3" readonly>{{ $worklog->description }}</textarea>
</div>
@if($worklog->feedbacks)
    <div class="container">
        <table class="table table-striped">
            <thead>

            <tr>
                <th scope="col">Created At</th>
                <th scope="col">Feedback</th>
            </tr>
            </thead>
            <tbody>
            @foreach($worklog->feedbacks as $feedback)
            <tr>
                <td>
                    {{$feedback->created_at->format('Y-m-d, h:i A')}}
                </td>
                <td>
                    <a href=" {{route('worklogs.feedbacks.edit', [$worklog->id, $feedback->id])}} ">
                        {{ $feedback->description }}
                    </a>
                </td>
                <td>
                    <form action="{{ route('worklogs.feedbacks.destroy', [$worklog->id, $feedback->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

<form action="{{ route('worklogs.feedbacks.store', [$worklog->id]) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="feedback" class="form-label">Feedback*: </label>
        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <input
            type="hidden"
            class="form-control"
            name="worklog_id"
            value="{{ $worklog->id }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@include('templates.footer')
