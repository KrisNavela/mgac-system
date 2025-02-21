<!DOCTYPE html>
<html>
<head>
    <title>Requisition Delivery Notification</title>
</head>
<body>
    <h1>Delivery Notification</h1>
    <p>Your requisition of forms and supplies has been delivered with the following details:</p>
    <ul>
        <li>ID: {{ $requisition->id }}</li>
        <li>Requisition No.: {{ $requisition->req_no }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>