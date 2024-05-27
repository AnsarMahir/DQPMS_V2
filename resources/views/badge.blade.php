<!DOCTYPE html>
<html>
<head>
    <title>Badge Page</title>
</head>
<body>
    <form id="badgeForm" action="/generate-badge" method="POST" style="display: none;">
        @csrf
    </form>
    <script>
        // Automatically submit the form to trigger the badge generation
        document.getElementById('badgeForm').submit();
    </script>
</body>
</html>