<!DOCTYPE html>
<html>
<head>
    <title>New Upcoming Exam Notification</title>
</head>
<body>
    <h1>{{ $exam['examination_name'] }}</h1>
    <p>The exam is calling for applications. Below are the details:</p>
    <ul>
        <li>Closing Date: {{ $exam['closing_date'] }}</li>
        <li>Examination Date: {{ $exam['exam_date'] }}</li>
    </ul>
    <p>Please check the portal for more details.</p>
</body>
</html>
