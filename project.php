<?php include 'header.php'; ?>
<?php include 'add-project.php'; ?>
<?php include 'update-project.php'; ?>
<?php include 'project-table.php'; ?>
<?php include 'users-table.php'; ?>
<?php include 'managers-table.php'; ?>
<?php include 'assign-project.php'; ?>


<?php include("sidebar.php"); ?>

        <div class="grid-right__content">
            <div class="search-action__wrapper mt-4">
                <div class="search-action">
                    <input class="search" type="text">
                    <div class="search-button">Search</div>
                </div>

                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin") { ?>

                <button type="button" class="btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add Project</button>

                <?php } ?>
            </div>

            <div class="select-action__wrapper mt-4">
                <ul class="select-action">
                    <li><td><input type="checkbox" id="" name="" value=""></td></li>
                    <li><i class="fa fa-edit"></i> Edit</li>
                    <li><i class="fa fa-trash"></i> Delete</li>
                </ul>

                <div class="select-action__sort">
                    <span><i class="fa fa-sort-amount-desc"></i> Sort by</span>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Name</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="content-table">
                <table>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Project Name</th>
                        <th>Quality Check</th>
                        <th>File Type</th>
                        <th>Project Tree Style</th>
                        <th>Ignore Files</th>
                        <th>String Error Contact</th>
                        <th>Screen Search</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    <form action="" method="POST">
                        <?php do { ?>
                        <tr class="table-row_projects table-form" value="<?php echo $projectInfo['id'] ?>">
                            <td><input type="checkbox" id="" name="" value=""></td>
                            <td class="project-id"><?php echo $projectInfo['id'] ?></td>
                            <td><?php echo $projectInfo['code'] ?></td>
                            <td><?php echo $projectInfo['project_name'] ?></td>
                            <td><?php echo $projectInfo['quality_check'] ?></td>
                            <td><?php echo $projectInfo['file_type'] ?></td>
                            <td><?php echo $projectInfo['project_tree_style'] ?></td>
                            <td><?php echo $projectInfo['ignore_files'] ?></td>
                            <td><?php echo $projectInfo['string_error_contact'] ?></td>
                            <td><?php echo $projectInfo['screenshot_search_prefix'] ?></td>
                            <td></td>
                            <td><span data-toggle="modal" data-target="#edit_project" class="edit-project" value="<?php echo $projectInfo['id'] ?>">Edit</span></td>
                            <td><span data-toggle="modal" data-target="#assign_project" class="view-project" value="<?php echo $projectInfo['id'] ?>">Assign</span></td>

                        </tr>
                        <?php } while($projectInfo = $project->fetch_assoc()); ?>
                    </form>
                </table>
            </div>
        </div>
    <!-- </div> -->

<!-- Add New Project - Modal -->    
<div class="modal fade pop-up__modal" id="add_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add New Project</span>
                <form class="project-form " action="" method="post">
                    <div class="project">
                        <div class="content-info__wrapper">
                            <div class="content__info"> 
                                <span>Code</span>
                                <input type="text" name="code" id="code formControlDefault" required>
                            </div>
                            <div class="content__info">
                                <span>Project Name</span>
                                <input type="text" name="projectName" id="projectName formControlDefault" required>
                            </div>
                            <div class="content__info">
                                <span>Quality Check</span>
                                <select name="qualityCheck" id="qualityCheck" aria-label="Default select Male">
                                    <option value="Standard" selected>Standard</option>
                                    <option value="Standard">Standard</option>
                                </select>
                            </div>
                            <div class="content__info">
                                <span>File Type</span>
                                <select name="file_type" id="file_type" aria-label="Default select Male">
                                    <option value="Gettext PO" selected>Gettext PO</option>
                                    <option value="Gettext PO">Gettext PO</option>
                                </select>
                            </div>
                            <div class="content__info">
                                <span>Project Tree Style</span>
                                <select name="projectTreeStyle" id="projectTreeStyle" aria-label="Default select Male">
                                    <option value="Gettext PO" selected>Gettext PO</option>
                                    <option value="Gettext PO">Gettext PO</option>
                                </select>
                            </div>
                            <div class="content__info">
                                <span>Ignore Files</span>
                                <input type="text" name="ignoreFiles" id="mobile_number formControlDefault">
                            </div>
                            <div class="content__info">
                                <span>String Errors Contact</span>
                                <input type="text" name="stringErrorsContact" id="stringErrorsContact formControlDefault" required>
                            </div>
                            <div class="content__info">
                                <span>Screenshot Search Prefix</span>
                                <input type="text" name="screenSearch" id="address formControlDefault" required>
                            </div>
                            <!-- <div class="content__info">
                                <span>Disabled</span>
                                <input class="checkbox" type="checkbox" value="" id="flexCheckChecked">
                            </div> -->
                        </div>
                    </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="submit" type="submit" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Edit Project - Modal -->
