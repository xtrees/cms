<div class="panel">
    <h2>搜索</h2>
    <div class="body">
        <form name="search" method="get" action="{{ route('search') }}">
            <label>
                <input name="q" size="11" type="text">
            </label>
            <input type="submit" value="搜索">
        </form>
    </div>
</div>
<div class="panel" id="divPrevious">
    <h2>今日推荐</h2>
    <div class="body">
        <ul>
            @foreach(collection('rem3')  as $sideArt)
                <li><a href="{{ object_get($sideArt,'url') }}">{{ $sideArt->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<div class="panel">
    <h2>标签云</h2>
    <div class="body">
        <div class="tags">
            @foreach(CMS::tagCloud(50) as $tag)
                <a href="{{ object_get($tag,'url') }}"
                   title="{{ object_get($tag,'name') }}">{{ object_get($tag,'name') }}</a>
            @endforeach
        </div>
    </div>
</div>
