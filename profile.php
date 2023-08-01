<?php $page = 'profile'; include 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'myprojects-table.php'; ?>
<?php include_once 'assign-project.php'; ?>
<?php include_once 'projectIncharge_table.php'; ?>
<?php include_once 'view-myproject.php'; ?>
<?php include_once 'picproject-table.php'; ?>
<?php include_once 'project-history.php'; ?>
<?/*php include 'assign-projectIncharge.php'; */?>

<div class="grid-right__content">
    <div class="profile">
        <div class="profile-container">
            <div class="profile-column">
                <div class="myprofile-info">
                    <div class="myphoto">
                        <img src="/img/placeholder-user.png" alt="">
                        <div class="change-photo">
                            <button><a href="#">Change Photo</a></button>
                        </div>
                    </div>
                    <div class="profile-info">
                        <?php if(isset($_SESSION['UserLogin'])){ ?>
                            <div class="profile-info__content">
                                <span>Name</span>
                                <p ><?php echo $_SESSION['UserLogin']; ?> <?php echo $_SESSION['Userlname']; ?></p>
                            </div>
                            <div class="profile-info__content">
                                <span>Position</span>
                                <p><?php echo $_SESSION['Position']; ?></p>
                            </div>
                            <div class="profile-info__content">
                                <span>Department</span>
                                <p><?php echo $_SESSION['Department']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mydesc">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit repellat debitis nisi fuga quod! Illo debitis deserunt incidunt veniam? Illum, veniam voluptas alias eum impedit minima iste velit eos. Corporis.
                        Amet, tenetur odio reprehenderit aut omnis velit nostrum cupiditate molestias pariatur nihil illo odit minus facilis tempore rem quos voluptas quisquam, quia ad labore eveniet accusamus nemo exercitationem. Debitis, culpa.
                        Corporis porro tempora blanditiis ut eveniet, enim atque illo veniam quod assumenda expedita laboriosam sit accusantium. Tempora natus, neque id enim saepe nihil, et, placeat alias incidunt exercitationem ad odio!
                        In, sint itaque, enim perspiciatis pariatur cumque est libero et rerum sapiente molestiae perferendis? Iusto magni officiis amet cumque magnam deserunt eius quo molestias. Mollitia, corrupti deserunt. Dolore, autem facere?
                        Quae asperiores expedita deserunt sunt dolor. Molestiae veritatis adipisci corporis. Enim reiciendis in repudiandae ratione. Voluptatibus doloremque architecto praesentium est sit sint eligendi ducimus aperiam possimus maxime, reiciendis in quis.</p>
                    </div>
                </div>

                <div class="myprojects">
                    <h1>My Projects</h1>
                  
                    <div class="content-table">
                        <div class="search-action__wrapper">
                            <div class="search-action">
                                <input class="search" type="text">
                                <div class="search-button">Search</div>
                            </div>
                        </div>
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Service</th>
                                    <th>Phase of work</th>
                                    <th>Task Title</th>
                                    <th>Date Started</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>

                                <!-- myprojects-table.php -->

                                    <?php if(!empty($userProject['id'])) { ?>

                                        <?php do { ?>

                                            <tr class="task-table_row" value="<?php echo $userProject['id']; ?>">
                                                <td><?php echo $userProject['project_name']; ?></td>
                                                <td><?php echo $userProject['services']; ?></td>
                                                <td><?php echo $userProject['phase_of_work']; ?></td>
                                                <td><?php echo $userProject['task_title']; ?></td>
                                                <td><?php echo $userProject['date_started']; ?></td>
                                                <td><?php echo $userProject['due_date']; ?></td>
                                                <td><?php echo $userProject['status']; ?></td>
                                                <td class='invite_status_td'>

                                                    <?php if($userProject['invite_status'] == 'new'){ ?>

                                                    <button class='new-task-btn'>
                                                        <?php echo $userProject['invite_status']; ?>
                                                    </button>
                                                    <div class="invite_status_tooltip d-none">
                                                        <div class="invite_status_wrapper">
                                                            <div class="invite_status_form">
                                                                <div class="content-info__wrapper">
                                                                    <div class="button-wrapper pb-0">
                                                                        <button class='accept' type='button'><span>Accept</span>
                                                                            <img class='check-icon' src="img/check-solid-white.svg" alt="">
                                                                        </button>
                                                                        <button class='decline' type='button'>Decline 
                                                                            <img class='x-icon' src="img/x-solid-white.svg" alt="">
                                                                        </button>
                                                                    </div>
                                                                    <div class="decline-note_wrapper pt-3 d-none">
                                                                        <div class="content__info">
                                                                            <span>Notes:</span>
                                                                            <textarea class="decline-notes" name="notes" id="" cols="25" rows="5"  placeholder="Why you decline the task?" required></textarea>
                                                                        </div>
                                                                        <div class="button-wrapper">
                                                                            <input class="submit-button submit-decline" name="" type="submit" value="Submit">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } else { ?>
                                                        <span><?php echo $userProject['invite_status']; ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        <?php } while($userProject = $myProjects->fetch_assoc()); ?>

                                    <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

<!-- View My Project - Modal -->
<div class="modal fade pop-up__modal" id="view_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1700px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Project Name</span>
            <div class="here"></div>
            <form class="project-form" action="profile.php" method="POST">
                <div class="myProject-form">
                    <div class='myProject-details'>
                        <!-- view-myproject.php for php code -->
                    </div>
                    <div class='myProject-status'>
                        <div class='content-info__wrapper assign'>
                            <div class='content__info'>
                                <span>Status</span>
                                <p></p>
                            </div> 
                            <div class='content__info'>
                                <span>Date Start</span>
                                <p></p>
                            </div> 
                            <div class='content__info'>
                                <span>Target End Date</span>
                                <p></p>
                            </div> 

                            <?php if (isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" || $_SESSION['Access'] == "manager") { ?>

                                <div class='content__info'> 
                                    <span>Project In Charge</span>
                                    <div class='search-action__wrapper'>
                                        <div class='search-action search-nb'>
                                            <input class='searchUser-input' type='text'>
                                            <div class='search-button'>Search</div>
                                        </div>
                                        <table class=''>
                                        <form action="" method="POST">
                                                <?php do {  ?>   
                                                <tr class='search-user' id=" <?php echo $employeeInfo['ID']; ?> " value=" <?php echo $employeeInfo['ID']; ?> " >
                                                    <td class='nameofuser'> <?php echo $employeeInfo['first_name']; ?> <?php echo $employeeInfo['last_name']; ?></td>
                                                    <td><?php echo $employeeInfo['position']; ?></td>
                                                    <td><?php echo $employeeInfo['email']; ?></td>
                                                    <td><?php echo $employeeInfo['department']; ?></td>
                                            
                                                    <td><span class='pickBtn' value='<?php echo $employeeInfo['first_name']; ?> <?php echo $employeeInfo['last_name']; ?>'>Adds</span></td>
                                                </tr>
                                            <?php } while($employeeInfo = $employee->fetch_assoc()); ?>
                                            </form>
                                        </table>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="button-wrapper">
                    <input class="submit-button prevent" name="submitPIC" type="submit" value="Submit">
                    <input class="submit-button" name="" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>
