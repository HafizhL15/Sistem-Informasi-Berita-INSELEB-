<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    <url>
        <loc>{{ Request::root() }}</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
    </url>

    @foreach ($artikels as $artikel)
        <url>
            <loc>{{ Request::root() }}/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}</loc>
            <lastmod>{{ $artikel->published_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
            <news:news>
                <news:publication>
                    <news:name>
                        <![CDATA[{{ $webtitle }}]]>
                    </news:name>
                    <news:language>
                        <![CDATA[ id ]]>
                    </news:language>
                </news:publication>
                <news:publication_date>
                    <![CDATA[{{ $artikel->published_at->tz('UTC')->toAtomString() }}]]>
                </news:publication_date>
                <news:title>
                    <![CDATA[{{ $artikel->title }}]]>
                </news:title>
                <news:keywords>
                    <![CDATA[{{ $keywords }}]]>
                </news:keywords>
            </news:news>
        </url>
    @endforeach

    @foreach ($images as $foto)
        <url>
            <loc>{{ Request::root() }}/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}</loc>
            <lastmod>{{ $foto->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
            <news:news>
                <news:publication>
                    <news:name>
                        <![CDATA[{{ $webtitle }}]]>
                    </news:name>
                    <news:language>
                        <![CDATA[ id ]]>
                    </news:language>
                </news:publication>
                <news:publication_date>
                    <![CDATA[{{ $foto->created_at->tz('UTC')->toAtomString() }}]]>
                </news:publication_date>
                <news:title>
                    <![CDATA[{{ $foto->name }}]]>
                </news:title>
            </news:news>
        </url>
    @endforeach

    @foreach ($categories as $kategori)
        <url>
            <loc>{{ Request::root() }}/kategori/{{ $kategori->id }}/{{ $kategori->slug }}</loc>
            <lastmod>{{ $kategori->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ Request::root() }}/indeks</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ Request::root() }}/list-foto</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ Request::root() }}/daftar-penulis</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ Request::root() }}/kirim-artikel</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ Request::root() }}/pilihan-editor</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ Request::root() }}/cari-artikel</loc>
        <lastmod>{{ $webcreated->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($infos as $info)
        <url>
            <loc>{{ Request::root() }}/{{ $info->slug }}</loc>
            <lastmod>{{ $info->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($tags as $tag)
        <url>
            <loc>{{ Request::root() }}/tag/{{ $tag->id }}/{{ $tag->slug }}</loc>
            <lastmod>{{ $tag->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($longtails as $longtail)
        <url>
            <loc>{{ Request::root() }}/rlo-{{ $longtail->id }}/{{ $longtail->slug }}</loc>
            <lastmod>{{ $longtail->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>
