@include('templates.header')
@include('templates.nav')


<h2>Edit Worklog</h2>

@include('templates.flash-message')


<form action="{{ route('worklogs.update', [$worklog->id]) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3">
        <label for="lastUpdatedAt" class="form-label">Last Updated At: </label>
        <input
            type="text"
            class="form-control"
            readonly
            name="date"
            value="{{ $worklog->updated_at->format('Y-m-d, h:i A') }}"
        />
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
        <textarea class="form-control" name="description" rows="3">{{ $worklog->description}}</textarea>
        <!-- Error-Description -->
        @error('title')
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
            value="{{ auth()->id() }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@include('templates.footer')
