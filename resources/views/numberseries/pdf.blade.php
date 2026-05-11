<!DOCTYPE html>
<html>
<head>
    <title>Series Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background: #f2f2f2;
            padding: 6px;
        }

        td {
            padding: 5px;
        }

        h2 {
            text-align: center;
        }

        h3 {
            background: #dbeafe;
            padding: 8px;
        }

        .summary {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<h2>Series Detailed Report</h2>

@foreach ($groupedSeries as $line => $series)

    @php
        $used = $series->where('number_status', 'Used')->count();
        $unused = $series->where('number_status', 'Unused')->count();
        $total = $series->count();
    @endphp

    <h3>{{ $line }}</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Req No</th>
                <th>Date</th>
                <th>Branch</th>
                <th>Series Number</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($series as $row)

                <tr>
                    <td>{{ $row->id }}</td>

                    <td>
                        {{ $row->requisition->req_no ?? '' }}
                    </td>

                    <td>
                        {{ $row->requisition->req_date ?? '' }}
                    </td>

                    <td>{{ $row->branch_name }}</td>

                    <td>{{ $row->number }}</td>

                    <td>{{ $row->number_status }}</td>
                </tr>

            @endforeach

        </tbody>
    </table>

    <div class="summary">
        <strong>Summary for {{ $line }}</strong><br>

        Used: {{ $used }} <br>
        Unused: {{ $unused }} <br>
        Total: {{ $total }}
    </div>

@endforeach

</body>
</html>