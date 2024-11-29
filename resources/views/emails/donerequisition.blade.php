<!DOCTYPE html>
<html>
<head>
    <title>Requisition Done</title>
</head>
<body>
    <h1>Done</h1>
    <p>Done Requisition:</p>
    <ul>
        <li>ID: {{ $requisition->id }}</li>
        <li>Requisition No.: {{ $requisition->req_no }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>