<div class="sidebar" >
        <h2>The Patho Lab</h2>
    <ul>
        <?php
        $sidebarLinks = array(
          'Dashboard' => 'dashboard',
          'Profile' => 'profile',
          'Appointments' => array(
                'Lab Appointments' => 'lab_appointment',
                'Home Appointments' => 'home_registeration'
            ),
          'Test Results' => 'result',
          'Payment and Billing' => 'payment',
          'Contact Support'=> 'contact',
        );

        foreach ($sidebarLinks as $linkName => $fileName) {
            // Font-awesome class names for different icons (assuming you're using font-awesome 6)
            $iconClasses = array(
                'Dashboard' => 'fas fa-tachometer-alt',
                'Profile' => 'fas fa-user',
                'Appointments' => 'far fa-calendar',
                'Test Results' => 'fas fa-file-medical',
                'Payment and Billing' => 'fa-solid fa-credit-card',
                'Contact Support'=> 'fa-solid fa-address-book',
                    
            );

            echo '<li >';
            if (is_array($fileName)) {
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"  >';
                echo '<i class="' . $iconClasses[$linkName] . ' m-2 " style="color: #f2f2f2f2;"></i>';
                echo $linkName;
                echo '</a>';
                echo '<ul class="dropdown-menu"  >';
                foreach ($fileName as $subLinkName => $subFileName) {
                    echo '<li><a href="#" onclick="loadContent(\'' . $subFileName . '\')">' . $subLinkName . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<a href="#" onclick="loadContent(\'' . $fileName . '\')">';
                echo '<i class="' . $iconClasses[$linkName] . ' m-2 " style="color: #f2f2f2;"></i>';
                echo $linkName;
                echo '</a>';
            }
            echo '</li>';
        }
        ?>
          
           <li><a href="/pathology/user/logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket" style="color: #f2f2f2;"></i>
            <span>Logout</span></a>
            </li>
    </ul>
</div>



<!-- first attempt -->
