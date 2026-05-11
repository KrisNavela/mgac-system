<!DOCTYPE html>
<html>
<head>
    <title>Series Summary Report</title>

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
            background: #f2f2f2;
            padding: 8px;
            text-align: center;
        }

        td {
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Series Summary Report</h2>

    <table>
        <thead>
            <tr>
                <th>Line</th>
                <th>Used</th>
                <th>Unused</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

            @php
                $grandUsed = 0;
                $grandUnused = 0;
                $grandTotal = 0;
            @endphp

            @foreach ($summary as $row)

                @php
                    $grandUsed += $row['used'];
                    $grandUnused += $row['unused'];
                    $grandTotal += $row['total'];
                @endphp

                <tr>
                    <td>{{ $row['line'] }}</td>

                    <td class="text-center">
                        {{ $row['used'] }}
                    </td>

                    <td class="text-center">
                        {{ $row['unused'] }}
                    </td>

                    <td class="text-center">
                        {{ $row['total'] }}
                    </td>
                </tr>

            @endforeach

            <tr>
                <td><strong>GRAND TOTAL</strong></td>

                <td class="text-center">
                    <strong>{{ $grandUsed }}</strong>
                </td>

                <td class="text-center">
                    <strong>{{ $grandUnused }}</strong>
                </td>

                <td class="text-center">
                    <strong>{{ $grandTotal }}</strong>
                </td>
            </tr>

        </tbody>
    </table>

</body>
</html>