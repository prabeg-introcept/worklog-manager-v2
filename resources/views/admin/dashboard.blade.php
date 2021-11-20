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

    @foreach($worklogs as $worklog)
        <tr>
            <td>
                {{ $worklog->created_at->format('Y-m-d, h:i A') }}
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
                <form action="{{ route('admin.worklogs.destroy', [$worklog->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this worklog?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

@include('templates.footer')
