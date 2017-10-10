@extends('layouts.master')

@section('page-header')

@stop

@section('content')

    <div class="row" style="padding-top: 80px; ">
        <div class="col-xs-12 ">
            <div class="container">
                    <div id="products" class="row" >
                        @foreach($books as $book)
                        <div class="item col-xs-12 col-md-6 col-sm-4 col-lg-4 " style="vertical-align: middle;">
                            <div class="thumb" >
                                <img class="group list-group-image" src="{{url($book->images[0]) }}" alt="{{ $book->name }}" style="height: 300px;  " />
                                <div class="caption">
                                    <div style="height: 45px; padding:0 20px;">
                                    <h4 class="group inner list-group-item-heading center" style="text-align: center;">
                                        {{ $book->name }}</h4>
                                        </div>
                                        <p class="group inner list-group-item-text" id="textbox">
                                        {{  $book->description }}
                                        </p>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">

                                                @if(Helper::has_discount($book))
                                                <p class="lead" style="margin-top:-10px; margin-bottom: 0px;" >
                                                <del>{{ $book->price }}.00 eu</del><i style="color: red; size: 0.8em;"> -{{$book->discounts->procent}}%</i>
                                                  <br>{{ Helper::getPrice($book->discounts->procent , $book->price) }}</p>
                                                 @else
                                                <p class="lead" style="margin-top: 10px;" >
                                                    {{ $book->price }}.00 euro
                                                @endif
                                            </p>
                                        </div>

                                        <div class="col-xs-12 col-md-6" style="padding-top:10px; ">
                                            <a class="btn btn-success"  href="{{ url('book/'. $book->slug ) }}" >Подробнее</a>
                                        </div>
                                    </div><!--row-->
                                </div><!--caption-->
                            </div><!--.thumbnail-->
                        </div><!--.item-->

                        @endforeach
                    </div><!--product-->
                {{ $books->links() }}
                </div>
            </div>
     </div>
@stop
