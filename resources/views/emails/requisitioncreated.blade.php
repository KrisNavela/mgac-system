<!DOCTYPE html>
<html>
<head>
    <title>Requisition Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h1 {
            color: #00A86B;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #333;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 8px 0;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }
        li:last-child {
            border-bottom: none;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Company Logo -->
        <img src="{{ asset('images/MGACLOGO.jpg') }}" style="width: 150px;" alt="Company Logo" class="logo">
        <h1>New Requisition</h1>
        <p>Request with the following details:</p>

        <div class="details">
            <ul>
                <li><strong>ID:</strong> {{ $requisition->id }}</li>
                <li><strong>Requisition No.:</strong> {{ $requisition->req_no }}</li>
            </ul>
        </div>

        <p>Thank you!</p>

        <div class="footer">
            &copy; {{ date('Y') }} Milestone Guaranty & Assurance Corp. All Rights Reserved.
        </div>
    </div>
</body>
</html>
