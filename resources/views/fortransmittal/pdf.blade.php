<!DOCTYPE html>
<html>
<head>
    <title>Transmittal Report</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            color: #333;
            background-color: white; /* Removed gray background */
        }
        .container {
            max-width: 900px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #007bff;
        }
        h1 {
            font-size: 24px;
            color: #007bff;
        }
        .details {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            background: none; /* Removed gray background */
        }
        .details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .details span {
            font-weight: bold;
            color: #007bff;
        }
        .items-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            font-size: 12px; /* Adjust the font size here */
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .items-table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }
        .items-table tbody tr:nth-child(even) {
            background: none; /* Removed gray alternating rows */
        }
        .items-table tbody tr:hover {
            background-color: #e9f2ff;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Transmittal Report</h1>
        </div>

        <!-- Requisition Details using Paragraphs -->
        <div class="details">
            <p><span>Requisition No.:</span> {{ $requisition->req_no }}</p>
            <p><span>Date:</span> {{ $requisition->req_date }}</p>
        </div>

        <!-- Requisition Items Table -->
        <table class="items-table">
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
    </div>

</body>
</html>
