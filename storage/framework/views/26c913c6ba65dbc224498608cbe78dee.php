
<!-- Main Footer Blade Partial -->
               <!--main-footer-->
               <div class="height-emulator"></div>
               <footer class="main-footer">
                   <div class="container">
                       <div class="footer-inner">
                           <div class="row">
                               <!-- footer-widget -->
                               <div class="col-lg-4">
                                   <div class="footer-widget">
                                       <div class="footer-widget-title">Let us help you</div>
                                       <div class="footer-widget-content">
                                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
                                           <div class="api-links-wrap">
                                               <a href="#" class="footer-widget-content-link"><span> I'm Buying</span><i class="fas fa-credit-card"></i></a>
                                               <a href="#" class="footer-widget-content-link"><span> I'm Selling</span><i class="fas fa-dollar"></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <!-- footer-widget  end-->
                               <!-- footer-widget -->
                               <div class="col-lg-2">
                                   <div class="footer-widget">
                                       <div class="footer-widget-title">Helpful links</div>
                                       <div class="footer-widget-content">
                                           <div class="footer-list footer-box  ">
                                               <ul>
                                                   <li><a href="#">Latest News</a></li>
                                                   <li><a href="#">Want to buy</a></li>
                                                   <li><a href="#">Want to Sell</a></li>
                                                   <li><a href="#">Property Listings</a></li>
                                                   <li><a href="#">Wishlist</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <!-- footer-widget  end-->
                               <!-- footer-widget -->
                               <div class="col-lg-2">
                                   <div class="footer-widget">
                                       <div class="footer-widget-title">Our Contacts</div>
                                       <div class="footer-widget-content">
                                           <div class="footer-list footer-box  ">
                                               <ul  class="footer-contacts  ">
                                                   <li><span>Mail :</span><a href="#" target="_blank">info@peterlawton.com.au</a></li>
                                                   <li> <span>Adress :</span><a href="#" target="_blank">Some Street in Bowen</a></li>
                                                   <li><span>Phone :</span><a href="#">+61 (7) 123456789</a></li>
                                               </ul>
                                               <a href="contacts.html" class="footer-widget-content-link"><span>Get in Touch</span><i class="fa-solid fa-caret-right"></i></a>	
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <!-- footer-widget  end-->								
                               <!-- footer-widget -->
                               <div class="col-lg-4">
                                   <div class="footer-widget">
                                       <div class="footer-widget-title">Subscribe</div>
                                       <div class="footer-widget-content">
                                           <p>Keep up to date with everything going on at Peter Lawton Property. Join our mailing list and never miss a beat.</p>
                                           <form id="subscribe"   class="subscribe-item">
                                               <input class="enteremail" name="email" id="subscribe-email" placeholder="Your Email" spellcheck="false" type="text">
                                               <button type="submit" id="subscribe-button" class="subscribe-button"><span>Send</span> </button>
                                               <label for="subscribe-email" class="subscribe-message"></label>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                               <!-- footer-widget  end-->
                           </div>
                           <!-- footer-widget-wrap end-->					
                       </div>
                       <div class="footer-bottom">
                           <a href="index.html" class="footer-home_link"><i class="fa-regular  fa-house"></i></a>		
                           <div class="copyright"> <span>&#169; Peter Lawton Property 2025</span></div>
                           <div class="footer-social">
                               <span class="footer-social-title">Follow Us</span>
                               <div class="footer-social-wrap">
                                   <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 
                                   <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a> 
                                   <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>										 
                               </div>
                           </div>
                       </div>
                   </div>
               </footer>
               <!--main-footer end-->
           </div>
           <!--warpper end-->


           <?php echo $__env->make('websitecontent::websites.plp.partials.wishlist', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           <?php echo $__env->make('websitecontent::websites.plp.partials.register-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           <?php echo $__env->make('websitecontent::websites.plp.partials.progress-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           <?php echo $__env->make('websitecontent::websites.plp.partials.map-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    </div>

       <!-- Main end -->
<!-- JS Files -->
<!-- JS Files -->
<script src="<?php echo e(url('/business-sites/plp/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('/business-sites/plp/js/plugins.js')); ?>"></script>
<script src="<?php echo e(url('/business-sites/plp/js/scripts.js')); ?>"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAPS_API_KEY')); ?>&libraries=places&callback=initMap" async defer></script>

<script src="<?php echo e(url('/business-sites/plp/js/map-single.js')); ?>"></script>
</body>
</html><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/websites/plp/layouts/footer.blade.php ENDPATH**/ ?>