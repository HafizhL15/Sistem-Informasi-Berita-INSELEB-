<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0">
    <channel>
        <title>{{ Request::root() }}</title>
        <link>{{ Request::root() }}</link>
        <description>{{ $websites }}</description>
        <language>id-ID</language>
        <lastBuildDate>{{ now() }}</lastBuildDate>

        <image>
            <url>{{ Request::root() }}/storage/{{ $icon }}</url>
            <title>{{ Request::root() }}</title>
            <link>{{ Request::root() }}</link>
            <width>32</width>
            <height>32</height>
        </image>

        @foreach ($artikels as $artikel)
            <item>
                <title>{{ $artikel->title }}</title>
                <link>{{ Request::root() }}/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}</link>
                <author>
                    <![CDATA[ {{ $artikel->user->name }} ]]>
                </author>
                <pubDate>{{ $artikel->published_at->toRssString() }}</pubDate>
                <category>
                    <![CDATA[ {{ $artikel->category->name }} ]]>
                </category>
                <guid isPermaLink="false">{{ Request::root() }}/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}
                </guid>
                <description>
                    <![CDATA[ <img src="{{ $artikel->image }}"><br><p>{{ $artikel->description }}</p> ]]>
                </description>
            </item>
        @endforeach
    </channel>
</rss>
