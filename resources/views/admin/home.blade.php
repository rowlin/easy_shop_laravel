@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center">Here you can set a discount for sale</h3></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>

                            <tr class="text-center">
                                <th class="col-xs-1 text-center">Selected</th>
                                <th class="col-xs-4 text-center">Name book</th>
                                <th class="col-xs-3 text-center">Old price</th>
                                <th class="col-xs-2 text-center">Discont</th>
                                <th class="col-xs-2 text-center">Days</th>

                            </tr>

                            <tr class="text-center" style="background-color: #1b4a80">
                                <th class="col-xs-1"><input type="checkbox" class="checkAll"></th>
                                <th class="col-xs-3 text-center" style="color:#f5f5f5">You can make discount for all</th>
                                <th class="col-xs-2"><input type="number" id="setAll" class="form-control" placeholder="0%"></th>
                                <th class="col-xs-3 text-center"><input type="number" id="AllDays" class="form-control" placeholder="days"></th>
                                <th class="col-xs-2 text-center">
                                    <button type="button" id="save_btn" class="btn btn-default">Save</button>
                                </th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach( $all as $item)
                                <tr class="item" data-attr="{{ $item->id}}">
                                    <td class="col-xs-1 text-center"><input type="checkbox" class="checkbox"></td>
                                    <td class="col-xs-4">{{ $item->name }} <a href="{{ url('book/'. $item->slug) }}">show</a></a>
                                    </td>
                                    <td class="col-xs-2 text-center " id="price">{{ $item->price }} euro</td>
                                    <td class="col-xs-3"><input id="val_{{ $item->id }}" class="form-control val" value="{{ isset($item->discounts->procent) ? $item->discounts->procent : 0 }}" placeholder="%" >
                                    </td>
                                    <td class="col-xs-2 text-center"><input id="day_{{ $item->id }}" class="form-control day" value=" {{ isset($item->discounts->days) ? $item->discounts->days : 0 }}" placeholder="days" ></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            var Data = [];


            $(".checkAll").on('change', function () {
                $(".checkbox").prop('checked', $(this).is(":checked"));
            });


            $("#setAll").on('input', function () {
                value = $("#setAll").val();
                $("input.val").val(value);
            });

            $("#AllDays").on('input', function () {
                value = $("#AllDays").val();
                $("input.day").val(value);
            });


            $('button#save_btn').click(function () {
                i=0;
                $('tr.item').each(function () {
                    key = $(this).data("attr");
                    Data[i++] ={
                        'key' : key,
                        'value' : $("#val_" + key).val(),
                        'day' : $("#day_" + key).val()
                    };
                });

                $.ajax({
                    type: 'post',
                    url: '/add_discount',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'data': Data
                    },
                    success: function (e) {
                        if (e.message) {
                            window.location.reload(true);
                        }
                    }
                });
            });
        });
    </script>
@endsection
