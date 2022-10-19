<section class="news-group">
    <div class="news-group-content">
        <section class="new-group-head">
            <ul class="new-group-lst">
                @foreach ($news() as $index => $new)
                    <li>
                        <article class="new-group-item">
                            <a class="ngrp-link" href="#"><img src="{{ImgHelper::get_cached($new->image, ['w' => 400, 'h' => 300, 'c' => 'cover', 'q' => 80]) }}" alt="{{$new->title}}"/></a>
                            <header><a href="#" class="big-new-link">{{$new->title}}</a></header>
                            <span class="big-new-datetime">{{$new->date_start}}</span>
                        </article>
                    </li>
                @endforeach
            </ul>
        </section>


        <section class="new-group-head">
            <ul class="new-group-lst">
                @foreach ($news() as $index => $new)
                    <li>
                        <article class="new-group-item">
                            <a class="ngrp-link" href="#"><img src="{{ImgHelper::get_cached($new->image, ['w' => 400, 'h' => 300, 'c' => 'cover', 'q' => 80]) }}" alt="{{$new->title}}"/></a>
                            <header><a href="#" class="big-new-link">{{$new->title}}</a></header>
                            <span class="big-new-datetime">{{$new->date_start}}</span>
                        </article>
                    </li>
                @endforeach
            </ul>
        </section>


        <section class="new-group-head">
            <ul class="new-group-lst">
                @foreach ($news() as $index => $new)
                    <li>
                        <article class="new-group-item">
                            <a class="ngrp-link" href="#"><img src="{{ImgHelper::get_cached($new->image, ['w' => 400, 'h' => 300, 'c' => 'cover', 'q' => 80]) }}" alt="{{$new->title}}"/></a>
                            <header><a href="#" class="big-new-link">{{$new->title}}</a></header>
                            <span class="big-new-datetime">{{$new->date_start}}</span>
                        </article>
                    </li>
                @endforeach
            </ul>
        </section>



    </div>
</section>


