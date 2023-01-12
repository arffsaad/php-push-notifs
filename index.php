<!DOCTYPE html>
<html>
<head>
<title>Push Notifs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
	<br>
    <!-- bootstrap form with two fields, Title and Body -->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>PHP Push Notifications</h2>
				<form id="notificationForm">
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
					</div>
					<div class="form-group">
						<label for="body">Body</label>
						<input type="text" class="form-control" id="body" name="body" placeholder="Enter body">
					</div>
					<button type="button" id="notifyBtn" class="btn btn-primary">Notify!</button>
				</form>
			</div>
		</div>
	</div>
    <script>
        // enable this if you want to make only one call and not repeated calls automatically
        // pushNotify();

        // following makes an AJAX call to PHP to get notification every 10 secs
        setInterval(function() { pushNotify(); }, 3000);

        function pushNotify() {
        	if (!("Notification" in window)) {
        		// checking if the user's browser supports web push Notification
        		alert("Web browser does not support desktop notification");
        	}
        	if (Notification.permission !== "granted")
        		Notification.requestPermission();
        	else {
        		$.ajax({
        			url: "notificationsHelper.php",
        			type: "POST",
        			success: function(data, textStatus, jqXHR) {
        				// check if response is 200
						if (jqXHR.status == 200) {
							// create a notification
							notification = createNotification(data.title, data.icon, data.body, data.url);
							// closes the web browser notification automatically after 5 secs
							setTimeout(function() {
								notification.close();
							}, 3000);
						}
        			},
        			error: function(jqXHR, textStatus, errorThrown) { }
        		});
        	}
        };

        function createNotification(title, icon, body, url) {
        	var notification = new Notification(title, {
        		icon: icon,
        		body: body,
        	});
        	// url that needs to be opened on clicking the notification
        	// finally everything boils down to click and visits right
        	notification.onclick = function() {
        		window.open(url);
        	};
        	return notification;
        }

		$(document).ready(function () {
			$('#notifyBtn').click(function () {
				// get the form data
				var formData = $('#notificationForm').serialize();
				$.ajax({
					url: "notificationsHelper.php",
					type: "POST",
					data: formData,
					success: function() {
						alert("Notification sent successfully");
						// empty fields
						$('#title').val('');
						$('#body').val('');
					},
					error: function() {
						alert("Error sending notification");
					}
				});
			});
		});
    </script>
</body>
</html>