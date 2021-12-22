<!DOCTYPE html>
<html>

<head>
    <title>Table</title>
</head>

<body>
    <table class="table table-dark">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Six Month</th>
            <th>Three Month</th>
            <th>One Month</th>
            <th>Try Days</th>
            <th>Save</th>
            <th>Status</th>
        </tr>
        @foreach($package as $package)
        <tr>
            <td>{{$package->id}}</td>
            <td>{{$package->name}}</td>
            <td>{{$package->six_months}}</td>
            <td>{{$package->three_months}}</td>
            <td>{{$package->one_months}}</td>
            <td>{{$package->try_days}}</td>
            <td>{{$package->save}}</td>
            <td>{{$package->status}}</td>
        </tr>
        @endforeach
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Six Month</th>
            <th>Three Month</th>
            <th>One Month</th>
            <th>Try Days</th>
            <th>Save</th>
            <th>Status</th>
        </tr>
    </table>
</body>

</html>