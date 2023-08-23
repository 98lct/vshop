@extends('layouts.guest')
@section('title','Contact')
@section('main')
<section class="block container">
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{route('contact')}}">
                @csrf
                <h3>Liên Hệ</h3>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="fullname" aria-label="fullname" name="fullname" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="email" aria-label="email" name="email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="phone" aria-label="phone" name="phone" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="title" aria-label="title" name="title" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mt-3">
                    {{-- <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-justify"></i></span>
                    </div> --}}
                    <textarea class="form-control" aria-label="With textarea" name="detail" rows="5"></textarea>
                </div>
                <div class="input-group mt-5">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>

            </form>
        </div>
        <div class="col-md-6">
                <div class="googlemap" style=" height: 100%;">
                        <!--<iframe src="https://www.google.com/maps/d/embed?mid=1QL3fh_EK4ZquIHHwTejM_k9jrOwmRy31" width="640" height="480"></iframe>-->
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7678548681183!2d106.7730425139515!3d10.829069461182975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175270036091045%3A0xa354a589a3d56339!2sHCMC+Industry+%26+Trade+College!5e0!3m2!1sen!2sus!4v1543514595114" width="450" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
        </div>
    </div>
</section>
@endsection
