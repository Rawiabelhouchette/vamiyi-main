@php
    $typeAnnonce = App\Models\Annonce::pluck('type')->unique()->toArray();
@endphp

<footer class="footer dark-footer dark-bg">
    {{-- <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">About Us</h3>
                    <p>We are Themez Hub A team of clean, creative & professionals delivering world-class HTML Templates to build a better & smart web.</p>
                    <a href="#" class="other-store-link">
                        <div class="other-store-app">
                            <div class="os-app-icon">
                                <i class="ti-android"></i>
                            </div>
                            <div class="os-app-caps">
                                Google Store
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Popular Services</h3>
                    <ul class="footer-navigation sinlge">
                        <li><a href="#">Home Version One</a></li>
                        <li><a href="#">Home Version Two</a></li>
                        <li><a href="#">Home Version Three</a></li>
                        <li><a href="#">Listing Detail Page</a></li>
                        <li><a href="#">Search Listing Page</a></li>
                        <li><a href="#">Our Top Authors</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <div class="textwidget">
                        <h3 class="widgettitle widget-title">Get In Touch</h3>
                        <div class="address-box">
                            <div class="sing-add">
                                <i class="ti-location-pin"></i>7744 North, New York
                            </div>
                            <div class="sing-add">
                                <i class="ti-email"></i>support@listinghub.com
                            </div>
                            <div class="sing-add">
                                <i class="ti-mobile"></i>+91 021 548 75958
                            </div>
                            <div class="sing-add">
                                <i class="ti-world"></i>www.themezhub.com
                            </div>
                        </div>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Subscribe Newsletter</h3>
                    <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis</p>

                    <form class="sup-form">
                        <input type="email" class="form-control sigmup-me" placeholder="Your Email Address" required="required">
                        <button type="submit" class="btn" value="Get Started"><i class="fa fa-location-arrow"></i></button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <p>Copyright@ 2019 Listing Hub Design By <a href="http://www.themezhub.com/" title="Themezhub" target="_blank">Themezhub</a></p>
    </div> --}}
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">IID</h3>
                    <p>L'Institut de l'Information et de la Documentation (IID) est une école qui forme les étudiants aux nouvelles techniques de gestion de l'information et de la documentation.</p>
                    {{-- <a href="#" class="other-store-link">
                        <div class="other-store-app">
                            <div class="os-app-icon">
                                <i class="ti-android"></i>
                            </div>
                            <div class="os-app-caps">
                                Google Store
                            </div>
                        </div>
                    </a> --}}
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Types d'annonce</h3>
                    <ul class="footer-navigation sinlge">
                        @foreach ($typeAnnonce as $type)
                            <li><a href="javascript:void(0)">{{ $type }}</a></li>
                            @if ($loop->iteration == 4)
                                {{-- <li><a href="javascript:void(0)">...</a></li> --}}
                            @break
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="footer-widget">
                <div class="textwidget">
                    <h3 class="widgettitle widget-title">Nous retrouver</h3>
                    <div class="address-box">
                        <div class="sing-add">
                            <a href="https://goo.gl/maps/MBJGNz6obPGrMjjH6" style="color: #7f90a7;" target="_blank">
                                <i class="ti-location-pin"></i>Lomé-Adidogomé
                            </a>
                        </div>
                        <div class="sing-add">
                            <a href="mailto:contact@numrod.fr" style="color: #7f90a7;">
                                <i class="ti-email"></i>contact@numrod.fr
                            </a>
                        </div>
                        <div class="sing-add">
                            <a href="tel:+22890454591" style="color: #7f90a7;">
                                <i class="ti-mobile"></i>+228 90 45 45 91
                            </a>
                        </div>
                        <div class="sing-add">
                            <a href="http://numdoc.numrod.fr/" style="color: #7f90a7;" target="_blank">
                                <i class="ti-world"></i>www.numrod.com
                            </a>
                        </div>
                    </div>
                    <!--<ul class="footer-social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>-->
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="footer-widget">
                <h3 class="widgettitle widget-title">Nous contacter</h3>
                <p>Les professionnels restent disponible pour toute demande</p>

                {{-- <form class="sup-form" >
                        <input type="email" class="form-control sigmup-me" placeholder="Your Email Address" required="required">
                        <button type="submit" class="btn" value="Get Started"><svg class="svg-inline--fa fa-location-arrow fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="location-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M443.683 4.529L27.818 196.418C-18.702 217.889-3.39 288 47.933 288H224v175.993c0 51.727 70.161 66.526 91.582 20.115L507.38 68.225c18.905-40.961-23.752-82.133-63.697-63.696z"></path></svg><!-- <i class="fa fa-location-arrow"></i> --></button>
                    </form> --}}
            </div>
        </div>
    </div>

</div>
<div class="footer-copyright">
    <p>Copyright &copy; {{ date('Y') }} propulsé par Numrod <a href="http://www.numrod.com/" title="Numrod" target="_blank">Numrod</a></p>
</div>
</footer>
