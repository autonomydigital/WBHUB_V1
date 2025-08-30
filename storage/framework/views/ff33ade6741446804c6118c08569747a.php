<?php $__env->startSection('content'); ?>


            <!--warpper-->
            <div class="wrapper">
                <!--content-->
                <div class="content">
                    <!--section-->
                    <div class="section hero-section hero-section_sin">
                        <div class="hero-section-wrap">
                            <div class="hero-section-wrap-item">
                                <div class="container">
                                    <div class="hero-section-container">
                                        <div class="hero-section-title">
                                            <h2>Our Contacts</h2>
                                            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-scroll-down-wrap">
                                    <div class="scroll-down-item">
                                        <div class="mousey">
                                            <div class="scroller"></div>
                                        </div>
                                        <span>Scroll Down To Discover</span>
                                    </div>
                                    <div class="svg-corner svg-corner_white"  style="bottom:0;right: -39px; transform: rotate( 90deg)" ></div>
                                    <div class="svg-corner svg-corner_white"  style="bottom:0;left:  -39px;"></div>
                                </div>
                                <div class="bg-wrap bg-hero bg-parallax-wrap-gradien fs-wrapper" data-scrollax-parent="true">
                                    <div class="bg" data-bg="/business-sites/plp/images/bg/1.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--section-end-->				
                    <!--container-->
                    <div class="container">
                        <!--breadcrumbs-list-->
                       
                       <?php echo $__env->make('websitecontent::websites.plp.partials.breadcrumbs', [
                            'breadcrumbs' => [
                                ['label' => 'Contact']  // Only final item needs label
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                        <!--main-content-->
                        <div class="main-content ms_vir_height">
                            <!--boxed-container-->
                            <div class="boxed-container">
                                <!-- contacts-cards-wrap  -->	
                                <div class="contacts-cards-wrap">
                                    <div class="row">
                                        <!-- contacts-card-item -->	
                                        <div class="col-lg-4">
                                            <div class="contacts-card-item">
                                                <i class="fa-regular fa-location-dot"></i>
                                                <span>Our Location</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.</p>
                                                <a href="#">USA 27TH Brooklyn NY</a>
                                            </div>
                                        </div>
                                        <!-- contacts-card-item end-->	
                                        <!-- contacts-card-item -->	
                                        <div class="col-lg-4">
                                            <div class="contacts-card-item">
                                                <i class="fa-regular fa-phone-rotary"></i>
                                                <span>Our   Phone</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.</p>
                                                <a href="#"> +489756412322</a>
                                                <a href="#"> +123456789222</a>
                                            </div>
                                        </div>
                                        <!-- contacts-card-item end-->
                                        <!-- contacts-card-item -->	
                                        <div class="col-lg-4">
                                            <div class="contacts-card-item">
                                                <i class="fa-regular fa-mailbox"></i>
                                                <span>Our Mail</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.</p>
                                                <a href="#">yourmail@domain.com</a>
                                            </div>
                                        </div>
                                        <!-- contacts-card-item end-->
                                    </div>
                                </div>
                                <!-- contacts-cards-wrap end   -->						
                                <div class="row">
                                    <!-- contacts-opt-wrap -->	
                                    <div class="col-lg-7">
                                        <div class="contacts-opt-wrap">
                                            <div class="contact-wh_title">Working Hours</div>
                                            <div class="contact-wh">
                                                <div class="contact-wh-item">Monday - Friday:<strong> 8am - 6pm</strong></div>
                                                <div class="contact-wh-item">Saturday - Sunday:<strong> 9am - 3pm</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- contacts-opt-wrap end-->	
                                    <!-- contacts-opt-wrap -->	
                                    <div class="col-lg-5">
                                        <div class="contacts-opt-wrap">
                                            <div class="contact-social">
                                                <span class="cs-title">Find us on: </span>
                                                <div class="contact-social-container">
                                                    <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 
                                                    <a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a> 
                                                    <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a> 
                                                    <a href="#" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                                                    <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>										 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- contacts-card-item end-->
                                </div>
                                <div class="contacts-form-wrap">
                                    <div class="row">
                                        <!-- contacts-opt-wrap -->	
                                        <div class="col-lg-6">
                                            <div class="boxed-content">
                                                <div class="boxed-content-title">
                                                    <h3>Get In Touch</h3>
                                                </div>
                                                <div class="boxed-content-item">
                                                    <div class="comment-form custom-form contactform-wrap">
                                                        <form  class="comment-form"    action="php/contact.php" name="contactform" id="contactform">
                                                            <fieldset>
                                                                <div id="message"></div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-user"></i>
                                                                            <input   name="name" type="text" id="name"   placeholder="Your name" onClick="this.select()" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="cs-intputwrap">
                                                                            <i class="fa-light fa-envelope"></i>
                                                                            <input type="text"  name="email" id="email" placeholder="Email Address *" onClick="this.select()"  value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <textarea name="comments"  id="comments" cols="40" rows="3" placeholder="Your Message:"></textarea>
                                                                <button class="commentssubmit" id="submit_cnt"   style="margin-top: 20px">Send Message</button>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- contacts-opt-wrap end-->	
                                        <!-- contacts-opt-wrap -->	
                                        <div class="col-lg-6">
                                            <div class="map-container mapC_vis3">
                                                <div id="singleMap" class="single-map-container fs-wrapper" data-latitude="40.7427837" data-longitude="-73.11445617675781" data-mapTitle="Our Location" data-infotitle="House in Financial Distric" data-infotext="70 Bright St New York, USA"></div>
                                                <div class="scrollContorl"></div>
                                            </div>
                                        </div>
                                        <!-- contacts-card-item end-->
                                    </div>
                                </div>
                            </div>
                            <!--boxed-container end-->
                        </div>
                        <!--main-content end-->
                        <div class="to_top-btn-wrap">
                            <div class="to-top to-top_btn"><span>Back to top</span> <i class="fa-solid fa-arrow-up"></i></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;left:  -40px; transform: rotate(-90deg)"></div>
                            <div class="svg-corner svg-corner_white"  style="top:0;right: -40px; transform: rotate(-180deg)"></div>
                        </div>
                    </div>
                    <!-- container end-->
                </div>
               
<?php $__env->stopSection(); ?>
<?php echo $__env->make('websitecontent::websites.plp.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/pages/contact.blade.php ENDPATH**/ ?>