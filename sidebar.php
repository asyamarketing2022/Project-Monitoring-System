<?php include 'login.php'; ?>

<div class="manage-project__wrapper">

    <div class="top-bar">
        <div class="back-to-homepage">
            <i class="fa fa-arrow-left"></i>
            <span><a href="/homepage.php">Back to Homepage</a></span>
        </div>

        <div class="userLog">
            <ul>
                <li><i class="fa fa-wechat"></i></li>
                <li><i class="fa fa-bell"></i></li>

                <?php if(isset($_SESSION['UserLogin'])){ ?>

                <li><span><?php echo $_SESSION['UserLogin']; ?></span></li>
                <li><span><?php echo $_SESSION['Userlname']; ?></span></li>

                <?php } ?>

                <li><img src="img/placeholder-user.png" width="50px" alt=""></li>
                <li><a href="logout.php"><i class="fa fa-arrow-down"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="manage-employee__content">
        <div class="grid-left__menu">
            <ul>
                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                    <li><a href="/admin.php"><i class="fa fa-plus"></i> Add New Employee</a></li>
            
                <?php } ?> 

                <li><a href="/project.php"><i class="fa fa-clipboard"></i> Projects</a></li>
                <li><i class="fa fa-users"></i> Team</li>
                <li><i class="fa fa-bitcoin"></i> Financial</li>
                <li><i class="fa fa-newspaper-o"></i> Report</li>
            </ul>
        </div>