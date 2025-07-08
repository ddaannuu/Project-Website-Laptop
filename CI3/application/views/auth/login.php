<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
</head>
<body class ="login-page">
<div class="container-login">
    <h2>Login User</h2>

    <?php if ($success_message): ?>
        <div class="success">
            <p><?php echo htmlspecialchars($success_message); ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo base_url('index.php/auth/login'); ?>">

        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>
