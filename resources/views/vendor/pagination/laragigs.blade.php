{{-- CSS --}}
<style>
    * {
        outline: none;
    }

    html,
    body {
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
            Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;

        cursor: url(http://k003.kiwi6.com/hotlink/vp054ir5gt/c1.png) 32 32, auto;
        cursor: -webkit-image-set(url(http://k003.kiwi6.com/hotlink/vp054ir5gt/c1.png) 1x, url(http://k003.kiwi6.com/hotlink/z6fy599487/c2.png) 2x) 32 32, auto;
    }

    body:active {
        cursor: url(http://k003.kiwi6.com/hotlink/3p6w4icbzt/c1a.png) 32 32, auto;
        cursor: -webkit-image-set(url(http://k003.kiwi6.com/hotlink/3p6w4icbzt/c1a.png) 1x, url(http://k003.kiwi6.com/hotlink/6ma7828al1/c2a.png) 2x) 32 32, auto;
    }

    #pag-cover {
        width: 466px;
        color: #fff;
        line-height: 1;
        margin: 2rem auto 0 auto;
        background-color: #2c63ff;
        border-radius: 4px;
        box-shadow: 0 10px 20px #26418f;
        user-select: none;
    }

    .arr-cover {
        width: 1px;
        font-size: 20px;
        text-align: center;
    }

    .arrow {
        padding: 26px;
    }

    .arrow i {
        display: block;
    }

    #pg-links {
        display: table;
        width: 100%;
    }

    #pg-links .td {
        display: table-cell;
        vertical-align: middle;
    }

    #links {
        width: 216px;
        text-align: center;
        margin: 0 auto;
        overflow: hidden;
    }

    .pg-link {
        position: relative;
        width: 22px;
        float: left;
        color: #fff;
        font-size: 20px;
        text-align: center;
        padding: 26px 25px;
        background-color: transparent;
        transition: 0.2s ease background-color, 0.3s ease color;
    }

    .pg-link span {
        position: relative;
        z-index: 2;
    }

    .pg-link:hover {
        background-color: #2d59d6;
    }

    .pg-link.s-hide {
        color: rgba(255, 255, 255, 0);
    }

    #m-pg-link:after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: #1944bd;
        transition: 0.3s ease right, 0.3s ease left;
    }

    #m-pg-link.left:after {
        right: 72px;
        left: -72px;
    }
</style>
{{-- Js --}}
<script>
    $(function() {
        var pg_links = $(".pg-link"),
            h_elm = $("#m-pg-link"),
            curr = 5,
            _this,
            _class,
            _id,
            __this,
            _num,
            i = 0;

        function changeNumbers(flag) {
            if ((curr > 2 && flag == 0) || flag) {
                if (curr == 1) {
                    curr = 2;
                    h_elm.removeClass("left");
                    return;
                }

                $(pg_links).each(function() {
                    __this = $(this).find("span");
                    _num = parseInt(__this.text());

                    if (flag) _num += 1;
                    else _num -= 1;

                    ++i;

                    pg_links.addClass("s-hide");

                    __this.text(_num);

                    setTimeout(function() {
                        pg_links.removeClass("s-hide");
                    }, 150);

                    if (i == 2) curr = _num;
                });

                i = 0;
            } else {
                if (curr == 2 && flag == 0) {
                    curr = 1;
                    h_elm.addClass("left");
                }
            }
        }

        function changeLinks() {
            _this = $(this);
            _class = _this.attr("class").trim().toLowerCase();

            if (_class == "arrow") {
                _id = _this.attr("id").trim().toLowerCase();

                if (_id == "l-arrow") changeNumbers(0);
                else changeNumbers(1);
            } else {
                if (parseInt(_this.text().trim()) < curr) changeNumbers(0);
                else changeNumbers(1);
            }
        }

        $(".pg-link,.arrow").on("click", changeLinks);
    });
</script>

@if ($paginator->hasPages())
    <div id="pag-cover">
        <div id="pg-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="td arr-cover" aria-disabled="true">
                        <div class="arrow" id="l-arrow"><i class="fas fa-chevron-circle-left"></i></div>
                </div>
            @else
                <div class="td arr-cover" aria-disabled="false">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <div class="arrow" id="l-arrow"><i class="fas fa-chevron-circle-left"></i></div>
                    </a>
                </div>
            @endif

                {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <div class="pg-link" id="m-pg-link"><span>{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <div class="pg-link" id="m-pg-link"><span>{{ $page }}</span></div>
                    @else
                    <div class="pg-link">
                        <a href="{{ $url }}">
                            <span>{{ $page }}</span>
                        </a>
                    </div>
                    @endif
                @endforeach
            @endif
        @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="td arr-cover" aria-disabled="false">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <div class="arrow" id="r-arrow"><i class="fas fa-chevron-circle-right"></i></div>
                    </a>
                </div>
            @else
                <div class="td arr-cover" aria-disabled="true">
                    <div class="arrow" id="r-arrow"><i class="fas fa-chevron-circle-right"></i></div>
                </div>
            @endif
        </div>
    </div>
@endif
