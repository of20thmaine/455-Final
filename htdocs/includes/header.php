<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="/css/min.css">
</head>
<body>
	<div class="topnav">
		<div class="topnav-left">
            <i class="fas fa-bars" id="menu-button" onclick="toggleSideMenu()"></i>
			<a href="/"><p id="logo-l">agt</p><p id="logo-r">odi</p></a>
		</div>
		<div class="topnav-search">
			<form action="/search.php" method="get">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
			   <input type="text" class="searchTerm" name="search" placeholder="Search agtodi...">
		   </form>
        </div>
		<div class="topnav-right">
            <?php
                 if (isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['id'])) {
                    echo '<button class="lg-button rhi" onclick="window.location.href=\'/logout.php\'">Logout</button>';
                    echo '<button class="profile-button" onclick="window.location.href=\'/profile.php?id='.
                        $_SESSION['id'].'\'"><i class="fa fa-user"></i></button>';
                    echo '<p>'.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>';
                 } else {
                    echo '<button class="lg-button rhi" onclick="window.location.href=\'/login.php\'">Login</button>
			              <button class="lg-button rhi" onclick="window.location.href=\'/register.php\'">Register</button>';
                 }
            ?>
            <div class="hidden">
                <i id="show-hidden" class="fa fa-ellipsis-v" aria-hidden="true" onclick="toggleHiddenMenu()"></i>
                <div class="hidden-sub">
                    <div class="hidden-search">
                        <form action="/search.php" method="get">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                            <input type="text" class="searchTerm" name="search" placeholder="Search agtodi...">
                        </form>
                    </div>
                    <?php
                    if (isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['id'])) {
                        echo '<button class="lg-button" onclick="window.location.href=\'/logout.php\'">Logout</button>';
                    } else {
                        echo '<button class="lg-button" onclick="window.location.href=\'/login.php\'">Login</button>
			              <button class="lg-button" onclick="window.location.href=\'/register.php\'">Register</button>';
                    }
                    ?>
                </div>
            </div>
		</div>
	</div>
	<div class="content">
