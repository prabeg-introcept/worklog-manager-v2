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

    @forelse($worklogs as $worklog)
    <tr>
        <td>
            {{ $worklog->created_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT) }}
        </td>
        <td>
            <a href="{{ route('worklogs.edit', [$worklog->id]) }}">
                {{ $worklog->title }}
            </a>
        </td>
        <td>
            {{ $worklog->updated_at->format(\App\Constants\DateTimeFormat::DEFAULT_FORMAT) }}
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
