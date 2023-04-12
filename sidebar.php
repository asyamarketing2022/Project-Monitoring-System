<?php include 'login.php'; ?>
<?php include 'notification-box.php'; ?>

<div class="manage-project__wrapper">

    <div class="top-bar">
        <div class="back-to-homepage">
            <i class="fa fa-arrow-left"></i>
            <span><a href="/homepage.php">Back to Homepage</a></span>
        </div>

        <div class="userLog">
            <ul>
                <li><i class="fa fa-wechat"></i></li>
                <!-- For dynamic codes - notification.php -->
                <li><i class="fa fa-bell"><span class="notif_count"></span></i></li>


                <?php if(isset($_SESSION['UserLogin'])){ ?>

                <li><span><?php echo $_SESSION['UserLogin']; ?></span></li>
                <li><span><?php echo $_SESSION['Userlname']; ?></span></li>

                <?php } ?>

                <li><img src="img/placeholder-user.png" width="50px" alt=""></li>
                <li><a href="logout.php"><i class="fa fa-arrow-down"></i></a></li>
            </ul>

                <?php if (mysqli_num_rows($notif) > 0){ ?>

                    <div class="notif-list">
                        <div class="notif_container">

                            <?/*php while($notif_info = mysqli_fetch_assoc($notif)) { */?>

                                <?php do { ?>

                                    <?php if($notif_info['notif_status'] == 'new') { ?>

                                        <div class="notif_box">
                                            <div class="profile-photo">
                                                <img src="" alt="">
                                            </div>
                                            <div class="notif-text">
                                                <p>You have new project</p>
                                                <span><?php echo $notif_info['added_at'] ?></span>
                                             
                                            </div>
                                        </div>

                                    <?php } ?>

                                <?php } while($notif_info = $notif->fetch_assoc()); ?>

                            <?/*php } */?>

                        </div>
                    </div>      

                <?php } ?>
          
        </div>
    </div>

    <div class="manage-employee__content">
        <div class="grid-left__menu">
            <ul>
                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                    <li class="<?php if($page=='admin'){echo 'active';} ?>"><a href="/admin.php"><i class="fa fa-plus"></i> Add New Employee</a></li>
            
                <?php } ?> 

                <li class="<?php if($page=='project'){echo 'active';} ?>" ><a href="/project.php"><i class="fa fa-clipboard"></i> Projects</a></li>
                <li class="<?php if($page=='profile'){echo 'active';} ?>"><a href="/profile.php"> <i class="fa fa-users"></i> Profile</a></li>
                <li class="<?php if($page=='usersReport'){echo 'active';} ?>"><a href="/usersReport.php"><i class="fa fa-newspaper-o"></i>Users Report</a></li>
                <li><a href="#"><i class="fa fa-bitcoin"></i> Financial</a></li>
                
            </ul>
        </div>