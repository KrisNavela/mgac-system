<!DOCTYPE html>
<html>
<head>
    <title>For Bonds Approval</title>
</head>
<body>
    <h1>New Requisition Created</h1>
    <p>A new requisition has been created with the following details:</p>
    <ul>
        <li>ID: {{ $requisition->id }}</li>
        <li>Requisition No.: {{ $requisition->req_no }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>