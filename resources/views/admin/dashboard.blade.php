@include('templates.header')
@include('templates.admin-nav')

@include('templates.flash-message')

<h2>Admin Dashboard</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Created At</th>
        <th scope="col">Created By</th>
        <th scope="col">Department</th>
        <th scope="col">Worklog</th>
        <th scope="col">Updated At</th>
    </tr>
    </thead>
    <tbody>

    @forelse($worklogs as $worklog)
        <tr>
            <td>
                {{ $worklog->created_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT) }}
            </td>
            <td>
                {{ $worklog->user->username }}
            </td>
            <td>
                {{ $worklog->user->department->name }}
            </td>
            <td>
                <a href=" {{route('admin.worklogs.edit', [$worklog->id])}} ">
                    {{ $worklog->title }}
                </a>
            </td>
            <td>
                {{ $worklog->updated_at->format('Y-m-d, h:i A') }}
            </td>
            <td>
                <a href="{{ route('worklogs.feedbacks.create', [$worklog->id]) }}">Add Feedback</a>
            </td>
            <td>
                <form action="{{ route('admin.worklogs.destroy', [$worklog->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this worklog?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <td>
            <div class="d-flex flex-fill justify-content-center">
                {{ \App\Constants\EmptyTable::WORKLOGS }}
            </div>
        </td>
    @endforelse

    </tbody>
</table>

@include('templates.footer')
