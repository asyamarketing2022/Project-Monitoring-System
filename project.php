<?php $page = 'project'; include 'header.php'; ?>
<?php include 'add-project.php'; ?>
<?php include 'update-project.php'; ?>
<?php include 'project-table.php'; ?>
<?php include 'users-table.php'; ?>
<?php include 'managers-table.php'; ?>
<?php include 'assign-project.php'; ?>
<?php include 'project-history.php'; ?>
<?php include 'departmentManager.php'; ?>


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
                <!-- <ul class="select-action">
                    <li><td><input type="checkbox" id="" name="" value=""></td></li>

                    <li><i class="fa fa-edit"></i> Edit</li>
                    <li><i class="fa fa-trash"></i> Delete</li>
                </ul> -->

                <div class="select-action__sort">
                    <span><i class="fa fa-sort-amount-desc"></i> Sort by</span>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Name</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="8">8</option>
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
                        <th></th>
                    </tr>

                    
                    <!-- project-table.php for SQL -->

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

                                    <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin") { ?>
                                        
                                        <td><span data-toggle="modal" data-target="#edit_project" class="edit-project" value="<?php echo $projectInfo['id'] ?>">Edit</span></td>
                                        <td><span data-toggle="modal" data-target="#assign_project" class="view-project" value="<?php echo $projectInfo['id'] ?>">Assign</span></td>
                                    
                                    <?php } ?>

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
                                <div class="content-info__wrapper assign">
                                        <div class="content__info"> 
                                            <span>Project Name</span>
                                            <input type="text" name="project name" required>
                                        </div>
                                        <div class="content__info"> 
                                            <span>Location</span>
                                            <input type="text" name="location" required>
                                        </div>
                                        <div class="content__info"> 
                                            <span>Lot areas</span>
                                            <input type="text" name="lotAreas" required>
                                        </div>

                                        <!-- <div class="content__info" id="services"> 
                                            <span>Services</span>
                                            <select name="services" class="services" aria-label="Default select" required>
                                                <option value="" disabled selected>Select your option</option>
                                                <option value="architecture">Architecture</option>
                                                <option value="engineering">Engineering</option>
                                                <option value="interior design">Interior Design</option>
                                                <option value="master planning">Master Planning</option>
                                                <option value="scale model">Scale Model</option>
                                                <option value="animation">Animation</option>
                                                <option value="renders">Renders</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div> -->

                                        <div class="content__info" id="services"> 
                                            <span>Services</span>
                                            <div class="services_wrapper"><img src="" alt="">
                                                <div class="form-check services">
                                                    <input class="form-check-input cb-services" name="architecture" type="checkbox" value="" id="architecture">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Architecture
                                                    </label>
                                                </div>
                                                <div class="form-check services">
                                                    <input class="form-check-input cb-services" name="engineering" type="checkbox" value="" id="engineering">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Engineering
                                                    </label>
                                                </div>
                                                <div class="form-check services">
                                                    <input class="form-check-input" name="interior design" type="checkbox" value="" id="interiorDesign">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Interior Design
                                                    </label>
                                                </div>
                                                <div class="form-check services">
                                                    <input class="form-check-input" name="master planning" type="checkbox" value="" id="masterPlanning">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Master Planning
                                                    </label>
                                                </div>
                                                <div class="form-check services">
                                                    <input class="form-check-input" name="scale model" type="checkbox" value="" id="scaleModel">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Scale Model
                                                    </label>
                                                </div>
                                                <div class="form-check services">
                                                    <input class="form-check-input" name="animation" type="checkbox" value="" id="animation">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Animation
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <!--   <div class="content__info position-relative" > 
                                            <span>Department/<br>Manager</span>
                                            <input id="department" class="searchUser-input" name="department" value="" type="text"  disabled required>
                                            <span></span>
                                            <div class='dept_wrapper'>
                                                <div class="managersTable">
                                                    managersTable.php for SQL code 

                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <div class="content__info list"> 
                                        
                                        </div>

                                        <div class="content__info"> 
                                            <span>Typology</span>
                                            <select name="typology" aria-label="Default select" required>
                                                <option value="" disabled selected>Select your option</option>
                                                <option value="residential">Residential</option>
                                                <option value="office">Office</option>
                                                <option value="commercial/retail">Commercial/Retail</option>
                                                <option value="hospitality">Hospitality</option>
                                                <option value="institutional">Institutional (Pls Specify)</option>
                                                <option value="industrial">Industrial (Pls Specify)</option>
                                                <option value="airport/aviation">Airport/Aviation</option>
                                                <option value="transportTerminal">Transport Terminal</option>
                                                <option value="religiousBuilding">Religious Building</option>
                                                <option value="mixedUse">Mixed Use (Pls Specify)</option>
                                            </select>
                                        </div>
                                        <div class="content__info"> 
                                            <span>Company Name</span>
                                            <input type="text" name="company name" required>
                                        </div>
                                        <div class="content__info"> 
                                            <span>Client Name</span>
                                            <input type="text" name="client name" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- <table class="managersTable">
                        
                                    <form action="" method="POST">
                            
                                    </form>
                                </table> -->
                            <div class="button-wrapper">
                                <input class="submit-button" name="submit" type="submit" value="Save"/>
                            </div>
                        </form>
                 
                    </div>
              
                <!-- <div class='swiper-slide servicesSlide arch'>
                    <div class='modal-content'>
                        <div class='modal-header border-0'>
                            <h5></h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <span class='modal-title'>Architecture</span>

                        <div class="content-info__wrapper">
                            <div class="content__info">
                                <span>Phases of work</span>
                                <div class="phasesofwork">
                                    <div class="form-check">
                                        <input class="form-check-input" name="arch-concept" type="checkbox" value="" id="arch-concept">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Conceptual
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="arch-schematic" type="checkbox" value="" id="arch-schematic">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Schematic
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="arch-dd" type="checkbox" value="" id="arch-dd">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Design Development
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="arch-cd" type="checkbox" value="" id="arch-cd">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Construction Drawings
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="arch-ss" type="checkbox" value="" id="arch-ss">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Site Supervision
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div> -->

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
                 <!-- update-project.php -->
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
<!-- <div class="modal fade pop-up__modal" id="view_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
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
                <div class="assignform-project">
                                
                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="" type="button" data-toggle="modal" data-target="#pick_project" value="Pick">
                </div>
            </form>
        </div>
    </div>
</div> -->

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

                                            <?php if(!empty($managerInfo['ID'])) { ?>

                                                <?php do { ?>   
                                                <tr class="search-user <?php echo $managerInfo['ID'] ?>" id="<?php echo $managerInfo['ID'] ?>" value="<?php echo $managerInfo['ID'] ?>" >
                                                    <td class='nameofuser'><?php echo $managerInfo['first_name'] ?> <?php echo $managerInfo['last_name'] ?></td>
                                                    <td><?php echo $managerInfo['position'] ?></td>
                                                    <td><?php echo $managerInfo['email'] ?></td>
                                                    <td><?php echo $managerInfo['department'] ?></td>
                                            
                                                    <td><span class="pickBtn" value="<?php echo $managerInfo['ID'] ?>">Add</span></td>
                                                </tr>
                                                <?php } while($managerInfo= $manager->fetch_assoc()); ?>

                                            <?php } ?>
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