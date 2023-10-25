@extends('layouts.default')
@section('content')
<div class="container-fluid p-0">
    <section class="resume-section">

        <div class="card pjual">
            <h5 class="card-header">
                Tissue Jolly 250 Sheets
            </h5>
            <div class="card-body row align-items-start">
                <div class="col">
                    
                    <div class="product">
                        <div class="product__images">
                            <img
                                src="{{url('/')}}/assets/shop/jolly-1.png"
                                alt="google pixel 6"
                                class="product__main-image"
                                id="main-image"
                            />

                            <div class="product__slider-wrap">
                                <div class="product__slider">
                                    <img
                                        src="{{url('/')}}/assets/shop/jolly-1.png"
                                        class="product__image product__image--active"
                                    />
                                    <img
                                        src="{{url('/')}}/assets/shop/jolly-2.jpg"
                                        class="product__image"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <p class="card-text">
                        Jolly 250 Sheets Facial tissue<br>
                        Berbahan 100% serat alami yang higienis, lembut dan alami<br>
                        Memiliki kekuatan, daya serap, dan sentuhan kelembutan untuk Anda serta didesain untuk membersihkan kulit Anda tanpa iritasi<br>
                        Isi/bks : 250 Sheets/ 2 Ply
                    </p>
                    <div class="product__price">Rp 8.000 / pcs</div>

                    

                    <a target="_blank" class="btn btn-primary btn-wa" href="https://wa.me/6281229575299/?text=Bro mau pesan Grouu - Bubur Bayi MPASI - Alacarte Meal 1 Jar - Makanan Bayi No MSG" style="background-color: #2db627;border:none;">
                        <i class="bi bi-whatsapp"></i>
                        WA untuk Order
                    </a>
                </div>
            </div>
        </div>
        
    </section>
</div>

<script type="text/javascript">
    const mainImage = document.getElementById("main-image");
    const images = document.querySelectorAll(".product__image");

    images.forEach((image) => {
        image.addEventListener("click", (event) => {
            mainImage.src = event.target.src;

            document
                .querySelector(".product__image--active")
                .classList.remove("product__image--active");

            event.target.classList.add("product__image--active");
        });
    });
</script>
@endsection