<div class="modal fade pop-up__modal" id="edit_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Edit Project</span>
            <form class="project-form" action="" method="post">
                <div class="updateform-project">

                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="submit-updateProject" type="submit" value="Save">
                </div>
             </form>
        </div>
    </div>
</div>


<!-- View Project - Modal -->
<div class="modal fade pop-up__modal" id="view_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">View Project</span>
            <form class="project-form" action="" method="">
                <div class="updateform-project">

                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="" type="button" data-toggle="modal" data-target="#pick_project" value="Pick">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign Project - Modal -->
<div class="modal fade pop-up__modal" id="assign_project" tabindex="-1" role="dialog" aria-labelledby="assignProject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1700px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Assign Project</span>
            <form class="project-form" action="" method="POST">
                <div class="pick-project_form">
                    <div class="assignform-project">
                        <!-- kindly check assign-project.php for dynamic content -->   
                    </div>

                    <div class='assign-form'>
                        <div class='content-info__wrapper assign'>
                            <div class='content__info'> 
                                <span>Date Start</span>
                                <p>Date will start when all participants accept the project invation</p>
                                <!-- <input class='input dateToday' name='dateStart' type='date' id='formControlDefault' value=''> -->
                            </div>
                            <div class='content__info'> 
                                <span>Target End Date</span>
                                <input class='input' type='date' name='dateEnd' id='formControlDefault' value='' required>
                            </div>

                            <div class='content__info'> 
                                <span>Manager</span>
                                <div class="search-action__wrapper">
                                    <div class="search-action search-nb">
                                        <input class="searchUser-input" type="text">
                                        <div class="search-button">Search</div>
                                    </div>
                                    <table class="">
                                        <!-- managers-table.php for php code -->
                                        <form action="" method="POST">
                                            <?php do { ?>   
                                            <tr class="search-user <?php echo $managerInfo['ID'] ?>" id="<?php echo $managerInfo['ID'] ?>" value="<?php echo $managerInfo['ID'] ?>" >
                                                <td class='nameofuser'><?php echo $managerInfo['first_name'] ?> <?php echo $managerInfo['last_name'] ?></td>
                                                <td><?php echo $managerInfo['position'] ?></td>
                                                <td><?php echo $managerInfo['email'] ?></td>
                                                <td><?php echo $managerInfo['department'] ?></td>
                                        
                                                <td><span class="pickBtn" value="<?php echo $managerInfo['ID'] ?>">Add</span></td>
                                            </tr>
                                            <?php } while($managerInfo= $manager->fetch_assoc()); ?>
                                        </form>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    
                <div class="button-wrapper">
                    <!-- <input class="submit-button" name="submit" type="submit" value="Save"/> -->
                    <input class="submit-button" name="submitAssign" type="submit" value="Assign">
                </div>
            </form>
        </div>
    </div>
</div>





<?php include 'footer.php'; ?>