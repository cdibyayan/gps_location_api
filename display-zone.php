<?php 
include "db.php";
//date_default_timezone_set("Asia/Kolkata");
$sql = "SELECT * FROM `zone_track`";
$res = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_assoc($res)) {
   
   $status = $row['status'];

   ?> 
   <tr>
			<td><?=$row['uid'];?></td>
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
		</tr>
<?php
    }
?>                                