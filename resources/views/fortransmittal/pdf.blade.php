<!DOCTYPE html>
<html>
<head>
    <title>Record PDF</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Transmittal</h1>
    <table class="table">
        <tr>
            <th>Requisition Number</th>
            <td>{{ $requisition->req_no }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $requisition->req_date }}</td>
        </tr>
        
        <!-- Add more fields as necessary -->
    </table>

    <table class="table">
        <thead class="bg-gray-50">
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>HO Control Start</th>
            <th>HO Control End</th>
            <th>Series Start</th>
            <th>Series End</th>
        </thead>
        <tbody>

            <tr class="hover:bg-gray-200">

                @foreach($requisition->requisitionItems as $requisition)
                <tr class="px-6 py-4 whitespace-nowrap">
                    <td>{{ $requisition->item->item_desc }}</td>
                    <td>{{ $requisition->quantity }}</td>
                    <td>{{ $requisition->quantity_unit }}</td>
                    <td>{{ $requisition->ho_ctrl_start }}</td>
                    <td>{{ $requisition->ho_ctrl_end }}</td>
                    <td>{{ $requisition->series_start }}</td>
                    <td>{{ $requisition->series_end }}</td>
                </tr>
                @endforeach

            </tr>

        </tbody>
    </table>

</body>
</html>
