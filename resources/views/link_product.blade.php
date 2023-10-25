@extends('layouts.default')
@section('content')
<div class="container-fluid p-0">
    <section class="resume-section">

        <div class="card pjual">
            <h5 class="card-header">
                Grouu - Bubur Bayi MPASI - Alacarte Meal 1 Jar - Makanan Bayi No MSG
            </h5>
            <div class="card-body row align-items-start">
                <div class="col">
                    
                    <div class="product">
                        <div class="product__images">
                            <img
                                src="https://images.tokopedia.net/img/cache/900/VqbcmM/2023/6/15/ceb4fc57-3f67-4784-9320-151c932cafd3.jpg"
                                alt="google pixel 6"
                                class="product__main-image"
                                id="main-image"
                            />

                            <div class="product__slider-wrap">
                                <div class="product__slider">
                                    <img
                                        src="https://images.tokopedia.net/img/cache/900/VqbcmM/2023/6/15/ceb4fc57-3f67-4784-9320-151c932cafd3.jpg"
                                        class="product__image product__image--active"
                                    />
                                    <img
                                        src="https://images.tokopedia.net/img/cache/900/VqbcmM/2023/9/7/34123b06-ec71-4934-a125-98b684c09683.jpg"
                                        class="product__image"
                                    />
                                    <img
                                        src="https://images.tokopedia.net/img/cache/900/VqbcmM/2023/9/7/a900caac-bae5-4343-9105-0b8f7c9d061d.jpg"
                                        class="product__image"
                                    />
                                    <img
                                        src="https://images.tokopedia.net/img/cache/900/VqbcmM/2023/9/7/c35867fe-c734-4baf-a1e0-84fec76cbf0a.png"
                                        class="product__image"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <div class="product__price">Rp 3.300.000 / pcs</div>

                    

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