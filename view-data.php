<?php 
include "db.php";
date_default_timezone_set("Asia/Kolkata");
$sql = "SELECT * FROM `gps_data`";
$res = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_assoc($res)) {
   
   $status = $row['status'];

   ?> 
   <tr>
			<td><?=$row['name'];?></td>
			<td><?=$row['last_zone'];?></td>
			<td><?=$row['last_loc'];?></td>
			<td>
                <?php 
                if ($status == "online" or $status == "button pressed") {
                ?>
                <span class="badge badge-lg badge-dot">
                    <i class="bg-success"></i><?=$status;?>
                </span>
            <?php
            }
            else{
            ?>
                <span class="badge badge-lg badge-dot">
                        <i class="bg-danger"></i><?=$status;?>
                </span>
            <?php
            }
            ?>
            </td>
            <td><?=$row['last_update'];?></td>
            <td class="text-end">
                <a href="view-data-uid.php?id=<?=$row['uid'];?>" class="btn btn-sm btn-neutral"><i class="bi bi-eye-fill"></i> view</a>
               <a href="edit.php?id=<?=$row['id'];?>" class="btn btn-sm btn-neutral"><i class="bi bi-pencil"></i> Edit</a>
               <a href="delete.php?id=<?=$row['id'];?>" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></a>
                  
            </td>
		</tr>
<?php
    }
?>                                