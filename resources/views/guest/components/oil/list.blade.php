<article id="catalog" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Используйте справочник для правильного применения эфирных масел</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach($oils as $item)
                    <div class="col-md-3 mbot3 oilPreview">
                        <a href="/oil/{{ $item->url }}"
                           title="{{ $item->rus_name }}"
                           v-on:click.prevent.stop="$root.$options.methods.changePage('oilItem', 'oil', '{{ $item->url }}')">
                            <img src="{{ $item->cover }}"
                                 alt="{{ $item->rus_name }}"
                                 width="100%">
                            <span class="oil-title">
                                {{ $item->rus_name }}
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</article>