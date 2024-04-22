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

        @foreach ($images as $foto)
            <item>
                <title>{{ $foto->name }}</title>
                <link>{{ Request::root() }}/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}</link>
                <author>
                    <![CDATA[ {{ $foto->user->name }} ]]>
                </author>
                <pubDate>{{ $foto->created_at->toRssString() }}</pubDate>
                <guid isPermaLink="false">{{ Request::root() }}/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}
                </guid>
                <description>
                    <![CDATA[ <img src="{{ $foto->image }}"><br><p>{{ $foto->caption }}</p> ]]>
                </description>
            </item>
        @endforeach
    </channel>
</rss>
