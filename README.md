# PHP Push Notifications
Basic Browser Notifications made using with PHP. I made this as while learning about making Push Notifications on Browsers.

- Setting up is simple, use your preferred WebServer (XAMPP, Laragon, WAMP or anything) and navigate to index.php.
- You must allow notifications or the notifications will not be shown. (Some browsers require HTTPS for this to work).
- Import the SQL file to build the database, and make sure the PDO parameters (in notificationsHelper.php) match your Database setup.

Purpose:
I made this as a checkpoint for me to refer this in the future in case i need to use it again.

## Notification Anatomy (? idk what to call it)
- Each notification has 4 modifiable parameters:
```
- Title -> The title of the Notification
- Body -> The message accompanying the title
- Icon -> The Icon of the notification (usually your favicon)
- URL -> The destination that the user will be redirected upon clicking the URL
```

## Screenshots
#### Index.php has a form that you can create notifications
![image](https://user-images.githubusercontent.com/80538339/212025859-b79fbad3-e02e-4c24-9cde-4f6e5ea68745.png)

#### An Example notification
![image](https://user-images.githubusercontent.com/80538339/212025934-35641998-6196-46a4-a1ea-116857a0b555.png)
