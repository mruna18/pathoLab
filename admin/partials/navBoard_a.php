<div class="sidebar">
        <h2>The PathoLab</h2>
    <ul>
        <?php
        $sidebarLink = array(
          'Dashboard' => 'dashboard_a',
          'Profile' => 'profile',
          'Users' => 'user_management',
          'Test' => 'test_management',
          'Appoinment' => 'appointment',
        //   'Lab' => 'lab_management',
          'Finance' => 'financial_support',
          'Report and Analysis'=>'report_analysis',
          // 'Update and Maintenance'=> 'update_maintenance',
          'Customer Support'=> 'customer',
        );

        foreach ($sidebarLink as $linkName => $fileName) {
            // Font-awesome class names for different icons (assuming you're using font-awesome 6)
            $iconClasses = array(
                'Dashboard' => 'fas fa-tachometer-alt',
                'Profile' => 'fas fa-user',
                'Users' => 'fa fa-users',
                'Test' => 'fas fa-file-medical',
                'Appoinment' => 'fa fa-clock-o',
                // 'Lab' => 'fa fa-flask',
                'Finance' => 'fa-solid fa fa-money',
                'Report and Analysis'=>'fa fa-line-chart',
                // 'Update and Maintenance'=> 'fa fa-wrench',
                'Customer Support'=> 'fa fa-phone' 
            );

            echo '<li><a href="#"  ';
            echo 'onclick="loadContent(\'' . $fileName . '\')">';
            echo '<i class="' . $iconClasses[$linkName] . ' m-2 " style="color: #f2f2f2;" ></i>'; // Echo the icon using the specified class
            echo $linkName;
            echo '</a></li>';
        }
        ?>

           <li><a href="/pathology/admin/logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket" style="color: #f2f2f2f2;"></i>
            <span>Logout</span></a>
            </li>
    </ul>
</div>
