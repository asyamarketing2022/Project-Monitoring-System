<?php include 'login.php'; ?>
<?php include 'notification-box.php'; ?>
<?php include 'notification-task.php'; ?>


<div class="manage-project__wrapper">

    <div class="top-bar">
        <div class="back-to-homepage">
            <i class="fa fa-arrow-left"></i>
            <span><a href="/homepage.php">Back to Homepage</a></span>
        </div>

        <div class="userLog">
            <ul>
                <li><i class="fa fa-wechat"></i></li>
                <!-- For dynamic codes - notification-count.php -->
                <li>
                    <i class="fa fa-bell">
                            <span class="notif_count"></span>
                    </i>
                </li>

                <?php if(isset($_SESSION['UserLogin'])){ ?>

                <li><span><?php echo $_SESSION['UserLogin']; ?></span></li>
                <li><span><?php echo $_SESSION['Userlname']; ?></span></li>

                <?php } ?>

                <li><img src="img/placeholder-user.png" width="50px" alt=""></li>
                <li><a href="logout.php"><i class="fa fa-arrow-down"></i></a></li>
            </ul>

                <?php if (mysqli_num_rows($tasks) > 0){ ?>

                    <div class="notif-list">
                        <div class="notif_container">

                        <?php do { ?>

                            <?php if($newtask_notif['invite_status'] == 'new') { ?>
                                <div class="notif_box">
                                    <a href="/profile.php">
                                        <div class="notif-text pb-2">
                                            <span class='notif-message' style='font-size: 20px;'><strong>You have new Task</strong></span></br>
                                            <span><?php echo $newtask_notif['sent_by']?> sent a new task from </span></br>
                                            <span><strong><?php echo $newtask_notif['project_name'] ?></strong> project</span></br>
                                            <span>Task TItle: <strong><?php echo $newtask_notif['task_title'] ?></strong></span></br>
                                            <span class='newTask-date'><?php echo $newtask_notif['added_at']?></span>

                                        </div>
                                    </a>
                                </div>
                            <?php } ?>

                            <?php } while($newtask_notif = $tasks->fetch_assoc()); ?>

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