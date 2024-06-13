<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Activity</h1>
        <form action="#" method="post">
            <label for="activity-name">Activity Name:</label>
            <input type="text" id="activity-name" name="activity-name" required>
            <label for="activity-description">Description:</label>
            <textarea id="activity-description" name="activity-description" required></textarea>
            <label for="activity-due-date">Due Date:</label>
            <input type="date" id="activity-due-date" name="activity-due-date" required>
            <button type="submit">Add Activity</button>
        </form>
    </div>
</body>
</html>
