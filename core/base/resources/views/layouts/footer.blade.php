
<footer class="m-grid__item		m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                <span class="m-footer__copyright">
                    2017 &copy;
                    <a href="#" class="m-link">
                        Hydrogen
                    </a>
                </span>
            </div>
        </div>
    </div>
</footer>

<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>


<script src="{{ asset('backend/js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/ck/ckeditor.js') }}"></script>
<script src="{{ asset('backend/js/ck/ck_adapters/jquery.js') }}"></script>
<script src="{{ asset('backend/js/ck/config.js') }}"></script>
@yield('custom_js')
<script src="{{ asset('backend/js/hydrogen.js') }}" type="text/javascript"></script>

</div>
</body>
</html>