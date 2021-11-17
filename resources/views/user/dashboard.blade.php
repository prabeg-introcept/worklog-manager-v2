@include('templates.header')
@include('templates.nav')

@include('templates.flash-message')

<h2>My Worklogs</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Created At</th>
        <th scope="col">Worklog</th>
        <th scope="col">Updated At</th>
    </tr>
    </thead>
    <tbody>

    @foreach($worklogs as $worklog)
    <tr>
        <td>
            <?= date('Y-m-d, h:i A', strtotime($worklog->created_at))?>
        </td>
        <td>
            <a href="{{ route('worklogs.edit', [$worklog->id]) }}">
                {{ $worklog->title }}
            </a>
        </td>
        <td>
            <?= date('Y-m-d, h:i A', strtotime($worklog->updated_at))?>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>

@include('templates.footer')
