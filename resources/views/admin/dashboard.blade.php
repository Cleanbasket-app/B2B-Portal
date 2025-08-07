<div>
    <h1>Admin Dashboard</h1>

    <nav>
        <a href="{{ route('admin.orders') }}">Orders</a>
        <a href="{{ route('admin.schedules') }}">Schedules</a>
        <a href="{{ route('admin.locations') }}">Locations</a>
        <a href="{{ route('admin.team') }}">Team</a>
        <a href="{{ route('admin.activity-logs') }}">Activity Logs</a>
    </nav>

    <div class="metrics">
        <div>Orders: {{ $ordersCount }}</div>
        <div>Schedules: {{ $schedulesCount }}</div>
        <div>Locations: {{ $locationsCount }}</div>
        <div>Team Members: {{ $teamCount }}</div>
    </div>
</div>
