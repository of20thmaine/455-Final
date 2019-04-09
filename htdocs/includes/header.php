<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<div class="topnav">
		<div class="topnav-left">
			<a href="index.php"><p id="logo-l">agt</p><p id="logo-r">odi</p></a>
		</div>
		<div class="topnav-search">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="Search agtodi...">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
		<div class="topnav-right">
            <?php
                 if (isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['id'])) {
                    echo '<button class="lg-button" onclick="window.location.href=\'/logout.php\'">Logout</button>';
                    echo '<button class="profile-button" onclick="window.location.href=\'/profile.php?id='.
                        $_SESSION['id'].'\'"><i class="fa fa-user"></i></button>';
                    echo '<p>'.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>';
                 } else {
                    echo '<button class="lg-button" onclick="window.location.href=\'/login.php\'">Login</button>
			              <button class="lg-button" onclick="window.location.href=\'/register.php\'">Register</button>';
                 }
            ?>
		</div>
	</div>
	<div class="content">
