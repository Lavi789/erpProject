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
            <ul class="">
                <li>
                    <a href="bank.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="top-menu__title"> CURRENCY </div>
                    </a>
                </li>
                <li>
                    <a href="branch.php
                    " class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="layers"></i> </div>
                        <div class="top-menu__title">Brnch Detail</div>
                    </a>
                </li>
                <li>
                    <a href="item.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="scissors"></i> </div>
                        <div class="top-menu__title"> Product </div>
                    </a>
                </li>
                <li>
                    <a href="mfg_company.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="bar-chart-2"></i> </div>
                        <div class="top-menu__title"> Manufacturing Company </div>
                    </a>
                </li>
                <li>
                    <a href="customer.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title">Customer</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="top-menu__title"> Supplier </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "sales"); ?>">
                <div class="top-menu__icon"> <i data-lucide="shopping-cart"></i> </div>
                <div class="top-menu__title"> Sales <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="retail_sales.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                        <div class="top-menu__title"> Retail Sales </div>
                    </a>
                </li>
                <li>
                    <a href="sales_return.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="corner-down-left"></i> </div>
                        <div class="top-menu__title"> Sales Return </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="top-menu <?php getActive($amenu, "purchase"); ?>">
                <div class="top-menu__icon"> <i data-lucide="activity"></i> </div>
                <div class="top-menu__title"> Purchase <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="purchase_inv.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="credit-card"></i> </div>
                        <div class="top-menu__title"> Purchase Invoice </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_return.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="corner-down-left"></i> </div>
                        <div class="top-menu__title"> Purchase Return </div>
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
                        <div class="top-menu__title"> Stock Report </div>
                    </a>
                </li>
                <li>
                    <a href="sales_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Date Wise Sales Report </div>
                    </a>
                </li>
                <li>
                    <a href="purchase_report.php" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="top-menu__title"> Date Wise Purchase Report </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>