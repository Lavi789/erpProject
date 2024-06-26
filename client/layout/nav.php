<?php
function getActive($amenu, $tmenu)
{
    if ($amenu == $tmenu) echo "top-menu--active";
}
?>

<style>
    .top-nav>ul li ul {
        width: 600px;
        overflow-y: auto; 
    }
    .dropdown-submenu {
    max-height: 100px; 
    overflow-y: auto; 
}
.top-nav > ul li ul li{
    display:inline-block;
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
    padding: 8px 30px;
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
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "master"); ?>">
                <div class="top-menu__icon"><i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Master <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="dropdown-submenu">
                <li>
                    <a href="currency.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="top-menu__title"> Currency </div>
                    </a>
                </li>
                <li class="material-menu">
                    <a href="branch.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="layers"></i> </div>
                        <div class="top-menu__title">Location</div>
                    </a>
                    <ul class="sub-submenu">
                    <li><a href="index_country.php">Country</a></li>
                      <li><a href="state.php">State</a></li>
                      <li><a href="index_district.php">Dist</a></li>
                      <li><a href="city.php">City</a></li>
                      </ul>

                </li>
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="scissors"></i> </div>
                        <div class="top-menu__title"> Bank </div>
                    </a>
                </li>
                <li class="material-menu">
                    <a href="mfg_company.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="bar-chart-2"></i> </div>
                        <div class="top-menu__title"> Vendor </div>
                    </a>
                    <ul class="sub-submenu">
                      <li><a href="partygroup.php"> Party Group</a></li>
                      <li><a href="party.php">Party</a></li>
                      <li><a href="registration.php">Vendor Registration</a></li>
                      </ul>
                </li>
                <li>
                    <a href="customer.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title">HSN/SAC</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Unit </div>
                    </a>
                </li>
                <li class="material-menu">
                       <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                         <div class="top-menu__title"> Material</div>
                   </a>
                      <ul class="sub-submenu">
                      <li><a href="itemgroup.php"> Item Group</a></li>
                      <li><a href="item.php">Item</a></li>
                      <li><a href="#">Make</a></li>
                      <li><a href="#">Item Wise Rate</a></li>
                      <li><a href="#">Item Opening Stock</a></li>
                      <li><a href="#">Vendor Item Mapping</a></li>
                      <li><a href="#">Drawing</a></li>
       
                   </ul>
                   </li>
                <li>
                    <a href="department.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Department </div>
                    </a>
                </li>
                <li>
                    <a href="machine.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Machine </div>
                    </a>
                </li>
                <li>
                    <a href="process.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Process</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> BOM</div>
                    </a>
                </li>
                <li>
                    <a href="shift.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Shift</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Transport</div>
                    </a>
                    <ul class="sub-submenu">
                      <li><a href="vehiclegroup.php"> Vehicle Group</a></li>
                      <li><a href="vehicle.php">Vehicle</a></li>
                     
       
                   </ul>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> A/C head</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Stock</div>
                    </a>
                </li>
                <!-- <li class="material-menu">
                       <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                         <div class="top-menu__title"> Report</div>
                   </a>
                      <ul class="sub-submenu">
                      <li><a href="partylistreport.php"> Party List</a></li>
                      <li><a href="itemgroupreport.php">Group Wise Item List</a></li>
                      <li><a href="#">Vendor Item List</a></li>
                      <li><a href="#">Production Bom</a></li>
                      <li><a href="#">Vendor Item List</a></li>
                      <li><a href="#">Job contractor Bom</a></li>
                      >
       
                   </ul>
                   </li> -->
            </ul>
            <!-- <ul class="" style="margin-left:250px;">
            <div class="parent-container">
    <div class="top-menu__title">Report</div>
</div>
                <li>
                    <a href="partylistreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
                
                <li>
                    
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Group wise Item List </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor Item List  </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Production BOM  </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor Item List  </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Job Contracter BOM  </div>
                    </a>
                </li> -->
                
            <!-- </ul>  -->
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"><i data-lucide="list"></i> </div>
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
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Vendor Item List </div>
                    </a>
                </li>
                <li>
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Production Bom </div>
                    </a>
                </li>
                <li>
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Job contractor BOM</div>
                    </a>
                </li>
               
            </ul>
        </li>
        
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"><i data-lucide="shopping-cart"></i> </div>
                <div class="top-menu__title"> Sales <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"><i data-lucide="shopping-bag"></i>  </div>
                <div class="top-menu__title"> Purchase<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"><i data-lucide="briefcase"></i></div>
                <div class="top-menu__title"> Material <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"><i data-lucide="circle"></i>  </div>
                <div class="top-menu__title"> Excise <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="box"></i> </div>
                <div class="top-menu__title"> Quality <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="wallet"></i> </div>
                <div class="top-menu__title"> FNA <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="index1.php" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="plus"></i> </div>
                <div class="top-menu__title"> Others  </i> </div>
            </a>
            
        </li>
        <!-- <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Quality <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> MIS <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
</ul>
</li>
<li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Administration<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
                
               
            </ul>
        
               
            
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Skyla<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
               
            </ul>
        </li> -->
        
    </ul>
</nav>