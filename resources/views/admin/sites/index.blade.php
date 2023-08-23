@extends('layouts.admin')
@section('title','Sites')
@section('main')  
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sites</h1>
        @include('errors.errors')
        @include('errors.message')
    </section>
    <section class="content">
        <form action="{{route('EditSites',$sites->id)}}" method="post">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tiêu Đề Trang Web</label>
                    <input type="text" class="form-control" name="title" value="{{$sites->title}}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$sites->email}}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="number" class="form-control" name="phone" value="{{$sites->phone}}">
                </div>
                <div class="form-group">
                    <label for="metakey">Địa Chỉ</label>
                    <textarea class="form-control" name="address" id="" rows="3">{{$sites->address}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Metakey</label>
                    <textarea class="form-control" name="metakey" id="metakey" rows="3">{{$sites->metakey}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Metadesc</label>
                    <textarea class="form-control" name="metadesc" id="metadesc" rows="3">{{$sites->metadesc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">CopyRight</label>
                    <textarea class="form-control" name="copyright" id="metadesc" rows="3">{{$sites->copyright}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Maps</label>
                    <textarea class="form-control" name="maps" id="metadesc" rows="3">{{$sites->maps}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Facebook</label>
                    <textarea class="form-control" name="facebook" id="metadesc" rows="3">{{$sites->facebook}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Messenger</label>
                    <textarea class="form-control" name="messager" id="metadesc" rows="3">{{$sites->messager}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakey">Youtube</label>
                    <textarea class="form-control" name="youtube" id="metadesc" rows="3">{{$sites->youtube}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                    <div class="input-group list-group-item">
                        <center>
                            <img id="img" src="{{asset('img/logo.png')}}" style="height:150px; width: auto;">
                            <input name="logo" value="{{$sites->logo}}" id="imgipt" type="file"  class="form-control" onchange="showimg(this);">
                        </center>
                    </div>                  
                </div>
                <div class="form-group list-group my-3">
                    <label class="list-group-item list-group-item-primary">Maps</label>
                        <div class="googlemap" style=" height: 520px; width:100%">
                        <!--<iframe src="https://www.google.com/maps/d/embed?mid=1QL3fh_EK4ZquIHHwTejM_k9jrOwmRy31" width="640" height="480"></iframe>-->
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7678548681183!2d106.7730425139515!3d10.829069461182975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175270036091045%3A0xa354a589a3d56339!2sHCMC+Industry+%26+Trade+College!5e0!3m2!1sen!2sus!4v1543514595114" width="450" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>      
                </div>
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Facebook</label>
                        <div class="googlemap" style=" height: 520px; width:100%">
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fwww.YaMe.vn%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                    </div>      
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn">Lưu</button>
                </div>
            </div>
        </div>
        </form>
    </section>

@endsection