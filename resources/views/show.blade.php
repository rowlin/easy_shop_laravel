@extends('layouts.master')

@section('page-header')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>





@stop

@section('content')

    <div class="row" style="padding-top: 80px; ">


        @widget('Category')

        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
            <div class="container">

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif


                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <img id="zoom_03" style="width: 100%; max-width: 450px; " src="{{ url($book->images[0]) }}" data-zoom-image="{{ url($book->images[0]) }}"/>
                        <div id="gallery_01">
                            @foreach($book->images as $image)
                            <a href="#" data-image="{{ url($image) }}" data-zoom-image="{{ url($image) }}">
                                <img id="img_01" src="{{ url($image) }}" style="max-height: 100px;"/>
                            </a>
                            @endforeach
                        </div>
                    </div><!--grid for item-->

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                        <h2>{{ $book->name }}</h2>
                        <p style="padding: 5px;"><b>Автор : </b>{{ $book->author }}</p>
                        <p style="padding: 3px;"><b>Цена : </b>{{ $book->price }}.00 euro</p>
                        <div style="padding: 5px;">
                        @if($book->koll > 0 )
                          <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Приобрести</a>
                        @else($book->koll == 0)
                            <a class="btn btn-info" data-toggle="modal" data-target="#myModal">Заказать</a>
                        @endif
                            </div>
                        <p style="padding: 5px;"><b>Описание :</b><br>{!!  $book->description !!}</p>
                    </div><!--grid for item-->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title center" >Форма заказа</h4>
                </div>
                <div class="modal-body">
                    <p class="center">В настоящее время возможна доставка курьером по Нарве</p>
                    <form role="form" method="post" action="{{url('/order/create')}}" data-toggle="validator" class="form-horizontal">
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}" >
                        <input type="hidden" name="book_id" id="id_book" value="{{ $book->id }}">
                        <input type="hidden" name="sum" id="sum" value="{{ $book->price }}">
                        <input type="hidden" name="kol" id="kol" value="1">
                        <div class="form-group">
                            <label for="name" class="control-label col-xs-2">Имя</label>
                            <div class="col-xs-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Имя" required="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="control-label col-xs-2">Телефон</label>
                            <div class="col-xs-10">
                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="Номер телефона" required="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="control-label col-xs-2">Комментарий</label>
                            <div class="col-xs-10">
                                <input  type="text" name="comment" class="form-control" id="comment" placeholder=" Укажите удобное время для звонка или доставки" required="required"/>
                            </div>
                        </div>

                            <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        <button type="submit" id="send" class="btn btn-primary">Оформить заказ</button>
                                    </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!--My modal-->

@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#zoom_03").ezPlus({
                gallery: 'gallery_01',
                cursor: 'pointer',
                galleryActiveClass: "active",
                imageCrossfade: true,
                loadingIcon: "images/spinner.gif"
            });
        });


        $("#send").click(function(e){
            var token = $('#token').val();
            var id = $("#id_book").val();
            var sum = $("#sum").val();
            var order_name = $("#name").val();
            var order_phone = $("#phone").val();
            var order_comment = $("#comment").val();
            var kol = $('#kol').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $.ajax({
                url:'/order/create/',
                type: 'POST',
                data: {
                        _token : token,
                        id:id,
                        sum:sum,
                        name:order_name,
                        phone:order_phone,
                        comment:order_comment,
                        kol:kol
                    },
                success: function(msg){
                    $("#ajaxResponse").append(msg);
                }
            });

        });


    </script>
@stop