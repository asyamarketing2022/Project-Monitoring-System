<?php include 'header.php'; ?>
<?php include 'register-user.php'; ?>
<?php include 'update-user.php'; ?>
<?/*php include 'edit-user.php'; */?>
<?php include 'users-table.php'; ?>
<?php include("sidebar.php"); ?>

<?php 

if(isset($_POST['userID'])) {

    $userID =  $_POST['userID'];

    $userSQL = "SELECT * FROM registered_users WHERE ID = $userID";
    $user = $con->query($userSQL) or die ($con->error);
    $updateUser = $user->fetch_assoc();

}


?>



        <div class="grid-right__content">
            <div class="search-action__wrapper mt-4">
                <div class="search-action">
                    <input class="search" type="text">
                    <div class="search-button">Search</div>
                </div>
                <button type="button" class="btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</button>
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
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Phone Number</th>
                        <th>Access</th>
                        <th></th>
                    </tr>
                    
                    <form action="delete.php" method="POST">
                        <?php do { ?>
                        <tr class="table-row_user Info_user table-form" value="<?php echo $userInfo['ID'] ?>">
                            <td><input type="checkbox" class="id" id="id" name="lang[]" value="<?php echo $userInfo['ID'] ?>"></td>
                            <td class="user-id"><?php echo $userInfo['ID'] ?></td>
                            <td><?php echo $userInfo['first_name'] ?> <?php echo $userInfo['last_name'] ?></td>
                            <td><?php echo $userInfo['position'] ?></td>
                            <td><?php echo $userInfo['email'] ?></td>
                            <td><?php echo $userInfo['department'] ?></td>
                            <td><?php echo $userInfo['mobile_number'] ?></td>
                            <td><?php echo $userInfo['access'] ?></td>
                            <td data-toggle="modal" data-target="#edit_employee"><span class="edit" value="<?php echo $userInfo['ID'] ?>">Edit</span></td>
                        </tr>
                        <?php } while($userInfo = $users->fetch_assoc()); 
                        
                        ?>

                         <input class="submit-button" name="submit" type="submit" value="submit"/>
                    </form>
                </table>
            </div>
        </div>
    </div>

<!-- Add new employee - Modal -->
<div class="modal fade pop-up__modal" id="add_employee" tabindex="-1" role="dialog" aria-labelledby="addNewEmployeeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span class="modal-title">Account Settings Add</span>
      <!-- Tab -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile_add" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="department-tab" data-toggle="tab" href="#department_add" role="tab" aria-controls="department" aria-selected="false">Department</a>
            </li>
        </ul>
        <div class="profile-picture">
            <img src="/img/placeholder-user.png" alt="" width="250px">
            <div class="change-button">
                CHANGE
            </div>
        </div>
            <form id="profile-form" action="" method="post">
                <div class="tab-content" id="profile-tab">
                    <div class="tab-pane tab-content__info fade show active" id="profile_add" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="tab-content__profile">
                            <div class="placeholder-left"></div>
                            <div class="profile-info tab-position_right ">
                                <div class="profile-info__content">
                                    <span>First Name</span>
                                    <input type="text" name="firstname" id="firstname formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Last Name</span>
                                    <input type="text" name="lastname" id="lastname formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Gender</span>
                                    <select name="gender" id="gender" class="" aria-label="Default select Male">
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="profile-info__content">
                                    <span>Birthday</span>
                                    <input type="date" name="birthday" id="birthday formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Phone</span>
                                    <input type="text" name="mobile_number" id="mobile_number formControlDefault">
                                </div>
                                <div class="profile-info__content">
                                    <span>Address</span>
                                    <input type="text" name="address" id="address formControlDefault" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-content__info fade" id="department_add" role="tabpanel" aria-labelledby="department-tab">
                        <div class="tab-content__profile">
                            <div class="placeholder-left"></div>
                            <div class="profile-info tab-position_right ">
                                <div class="profile-info__content">
                                    <span>Email</span>
                                    <input type="email" name="email" id="email formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Department</span>
                                    <input type="text" name="department" id="department formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Position</span>
                                    <input type="text" name="position" id="position formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Password</span>
                                    <input type="text" name="password" id="password formControlDefault" required>
                                </div>
                                <div class="profile-info__content">
                                    <span>Access</span>
                                    <select name="access" id="access" class="">
                                        <option value="employee" selected>Employee</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="addSubmit" type="submit" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Edit employee - Modal -->
<div class="modal fade pop-up__modal" id="edit_employee" tabindex="-1" role="dialog" aria-labelledby="edit_employeeTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                    <h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <span class="modal-title">Account Settings Edit</span>
                <!-- Tab -->
            <ul class="nav nav-tabs" id="profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile_edit" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="department-tab" data-toggle="tab" href="#department_edit" role="tab" aria-controls="department" aria-selected="false">Department</a>
                    </li>
                </ul>
                <div class="profile-picture">
                    <img src="/img/placeholder-user.png" alt="" width="250px">
                    <div class="change-button">
                        CHANGE
                    </div>
                </div>
                <form id="editUser" action="" method="post">
                    <div class='tab-content updateform-user' id='profile-tab'>


                    </div>
                    <div class='button-wrapper'>
                        <input class='submit-button' name='submit-updateUser' type='submit' value='Save'>
                    </div>
                </form>
            </div>
        </div>
    </div>




<?php include 'footer.php'; ?>