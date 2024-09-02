<?php

include "function.php";
$action = "";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: signin.php", true, 303);
    exit();
} else {
    getParams(); // Assuming this function extracts parameters like $action, $postcontent, etc.
    
    if ($action == "sharepost" && strlen($postcontent) > 0) {
        try {
            $stmt = $conn->prepare("INSERT INTO `post`(`content`, `userid`) VALUES (:content, :userid)");
            $stmt->bindParam(':content', $postcontent);
            $stmt->bindParam(':userid', $_SESSION["user"]["userid"]);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        header("Location: main.php", true, 303);
        exit();
    }
    include "header.php";
?>

<!-- Your existing HTML and PHP code for the page -->

<?php

    // Fetch posts from users that the current user is following
    $stmt = $conn->prepare("SELECT * FROM `following` WHERE `userid` = :userid");
    $stmt->bindParam(':userid', $_SESSION["user"]["userid"]);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $sql = "SELECT * FROM `post` WHERE `userid` IN (";
        $followed_users = [];
        foreach ($stmt->fetchAll() as $k => $v) {
            $followed_users[] = $v["followingid"];
        }
        $sql .= implode(", ", $followed_users) . ")";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $k => $v) {
            $stmt2 = $conn->prepare("SELECT * FROM `user` WHERE `id` = :userid");
            $stmt2->bindParam(':userid', $v["userid"]);
            $stmt2->execute();
            
            foreach ($stmt2->fetchAll() as $k2 => $v2) {
                $postfname = $v2["firstname"];
                $postlname = $v2["lastname"];
            }

            echo '<div class="bgwhite w-100 mb-3" style="border-radius: 0.8rem;">
                  <div class="mt-3 d-flex">
                      <img src="img/logo.jpg" class="rounded-circle m-3" style="width: 45px; height:45px;" />
                      <div class="d-flex mt-3 m-0 flex-column">
                          <h6 class="m-0">' . htmlspecialchars($postfname . ' ' . $postlname) . '</h6>
                          <span style="font-size: 12px;">Full Stack Dev</span>
                      </div>
                  </div>
                  <div id="post" class="px-3 pb-3" style="text-align: justify; overflow:auto;">' . htmlspecialchars($v["content"]) . '</div>
              </div>';
        }
    }
?>

<?php } ?>

<script>
// Your existing JavaScript code here
</script>
