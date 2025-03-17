<!DOCTYPE html>
<html>
<head>
    <title>Transmittal Report</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <h1>Transmittal Report</h1>

    <table class="table">
        <tr>
            <th>Requisition Number</th>
            <td>{{ $requisition->req_no }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $requisition->req_date }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>HO Control Start</th>
                <th>HO Control End</th>
                <th>Series Start</th>
                <th>Series End</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requisition->requisitionItems as $item)
                <tr>
                    <td>{{ $item->item->item_desc }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->quantity_unit }}</td>
                    <td>{{ $item->ho_ctrl_start }}</td>
                    <td>{{ $item->ho_ctrl_end }}</td>
                    <td>{{ $item->series_start }}</td>
                    <td>{{ $item->series_end }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
