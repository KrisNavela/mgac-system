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
        <li>Requisition No.: {{ $requisition->req_no }}</li>
        <li>Courier: {{ $requisition->delivery_name }}</li>
        <li>Courier No.: {{ $requisition->delivery_no }}</li>
        <li>Delivery Date: {{ $requisition->delivery_date }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>