<!DOCTYPE html>
<html>
<head>
    <title>Transmittal Report</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            color: #333;
            background-color: white;
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
            border-bottom: 3px solid #000000;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 250px; /* Increase width */
            height: auto; /* Maintain aspect ratio */
        }
        h1 {
            font-size: 24px;
            color: #000000;
        }
        .details {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
        }
        .details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .details span {
            font-weight: bold;
            color: #000000;
        }
        .items-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            font-size: 10px; /* changed from 12px to 10px */
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 6px; /* reduce padding from 10px */
            text-align: left;
        }
        .items-table th {
            background-color: #FFFFFF;
            color: black;
            text-transform: uppercase;
        }
        .items-table tbody tr:hover {
            background-color: #e9f2ff;
        }
        .footer {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
        }
        .footer p {
            margin: 5px 0;
            font-size: 12px;
        }
        .footer span {
            font-weight: bold;
            color: #000000;
        }
        .signature-line {
            border-top: 1px solid black; /* Thin black line */
            width: 200px; /* Adjust width as needed */
            margin: 10px 0; /* Space around the line */
            padding-top: 5px; /* Space between line and text */
        }
        .page-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: right;
            font-size: 12px;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <!-- Company Logo -->
            <img src="{{ public_path('images/MGACLOGO.jpg') }}" alt="Company Logo" class="logo">
            <h1>Transmittal Report</h1>
        </div>

        <!-- Requisition Details using Paragraphs -->
        <div class="details">
            <p><span>Requisition No.:</span> {{ $requisition->req_no }}</p>
            <p><span>Branch:</span> {{ $requisition->user->branch->branch_name }}</p>
            <p><span>Date:</span> {{ $requisition->req_date }}</p>
        </div>

        <!-- Requisition Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>HO Ctrl Start</th>
                    <th>HO Ctrl End</th>
                    <th>HO Ctrl End</th>
                    <th>COC Prefix</th>
                    <th>Series End</th>
                    <th>Unreported</th>
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
                        <td>{{ $item->coc_prefix }}</td>
                        <td>{{ $item->series_start }}</td>
                        <td>{{ $item->series_end }}</td>
                        <td>{{ $item->unreported }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
                <p>&nbsp;</p> <!-- Blank line -->
                <p>&nbsp;</p> <!-- Blank line -->
            <p><span>Prepared By:</span></p>
                <p>&nbsp;</p> <!-- Blank line -->
                <p>&nbsp;</p> <!-- Blank line -->
            <p class="signature-line">Name and Signature</p>
                <p>&nbsp;</p> <!-- Blank line -->
                <p>&nbsp;</p> <!-- Blank line -->
            <p><span>Received By:</span></p>
                <p>&nbsp;</p> <!-- Blank line -->
                <p>&nbsp;</p> <!-- Blank line -->
            <p class="signature-line">Name and Signature</p>
        </div>

        <div class="page-footer">
            <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>
        </div>
    </div>

</body>
</html>
