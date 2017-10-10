<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
    <ul style="list-style-type: none; padding-left:0px; margin-left:-30px;">
        @foreach($categories as $category)
            <li style="padding: 5px;"><a href="{{ url('/category/'. $category->slug) }}" class="btn btn-category" style="min-width: 200px; padding-left:0px;">{{ $category->name}}</a></li>
        @endforeach
    </ul>
</div>