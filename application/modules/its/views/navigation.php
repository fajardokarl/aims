<!-- BEGIN HEADER MENU -->
<div class="page-header-menu">
    <div class="container-fluid">

        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
        <div class="hor-menu  ">
            <ul class="nav navbar-nav">
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="<?=base_url()?>its"> Dashboard
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Requests
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/email_request" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Email Request
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/internet_request" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Internet Connectivity
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/check_up" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Computer Check-up
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/db_report" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Custom DB Reports
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/system_access" class="nav-link  ">
                                <i class="icon-bar-chart"></i> System Access
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/borrow" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Property Takeout
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Persons
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>login/users" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Users
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>its/employees" class="nav-link  ">
                                <i class="icon-bulb"></i> Employees </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Reports
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/reservationreport" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Reservation Report
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/salesreport" class="nav-link  ">
                                <i class="icon-bulb"></i> Sales Report </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Settings
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/paymentschemes" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Payment Schemes
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/commissionschemes" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Commision Schemes
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/incentiveschemes" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Incentive Schemes
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>marketing/banks" class="nav-link  ">
                                <i class="icon-bulb"></i> Bank Masterlist </a>
                        </li>
                        <!--                                                <li aria-haspopup="true" class=" ">-->
                        <!--                                                    <a href="--><?//=base_url()?><!--marketing/users" class="nav-link  ">-->
                        <!--                                                        <i class="icon-bulb"></i> User Management </a>-->
                        <!--                                                </li>-->
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                    <a href="javascript:;"> Legacy Reports
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewUnbalancedEntries" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Unbalanced Entries
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewCIP" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - CIP
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewDepartmentExpenses" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Department Expenses
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewBankRecon" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Bank Recon
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewRR152010" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - RR-15-2010
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewCheckVoucher" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Check Voucher
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInventory17081" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Inventory 17081
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewLapsing" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Lapsing
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewEWT" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - EWT
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewAccumulatedDepreciation" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Accumulated Depreciation
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewOutputTax" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Output Tax
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInputTax" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Input Tax
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewCostFactor" class="nav-link">
                                <i class="icon-bar-chart"></i> Accounting - Cost Factor
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewMRISIssuance" class="nav-link">
                                <i class="icon-bar-chart"></i> Admin - MRIS Issuance
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInventoryPerProject" class="nav-link">
                                <i class="icon-bar-chart"></i> Admin - Inventory Per Project
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInventorySummaryPerWarehouse" class="nav-link">
                                <i class="icon-bar-chart"></i> Admin - Inventory Summary Per Warehouse
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInventorySummaryPerProject" class="nav-link">
                                <i class="icon-bar-chart"></i> Admin - Inventory Summary Per Project
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewInventoryMovement" class="nav-link">
                                <i class="icon-bar-chart"></i> Admin - Inventory Movement
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                    <a href="javascript:;"> Legacy 2
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewAgingReceivables" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - Aging of Receivables
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewCollectionEntry" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - Collection Entry
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewDCRNoSundry" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - DCR - No Sundry 
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewDCRWithSundry" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - DCR - With Sundry 
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewDMCMEntry" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - DMCM Entry
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewBreakdownCollectedSales" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - Breakdown of Collected Sales
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewCustomerPaymentLedger" class="nav-link">
                                <i class="icon-bar-chart"></i> CNC - Customer Payment Ledger
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewPORange" class="nav-link">
                                <i class="icon-bar-chart"></i> Logistics - PO Range
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewPoserved" class="nav-link">
                                <i class="icon-bar-chart"></i> Logistics - PO Served
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewUomitem" class="nav-link">
                                <i class="icon-bar-chart"></i> Logistics - Unit of Measure Per Item
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewReservationListing" class="nav-link">
                                <i class="icon-bar-chart"></i> Marketing - Reservation Listing
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Legacy/viewProsdb" class="nav-link">
                                <i class="icon-bar-chart"></i> Marketing - PROS DB
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                    <a href="javascript:;"> Peachtree
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewCustomers" class="nav-link">
                                <i class="icon-bar-chart"></i> Customers
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewGeneralJournals" class="nav-link">
                                <i class="icon-bar-chart"></i> General Journals
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewAPRetitlingLot" class="nav-link">
                                <i class="icon-bar-chart"></i> AP Retitling Lot
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewCashDisbursementJournal" class="nav-link">
                                <i class="icon-bar-chart"></i> Cash Disbursement Journal
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewCashReceiptsJournal" class="nav-link">
                                <i class="icon-bar-chart"></i> Cash Receipts Journal
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewCheckRegister" class="nav-link">
                                <i class="icon-bar-chart"></i> Check Register
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewCIBUBP" class="nav-link">
                                <i class="icon-bar-chart"></i> CIB-UBP
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewEWT" class="nav-link">
                                <i class="icon-bar-chart"></i> EWT
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewFixedAssets" class="nav-link">
                                <i class="icon-bar-chart"></i> Fixed Assets
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewGeneralLedger" class="nav-link">
                                <i class="icon-bar-chart"></i> General Ledger
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewGLManilaOffice" class="nav-link">
                                <i class="icon-bar-chart"></i> GL Manila Office
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                    <a href="javascript:;"> Peachtree 2
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewInvoiceRegister" class="nav-link">
                                <i class="icon-bar-chart"></i> Invoice Register
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewPurchaseJournal" class="nav-link">
                                <i class="icon-bar-chart"></i> Purchase Journal
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewReceiptList" class="nav-link">
                                <i class="icon-bar-chart"></i> Receipt List
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewSalesInvoice" class="nav-link">
                                <i class="icon-bar-chart"></i> Sales Invoice
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewSalesJournal" class="nav-link">
                                <i class="icon-bar-chart"></i> Sales Journal
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewTransactionReport" class="nav-link">
                                <i class="icon-bar-chart"></i> Transaction Report
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewVendorLedger" class="nav-link">
                                <i class="icon-bar-chart"></i> Vendor Ledger
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="">
                            <a href="<?=base_url()?>its/Peachtree/viewVendors" class="nav-link">
                                <i class="icon-bar-chart"></i> Vendors
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END MEGA MENU -->
    </div>
</div>
<!-- END HEADER MENU -->