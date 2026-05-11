<!DOCTYPE html>
<html>
<head>
    <title>Series Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background: #f3f3f3;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Series Status Report</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Req No</th>
                <th>Date</th>
                <th>Line</th>
                <th>Branch</th>
                <th>Series Number</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($numberseries as $series)
                <tr>
                    <td>{{ $series->id }}</td>
                    <td>{{ $series->requisition->req_no ?? '' }}</td>
                    <td>{{ $series->requisition->req_date ?? '' }}</td>
                    <td>{{ $series->item->item_desc ?? '' }}</td>
                    <td>{{ $series->branch_name }}</td>
                    <td>{{ $series->number }}</td>
                    <td>{{ $series->number_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>