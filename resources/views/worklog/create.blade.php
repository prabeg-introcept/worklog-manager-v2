@include('templates.header')
@include('templates.nav')


<h2>Create Worklog</h2>
<form action="{{route('worklogs.store')}}" method="post">
    @csrf
    <div class="mb-3">
        <label for="Date" class="form-label">Date: </label>
        <input
            type="text"
            class="form-control"
            readonly
            name="date"
            value="{{ \Carbon\Carbon::now()->format('Y-m-d, h:i A') }}"
        />
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
            value="{{ auth()->id() }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@include('templates.footer')
