<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="40f">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="las la-tachometer-alt"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                          
                            <li class="nav-item">
                                <a href="dashboard" class="nav-link"><?php echo app('translator')->get('translation.analytics'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link"><?php echo app('translator')->get('translation.crm'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link"><?php echo app('translator')->get('translation.ecommerce'); ?></a>
                            </li>
                          
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link"><?php echo app('translator')->get('translation.projects'); ?></a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="dashboard-job" class="nav-link"><?php echo app('translator')->get('translation.job'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="lab la-delicious"></i> <span>Modules</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link"><?php echo app('translator')->get('translation.calendar'); ?> </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat" class="nav-link"><?php echo app('translator')->get('translation.chat'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-mailbox" class="nav-link"><?php echo app('translator')->get('translation.email'); ?></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="apps-projects-list" class="nav-link"><?php echo app('translator')->get('translation.projects'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTasks"><?php echo app('translator')->get('translation.tasks'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTasks">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tasks-kanban" class="nav-link"><?php echo app('translator')->get('translation.kanbanboard'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-list-view" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-todo" class="nav-link"> <span><?php echo app('translator')->get('translation.to-do'); ?></span></a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCRM"><?php echo app('translator')->get('translation.crm'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCRM">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crm-contacts" class="nav-link"><?php echo app('translator')->get('translation.contacts'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-companies" class="nav-link"><?php echo app('translator')->get('translation.companies'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-deals" class="nav-link"><?php echo app('translator')->get('translation.deals'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-leads" class="nav-link"><?php echo app('translator')->get('translation.leads'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce"><?php echo app('translator')->get('translation.ecommerce'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-products" class="nav-link"><?php echo app('translator')->get('translation.products'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-product-details" class="nav-link"><?php echo app('translator')->get('translation.product-Details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-add-product" class="nav-link"><?php echo app('translator')->get('translation.create-product'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-orders" class="nav-link"><?php echo app('translator')->get('translation.orders'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-order-details" class="nav-link"><?php echo app('translator')->get('translation.order-details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-customers" class="nav-link"><?php echo app('translator')->get('translation.customers'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-cart" class="nav-link"><?php echo app('translator')->get('translation.shopping-cart'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-checkout" class="nav-link"><?php echo app('translator')->get('translation.checkout'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-sellers" class="nav-link"><?php echo app('translator')->get('translation.sellers'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-seller-details" class="nav-link"><?php echo app('translator')->get('translation.sellers-details'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                           
                            <li class="nav-item">
                                <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices"><?php echo app('translator')->get('translation.invoices'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInvoices">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-invoices-list" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-details" class="nav-link"><?php echo app('translator')->get('translation.details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-create" class="nav-link"><?php echo app('translator')->get('translation.create-invoice'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTickets"><?php echo app('translator')->get('translation.supprt-tickets'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTickets">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tickets-list" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tickets-details" class="nav-link"><?php echo app('translator')->get('translation.ticket-details'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrypto"><?php echo app('translator')->get('translation.crypto'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCrypto">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crypto-transactions" class="nav-link"><?php echo app('translator')->get('translation.transactions'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-buy-sell" class="nav-link"><?php echo app('translator')->get('translation.buy-sell'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-orders" class="nav-link"><?php echo app('translator')->get('translation.orders'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-wallet" class="nav-link"><?php echo app('translator')->get('translation.my-wallet'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-ico" class="nav-link"><?php echo app('translator')->get('translation.ico-list'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-kyc" class="nav-link"><?php echo app('translator')->get('translation.kyc-application'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft">
                                    Marketplace
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarnft">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-nft-marketplace" class="nav-link"> <?php echo app('translator')->get('translation.marketplace'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-explore" class="nav-link"> <?php echo app('translator')->get('translation.explore-now'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-auction" class="nav-link"> <?php echo app('translator')->get('translation.live-auction'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-item-details" class="nav-link"> <?php echo app('translator')->get('translation.item-details'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-collections" class="nav-link"> <?php echo app('translator')->get('translation.collections'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-creators" class="nav-link"> <?php echo app('translator')->get('translation.creators'); ?> </a>
                                        </li>
                                    
                                        <li class="nav-item">
                                            <a href="apps-nft-wallet" class="nav-link"> <?php echo app('translator')->get('translation.wallet-connect'); ?> </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="apps-file-manager" class="nav-link"> <span><?php echo app('translator')->get('translation.file-manager'); ?></span></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#sidebarjobs" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarjobs"> <?php echo app('translator')->get('translation.jobs'); ?></a>
                                <div class="collapse menu-dropdown" id="sidebarjobs">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-job-statistics" class="nav-link"> <?php echo app('translator')->get('translation.statistics'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarJoblists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarJoblists">
                                                <?php echo app('translator')->get('translation.job-lists'); ?>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarJoblists">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-job-lists" class="nav-link"> <?php echo app('translator')->get('translation.list'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-grid-lists" class="nav-link"> <?php echo app('translator')->get('translation.grid'); ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-details" class="nav-link"> <?php echo app('translator')->get('translation.overview'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCandidatelists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCandidatelists">
                                                <?php echo app('translator')->get('translation.candidate-lists'); ?>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCandidatelists">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-job-candidate-lists" class="nav-link"> <?php echo app('translator')->get('translation.list-view'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-candidate-grid" class="nav-link"> <?php echo app('translator')->get('translation.grid-view'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-application" class="nav-link"> <?php echo app('translator')->get('translation.application'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-new" class="nav-link"> <?php echo app('translator')->get('translation.new-job'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-companies-lists" class="nav-link"> <?php echo app('translator')->get('translation.companies-list'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-categories" class="nav-link"> <?php echo app('translator')->get('translation.job-categories'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="apps-api-key" class="nav-link"><?php echo app('translator')->get('translation.api-key'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>

               

                <li class="menu-title"><i class="ri-more-fill"></i> <span><?php echo app('translator')->get('translation.pages'); ?></span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="lar la-user-circle"></i> <span><?php echo app('translator')->get('translation.authentication'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignIn"><?php echo app('translator')->get('translation.signin'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignIn">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signin-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signin-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSignUp" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp"><?php echo app('translator')->get('translation.signup'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignUp">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signup-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signup-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarResetPass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass"><?php echo app('translator')->get('translation.password-reset'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarResetPass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarchangePass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarchangePass"><?php echo app('translator')->get('translation.password-create'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarchangePass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-change-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-change-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLockScreen" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLockScreen"><?php echo app('translator')->get('translation.lock-screen'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLockScreen">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLogout" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLogout"><?php echo app('translator')->get('translation.logout'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLogout">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-logout-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-logout-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSuccessMsg" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSuccessMsg"><?php echo app('translator')->get('translation.success-message'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSuccessMsg">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-success-msg-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-success-msg-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTwoStep" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTwoStep"><?php echo app('translator')->get('translation.two-step-verification'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTwoStep">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-twostep-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-twostep-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarErrors"><?php echo app('translator')->get('translation.errors'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarErrors">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-404-basic" class="nav-link"><?php echo app('translator')->get('translation.404-basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-cover" class="nav-link"><?php echo app('translator')->get('translation.404-cover'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-alt" class="nav-link"><?php echo app('translator')->get('translation.404-alt'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-500" class="nav-link"><?php echo app('translator')->get('translation.500'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-offline" class="nav-link"><?php echo app('translator')->get('translation.offline-page'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

              
                            
                           
                            <li class="nav-item">
                                <a href="pages-profile" class="nav-link"><i class="lar la-user-edit"></i><span><?php echo app('translator')->get('translation.profile'); ?></a></span>
                            </li>
                            <li class="nav-item">
                                <a href="pages-team" class="nav-link"><i class="lar la-users"></i><span>People</span></a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="pages-faqs" class="nav-link"><i class="lar la-question-circle"></i><span><?php echo app('translator')->get('translation.faqs'); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-pricing" class="nav-link"><i class="lar la-wallet"></i><span><?php echo app('translator')->get('translation.pricing'); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-gallery" class="nav-link"><i class="lar la-camera-retro"></i><span><?php echo app('translator')->get('translation.gallery'); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-search-results" class="nav-link"><i class="lar la-search"></i><span><?php echo app('translator')->get('translation.search-results'); ?></span></a>
                            </li>
                              <li class="nav-item">
                                <a href="pages-privacy-policy" class="nav-link"><i class="lar la-file-alt"></i><span><?php echo app('translator')->get('translation.privacy-policy'); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-term-conditions" class="nav-link"><i class="lar la-handshake"></i><span><?php echo app('translator')->get('translation.term-conditions'); ?></span></a>
                            </li>
                       

                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'superadmin')): ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('permissions.index')); ?>">
                                    <i class="ri-shield-keyhole-line"></i>
                                    <span>Permissions</span>
                                </a>
                            </li>
                            <?php endif; ?>
               
                

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>