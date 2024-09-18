@if (!empty(Seo::get('schema')))
    <script type="application/ld+json">
        {!! htmlspecialchars_decode(Seo::get('schema')??'') !!}
    </script>
@elseif (!empty($com) && $com == 'gioi-thieu')
    <!-- Static -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://google.com/article"
            },
            "headline": "{!! @$static['name' . $lang] !!}",
            "image": [
                "{{ upload('news',@$static['photo']) }}"
            ],
            "datePublished": "{{ date('Y-m-d', @$static['date_created']) }}",
            "dateModified": "{{ date('Y-m-d', @$static['date_updated']) }}",
            "author": {
                "@type": "Person",
                "name": "{!! @$setting['name' . $lang] !!}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Google",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ upload('photo',@$logo['photo']) }}"
                }
            },
            "description": "{{ Seo::get('description') }}"
        }
    </script>
@else
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{!! @$setting['name' . $lang] !!}",
            "url": "{{ config('app.asset') }}",
            "sameAs": [
                @if (isset($social) && count($social) > 0) 
                    @php $sum_social = count($social);  @endphp
                    @foreach ($social as $key => $value)
                        "{{@$value['link']}}"{{(($key+1) < $sum_social+1) ? ',' : ''}}
                    @endforeach
                @endif
            ],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{!! $setting['address' . $lang] !!}",
                "addressRegion": "Ho Chi Minh",
                "postalCode": "70000",
                "addressCountry": "vi"
            }
        }
    </script>
@endif