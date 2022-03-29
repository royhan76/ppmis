@extends('layouts.home.main')
<link href="/css/app.css" rel="stylesheet">


@section('section')
    <div class="container-fluid">

        <div class="row">
            <section id="doctors" class="doctors">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="assets/img/ppmis.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h2>{{ $data4->title }}</h2>
                                    <span>oleh : Kang Santri</span>
                                    <p style="text-align: justify;text-justify: inter-word;">{{ $data4->content }}</p>
                                    <br>
                                    <span>Share On: </span>
                                    <div class="social">
                                        <a href=""><i class="ri-twitter-fill"></i></a>
                                        <a href=""><i class="ri-facebook-fill"></i></a>
                                        <a href=""><i class="ri-instagram-fill"></i></a>
                                        <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </section>
        </div>

    </div>
@endsection
