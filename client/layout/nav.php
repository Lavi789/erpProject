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
    max-height: 200px; /* Set the maximum height of the dropdown */
    overflow-y: auto; /* Add vertical scrollbar when content overflows */
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
                <div class="top-menu__icon"> <i data-lucide="list"></i> </div>
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
                    <li><a href="#">County</a></li>
                      <li><a href="#">State</a></li>
                      <li><a href="#">Dist</a></li>
                      <li><a href="#">City</a></li>
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
                      <li><a href="#"> Party Group</a></li>
                      <li><a href="#">Party</a></li>
                      <li><a href="#">Vendor Registration</a></li>
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
                      <li><a href="#"> Item Group</a></li>
                      <li><a href="#">Item</a></li>
                      <li><a href="#">Make</a></li>
                      <li><a href="#">Item Wise Rate</a></li>
                      <li><a href="#">Item Opening Stock</a></li>
                      <li><a href="#">Vendor Item Mapping</a></li>
                      <li><a href="#">Drawing</a></li>
       
                   </ul>
                   </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Department </div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Machine </div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
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
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Shift</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Transport</div>
                    </a>
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
            </ul>
        </li>
        
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="bar-chart"></i> </div>
                <div class="top-menu__title"> Report <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="stockreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Party List  </div>
                    </a>
                </li>
                <li>
                    <a href="sales_report.php" class="top-menu">
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
                </li>
            </ul>
        </li>
    </ul>
</nav>