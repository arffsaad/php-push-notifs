<?php
if (isset($_POST['title']) && isset($_POST['body'])) {
    $db = new PDO('mysql:host=localhost:3307;dbname=notifspoc;charset=utf8mb4', 'root', '');
    $stmt = $db->prepare('INSERT INTO notifications (title, body) VALUES (:title, :body)');
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':body', $_POST['body']);
    $stmt->execute();
}
else{
    // database connection
    $db = new PDO('mysql:host=localhost:3307;dbname=notifspoc;charset=utf8mb4', 'root', '');
    // get the last notification id from the database
    $notifscount = 0;
    $query = "SELECT COUNT(*) FROM notifications WHERE notified = 0";
    $statement = $db->prepare($query);
    $statement->execute();
    $notifscount = $statement->fetchColumn();

    if ($notifscount > 0) { 
        $query = "SELECT * FROM notifications WHERE notified = 0 LIMIT 1";
        $statement = $db->prepare($query);
        $statement->execute();
        $notification = $statement->fetch(PDO::FETCH_ASSOC);
        $webNotificationPayload = array();
        $webNotificationPayload['title'] = $notification['title'];
        $webNotificationPayload['body'] = $notification['body'];
        $webNotificationPayload['icon'] = 'https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png';
        $webNotificationPayload['url'] = 'https://github.com';
        // update the notified status to 1
        $query = "UPDATE notifications SET notified = 1 WHERE id =" . $notification['id'];
        $statement = $db->prepare($query);
        $statement->execute();
        // return the response with data for push notification
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($webNotificationPayload);
        exit();
    }
    else {
        // give error status
        http_response_code(204);
    }
}
// $webNotificationPayload['title'] = 'Push Notification from PHP';
// $webNotificationPayload['body'] = 'PHP to browser web push notification.';
// $webNotificationPayload['icon'] = 'https://phppot.com/badge.png';
// $webNotificationPayload['url'] = 'https://phppot.com';
// echo json_encode($webNotificationPayload);
// exit();
?>