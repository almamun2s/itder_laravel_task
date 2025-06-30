<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-3">Get us in</h4>
                <div class="d-flex justify-content-start pt-3">
                    <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                            class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Pages</h4>
                    <a href="#" class="btn-link"><small class="text-white mx-2">Privacy Policy</small></a>
                    <a href="#" class="btn-link"><small class="text-white mx-2">Terms of Use</small></a>
                    <a href="#" class="btn-link"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Account</h4>
                    <a class="btn-link" href="{{ route('profile.edit') }}">My Account</a>
                    <a class="btn-link" href="#">Shop</a>
                    <a class="btn-link" href="#">Cart</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">We are in</h4>
                    <p>Address: </p>
                    <p>Email: </p>
                    <p>Phone: </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="{{ route('home') }}"><i
                            class="fas fa-copyright text-light me-2"></i>{{ env('APP_NAME') }}</a> All right
                    reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                Developed By <a class="border-bottom" href="https://almamun.life" target="_blank">Abdullah Almamun</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
