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
                        <div class="top-menu__title"> Order</div>
                    </a>
                </li>
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title">Collection Of RC  </div>
                    </a>
                </li>
                <li>
                    <a href="unit.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> IRN SUPPLIMENTRY BILL </div>
                    </a>
                </li>
                <li>
                    <a href="department.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> IRN CREDIT NOTE
                         </div>
                    </a>
                </li>
                <li>
                    <a href="machine.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Delivery challan </div>
                    </a>
                </li>
                <li>
                    <a href="process.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Stock Transfer</div>
                    </a>
                </li>
                <li>
                    <a href=".php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title">Rejection</div>
                    </a>
                </li>
                <li>
                    <a href="shift.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Gate pass</div>
                    </a>
                </li>
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> GIN</div>
                    </a>
                </li>
               
            </ul>
</li>
<li>
           
            

            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon"> <i data-lucide="calendar"></i> </div>
                <div class="top-menu__title"> Schedule<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
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
            <!-- <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="menu"></i> </div>
                <div class="top-menu__title"> Schedule<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
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
                </li> -->
<!-- </ul> -->
        
               
            
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="book"></i> </div>
                <div class="top-menu__title"> Supplimentry Bill<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
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
                <div class="top-menu__icon">  <i data-lucide="library"></i> </div>
                <div class="top-menu__title"> Invoice<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="itemgroup.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Data Updation  </div>
                    </a>
                </li>
                <li>
                    <a href="itemmake.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> SRM (General) File generation </div>
                    </a>
                </li>
                <li>
                    <a href="itemwiserate.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> SRM(Mashop)File Genration</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> API Password Updation</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> General Challan Printing</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Mashop Challan Printing</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Daily Schedule Amendment</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Road Permit</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Way Bill</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Way Bill (jobwork)</div>
                    </a>
                </li>
                <li>
                    <a href="itemopstock.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E- Way Bill (General)</div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="flag"></i> </div>
                <div class="top-menu__title"> Report<i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="partylistreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Order </div>
                    </a>
                </li>
                <li>
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Schedule </div>
                    </a>
                </li>
                <li>
                    <a href="vendoritemlist.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Collection RC</div>
                    </a>
                </li>
                <li>
                    <a href="productionbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Invoice</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Rejection</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> VAT Debit Note</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Lorry Receipt</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Sales Gate Pass</div>
                    </a>
                </li>
                
               
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "report"); ?>">
                <div class="top-menu__icon">  <i data-lucide="plus"></i> </div>
                <div class="top-menu__title"> Utility <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="partylistreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Data Updation</div>
                    </a>
                </li>
                <li>
                    <a href="itemgroupreport.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> SRM (General) File Generation </div>
                    </a>
                </li>
                <li>
                    <a href="vendoritemlist.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> SRM (Mashop) File Generation </div>
                    </a>
                </li>
                <li>
                    <a href="productionbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> API Password Updation </div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> General Challan Printing </div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Mashop Challan Printing </div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Daily Schedule Amendment</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Road Permit</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-way Bill</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-way Bill(jobwork)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(General)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(Mashop)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(Jobwork)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(Supplimentr Bill)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(Supplementay Bill Mashop)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(upplementary Bill Jobwork)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> E-Invoice(Credit Note Jobwork)</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title">Insert No</div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Supplimentary Bill Printing </div>
                    </a>
                </li>
                <li>
                    <a href="contractorbom.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Credit Note Printing</div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        
        
        
    </ul>
</nav>