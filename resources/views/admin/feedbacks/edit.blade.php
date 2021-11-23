@include('templates.header')
@include('templates.admin-nav')

<h2>Edit Feedback</h2>

@include('templates.flash-message')

<form action="{{ route('worklogs.feedbacks.update', [$feedback->worklog->id, $feedback->id]) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col">
        <label for="createdAt" class="form-label">Created At: </label>
        <input
            type="text"
            class="form-control"
            readonly
            name="date"
            value="{{ $feedback->created_at->format('Y-m-d, h:i A') }}"
        />
        </div>
        <div class="col">
            <label for="department" class="form-label">Updated At: </label>
            <input
                type="text"
                class="form-control"
                readonly
                name="department"
                value="{{ $feedback->updated_at->format('Y-m-d, h:i A') }}"
            />
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Feedback: </label>
        <textarea class="form-control" name="description" rows="3">{{ $feedback->description }}</textarea>
    </div>
    <div class="mb-3">
        <input
            type="hidden"
            class="form-control"
            name="worklog_id"
            value="{{ $feedback->worklog->id }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@include('templates.footer')
