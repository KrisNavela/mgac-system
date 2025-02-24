<!DOCTYPE html>
<html>
<head>
    <title>Approve Requisition</title>
</head>
<body>
    <h1>Approved Requisition</h1>
    <p>With the following details:</p>
    <ul>
        <li>ID: {{ $requisition->id }}</li>
        <li>Requisition No.: {{ $requisition->req_no }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>