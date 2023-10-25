@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
    <section class="resume-section">
        <div class="resume-section-content row">
            <h3>
                Lapak Jualan
            </h3>
            <br>
                <br>
                    <br>
                        <div class="container mt-5">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="shop-card">
                                        <div class="shop-image-container">
                                            <div class="shop-first">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!--<span class="shop-discount">-25%</span>-->
                                                </div>
                                            </div>
                                            
                                            <a href="{{ route("product_detail", ['link_product' => 'yohohow']) }}" title="View Detail">
                                                <img class="img-fluid rounded thumbnail-image" src="{{url('/')}}/assets/shop/8JIWpnw.jpg"></img>
                                            </a>
                                        </div>
                                        <div class="product-detail-container p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="shop-item-title">
                                                    <a href="{{ route("product_detail", ['link_product' => 'yohohow']) }}" title="View Detail">Judul Produk Yang Agak Panjang-panjang aja Lihat Gimana</a>
                                                </h5>
                                            </div>

                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua.</p>

                                            <div style="float:right">
                                                <h6 class="shop-item-price">Rp 3.333.333</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            {{--
                            <br>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="shop-card">
                                        <div class="shop-image-container">
                                            <div class="shop-first">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!--<span class="shop-discount">-25%</span>-->
                                                </div>
                                            </div>
                                            <img class="img-fluid rounded thumbnail-image" src="{{url('/')}}/assets/shop/8JIWpnw.jpg">
                                            </img>
                                        </div>
                                        <div class="product-detail-container p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="dress-name">
                                                    White traditional long dress
                                                </h5>
                                                <div class="d-flex flex-column mb-2">
                                                    <span class="new-price">
                                                        $3.99
                                                    </span>
                                                    <small class="old-price text-right">
                                                        $5.99
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="shop-card">
                                        <div class="shop-image-container">
                                            <div class="shop-first">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!--<span class="shop-discount">-25%</span>-->
                                                </div>
                                            </div>
                                            <img class="img-fluid rounded thumbnail-image" src="{{url('/')}}/assets/shop/8JIWpnw.jpg">
                                            </img>
                                        </div>
                                        <div class="product-detail-container p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="dress-name">
                                                    White traditional long dress
                                                </h5>
                                                <div class="d-flex flex-column mb-2">
                                                    <span class="new-price">
                                                        $3.99
                                                    </span>
                                                    <small class="old-price text-right">
                                                        $5.99
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="shop-card">
                                        <div class="shop-image-container">
                                            <div class="shop-first">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!--<span class="shop-discount">-25%</span>-->
                                                </div>
                                            </div>
                                            <img class="img-fluid rounded thumbnail-image" src="{{url('/')}}/assets/shop/8JIWpnw.jpg">
                                            </img>
                                        </div>
                                        <div class="product-detail-container p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="dress-name">
                                                    White traditional long dress
                                                </h5>
                                                <div class="d-flex flex-column mb-2">
                                                    <span class="new-price">
                                                        $3.99
                                                    </span>
                                                    <small class="old-price text-right">
                                                        $5.99
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="shop-card">
                                        <div class="shop-image-container">
                                            <div class="shop-first">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!--<span class="shop-discount">-25%</span>-->
                                                </div>
                                            </div>
                                            <img class="img-fluid rounded thumbnail-image" src="{{url('/')}}/assets/shop/8JIWpnw.jpg">
                                            </img>
                                        </div>
                                        <div class="product-detail-container p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="dress-name">
                                                    White traditional long dress
                                                </h5>
                                                <div class="d-flex flex-column mb-2">
                                                    <span class="new-price">
                                                        $3.99
                                                    </span>
                                                    <small class="old-price text-right">
                                                        $5.99
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            --}}

                        </div>
                    </br>
                </br>
            </br>
        </div>
    </section>
</div>
@endsection