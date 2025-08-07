<div>
    <h1>Client Dashboard</h1>

    <nav>
        <a href="{{ route('client.orders') }}">Orders</a>
        <a href="{{ route('client.schedules') }}">Schedules</a>
        <a href="{{ route('client.locations') }}">Locations</a>
        <a href="{{ route('client.team') }}">Team</a>
    </nav>

    <div class="metrics">
        <div>Orders: {{ $ordersCount }}</div>
        <div>Schedules: {{ $schedulesCount }}</div>
        <div>Locations: {{ $locationsCount }}</div>
        <div>Team Members: {{ $teamCount }}</div>
    </div>
</div>
