<?php
/*
 * sideMenu.php is called by UI scripts to display the side-menu on the UI.
 */
    require_once($_SERVER['DOCUMENT_ROOT'] . '/../config.php');
    /* Query selects topic first posts, topic id, and thread title ordered by popularity (sum of ALL agrees and disagrees
    in entire topic)  with a limit of 5 for sidebar "hot" view */
    $query = "SELECT p.creationDate, LEFT(p.post, 120) AS post, q.id AS topicId, q.firstPostId AS fp,
                                (SELECT IFNULL(SUM(isLike),0) FROM agtodi_posts JOIN agtodi_interactions ON
                                 agtodi_interactions.postId = agtodi_posts.id WHERE agtodi_posts.topicId = q.id) AS ags,
                                 (SELECT IFNULL(SUM(isDislike),0) FROM agtodi_posts JOIN agtodi_interactions ON
                                  agtodi_interactions.postId = agtodi_posts.id WHERE agtodi_posts.topicId = q.id) AS dis,
                                (SELECT IFNULL(COUNT(*),0) FROM agtodi_posts WHERE topicId = q.id) AS reps,
                                (SELECT title FROM agtodi_threads WHERE id = q.threadId) AS title,
                                (SELECT SUM(ags + dis)) AS total
                                FROM agtodi_posts p JOIN agtodi_topics q ON p.id = q.firstPostId
                                ORDER BY total DESC
                                LIMIT 5";

    if ($stmt1 = $con->prepare($query)) {
        $stmt1->execute();
        $post_result = mysqli_stmt_get_result($stmt1);

        if ($post_result) {
            // Gets the results as an associative array.
            $all_posts1 = mysqli_fetch_all($post_result, MYSQLI_ASSOC);
        }
    }
    $stmt1->close();
?>
<div class="side-bar">
    <div class="side-hidden">
        <div class="logo-h">
            <div class="logo-t ags">agt</div>
            <div class="logo-t dis">odi</div>
        </div>
        <i class="fa fa-times" aria-hidden="true" onclick="toggleSideMenu()"></i>
    </div>
    <a href="/"><div class="menu-header-big"><i class="fa fa-home" aria-hidden="true"></i>Home</div></a>
    <a href="/agdi/threads.php"><div class="menu-header-big"><i class="fa fa-list" aria-hidden="true"></i>Topics</div></a>
    <a href="<?php /* If logged in, profile sends to profile, else login page. */
                if (isset($_SESSION['id'])) { echo '/profile.php?id='.$_SESSION['id']; } else { echo '/login.php?m=3'; }
             ?>"><div class="menu-header-big"><i class="fas fa-user" aria-hidden="true"></i>Profile</div></a>
    <div class="up-menu">
        <div class="menu-header dis"><i class="fab fa-hotjar" aria-hidden="true"></i>Hot</div>
        <?php /* Prints the hot posts mini-cards */
        foreach($all_posts1 as $posts1) {
            echo '<a href="/agdi/topic.php?topic='.$posts1['topicId'].'&fp='.$posts1['fp'].'&title='.$posts1['title'].'">
                    <div class="mini-card"><div class="min-card-header">'.$posts1['title'].'</div>
                        <div class="mini-card-text">'.$posts1['post'].'</div>
                        <div class="footer-left">
                            <div class="count ags">'.$posts1['ags'].'</div>
                            <div class="count dis">'.$posts1['dis'].'</div>
                            <div class="count rep">'.$posts1['reps'].'</div>
                    </div></div></a>';
        }?>
    </div>
</div>