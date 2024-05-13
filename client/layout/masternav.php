<?php
function getActive($amenu, $tmenu)
{
    if ($amenu == $tmenu) echo "top-menu--active";
}
?>
<style>
    .top-nav>ul li ul {
        width: 16rem;
    }
    .dropdown-submenu {
    max-height: 200px; 
    overflow-y: auto; 
}
/* .top-nav > ul  {
  padding-left:20px;
  
} */
.top-nav > ul li .top-menu .top-menu__title{
    margin-left:0px;
}
.material-menu {
    position: relative;
}

.material-menu .sub-submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    
    padding: 5px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.material-menu:hover .sub-submenu {
    display: block;
}
.top-nav > ul li .top-menu {
                
                margin-right: 0.85rem;
                margin-left: 0.85rem;
                
            }

.sub-submenu li {
    padding: 8px 15px;
}

.sub-submenu a {
    color: #333;
    text-decoration: none;
}

.sub-submenu li:hover {
    background-color: #f0f0f0;
}
.parent-container {
    display: flex;
    justify-content: center; /* Horizontally center the child elements */
    align-items: center; /* Vertically center the child elements */
    /* Add any other styling you need for the parent container */
}

</style>

<nav class="top-nav">
    <ul class="dropdown-content">
    <li>
            <a href="index.php" class="top-menu <?php getActive($amenu, "dashboard"); ?>">
                <div class="top-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="top-menu__title"> Dashboard <i class="top-menu__sub-icon"></i> </div>
            </a>
        </li>
   
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Master <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Bank </div>
                    </a>
                </li>
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> HSN/SAC </div>
                    </a>
                </li>
                <li>
                    <a href="unit.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Unit </div>
                    </a>
                </li>
                <li>
                    <a href="department.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Department </div>
                    </a>
                </li>
                <li>
                    <a href="machine.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Machine </div>
                    </a>
                </li>
                <li>
                    <a href="process.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Process</div>
                    </a>
                </li>
                <li>
                    <a href=".php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> BOM </div>
                    </a>
                </li>
                <li>
                    <a href="shift.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Shift </div>
                    </a>
                </li>
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> A/C Head Stock</div>
                    </a>
                </li>
               
            </ul>
</li>
<li>
           
            

            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Location<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="country.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Country   </div>
                    </a>
                </li>
                <li>
                    <a href="state.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> State</div>
                    </a>
                </li>
                <li>
                    <a href="dist.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Dist  </div>
                    </a>
                </li> <li>
                    <a href="city.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> City  </div>
                    </a>
                </li>
                
               
            </ul>
            <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Transport<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="vehiclegroup.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vehicle Group  </div>
                    </a>
                </li>
                <li>
                    <a href="vehicle.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vehicle   </div>
                    </a>
                </li>
</ul>
        
               
            
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Vendor<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="partygroup.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party Group  </div>
                    </a>
                </li>
                <li>
                    <a href="party.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party </div>
                    </a>
                </li>
                <li>
                    <a href="vendor.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor </div>
                    </a>
                </li>
                <li>
                    <a href="vendorregistration.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor  Registration</div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Material<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="itemgroup.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Item Group  </div>
                    </a>
                </li>
                <li>
                    <a href="item.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Item Make </div>
                    </a>
                </li>
                <li>
                    <a href="itemwiserate.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Item Wise Rate </div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Item Op Stock</div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Report<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="partylistreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
                <li>
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Group Wise Item List </div>
                    </a>
                </li>
                <li>
                    <a href="vendoritemlist.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor Item List </div>
                    </a>
                </li>
                <li>
                    <a href="productionbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Production BOM</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Job contractor Bom</div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        
        
        
    </ul>
</nav>