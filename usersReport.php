<?php $page = 'usersReport'; include 'header.php'; ?>
<?php include("sidebar.php"); ?>
<?php include("usersReport-table.php"); ?>

<div class="grid-right__content">

    <div class="select-action__wrapper mt-4">
        <div class="select-action__sort">
            <span>
                <i class="fa fa-sort-amount-desc"></i>
                Sort By
            </span>
            <select class="form-select" aria-label="Default select example">
                <option selected="">Name</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>

    <div class="content-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>User ID</th>
                <th>Position</th>
                <th>Department</th>
                <th>Action</th>
                <th>Action Status</th>
                <th>Source</th>
                <th>Added At</th>
            </tr>
                        
            <form action="" method="POST">
                <!-- usersReport-table.php -->
                <?php do { ?>
                    <tr class="table-row_user Info_user table-form" value="<?php echo $userRecord_info['id'] ?>">
                    
                        <td class="user-id"><?php echo $userRecord_info['id'] ?></td>
                        <td><?php echo $userRecord_info['user_name'] ?></td>
                        <td><?php echo $userRecord_info['user_id'] ?></td>
                        <td><?php echo $userRecord_info['user_position'] ?></td>
                        <td><?php echo $userRecord_info['department'] ?></td>
                        <td><?php echo $userRecord_info['action'] ?></td>
                        <td><?php echo $userRecord_info['action_status'] ?></td>
                        <td><?php echo $userRecord_info['source'] ?></td>
                        <td><?php echo $userRecord_info['added_at'] ?></td>
                    </tr>
                <?php } while($userRecord_info = $userRecord->fetch_assoc()); ?>
                <input class="submit-button download button" name="downloadCSV" type="submit" value="Download CSV"/>
            </form>
        </table>
    </div>
</div>