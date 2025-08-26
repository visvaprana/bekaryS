<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>

        <title>{{$website_name}} </title>
        <link>{{$website}}</link>
        <description><![CDATA[{{$website_name}} - Know About Your Products ]]></description>
         <!--<atom:link href="{{$website}}" rel="self" type="application/rss+xml" /> -->
        <language>en </language>
        <pubDate>{{ now()->toRssString() }}</pubDate>

        @foreach($categories as $category)
            <item>
                <title><![CDATA[{{ $category->name }}]]></title>
                <link>{{$website}}{{ $category->slug }}</link>
                <description><![CDATA[{!! $category->meta_des !!}]]></description>
                <guid>{{$website}}{{ $category->slug }}</guid>
                <pubDate>{{ $category->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach



        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{$website}}{{ $post->slug }}</link>
                <description><![CDATA[{!! $post->meta_description !!}]]></description>
                <guid>{{$website}}{{ $post->slug }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach

        @foreach($products as $product)
            <item>
                <title><![CDATA[{{ $product->name }}]]></title>
                <link>{{$website}}{{ $product->slug }}</link>
                <description><![CDATA[{!! $product->meta_description !!}]]></description>
                <guid>{{$website}}{{ $product->slug }}</guid>
                <pubDate>{{ $product->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach

        @foreach($pages as $page)
            <item>
                <title><![CDATA[{{ $page->title }}]]></title>
                <link>{{$website}}{{ $page->slug }}</link>
                <description><![CDATA[{!! $page->content !!}]]></description>
                <guid>{{$website}}{{ $page->slug }}</guid>
                <pubDate>{{ $page->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach




    </channel>
</rss>