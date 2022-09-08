@extends('layout.master', ['title'=>'Galeri DPMPTSP'])

@section('head')
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.css"
        integrity="sha512-c7kgo7PyRiLnl7mPdTDaH0dUhJMpij4aXRMOHmXaFCu96jInpKc8sZ2U6lby3+mOpLSSlAndRtH6dIonO9qVEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox;
            /* IE10 */
            display: flex !important;
            -ms-flex-wrap: wrap;
            /* IE10 */
            flex-wrap: wrap !important;
            padding: 0 4px !important;
        }

        /* Create four equal columns that sits next to each other */
        .column {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25% !important;
            max-width: 25% !important;
            padding: 0 4px !important;
        }

        .column img {
            margin-top: 8px;
            vertical-align: middle;
            width: 100%;
        }

        /* Responsive layout - makes a two column-layout instead of four columns */
        @media screen and (max-width: 800px) {
            .column {
                -ms-flex: 50%;
                flex: 50% !important;
                max-width: 50% !important;
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column {
                -ms-flex: 100%;
                flex: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
@endsection

@section('main')
    <div id="images" class="row">
        @for ($column = 1; $column < 5; $column++)
            <div class="column">
                <?php $limit = $column * ceil(count($galleries) / 4); ?>
                @if ($column > count($galleries) % 4 && count($galleries) % 4 != 0)
                    <?php $limit--; ?>
                @endif
                @for ($index = ($column - 1) * ceil(count($galleries) / 4); $index < $limit; $index++)
                    @if ($column > (count($galleries) % 4) + 1 && count($galleries) % 4 > 0)
                        <?php $imageIndex = $index - ($column - ((count($galleries) % 4) + 1)); ?>
                        <img src="{{ $galleries[$imageIndex]->path }}"
                            alt="{{ $galleries[$imageIndex]->title }}" />
                    @else
                        <img src="{{ $galleries[$index]->path }}" alt="{{ $galleries[$index]->title }}" />
                    @endif
                @endfor
            </div>
        @endfor
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.js"
        integrity="sha512-i5q29evO2Z4FHGCO+d5VLrwgre/l+vaud5qsVqQbPXvHmD9obORDrPIGFpP2+ep+HY+z41kAmVFRHqQAjSROmA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // View a list of images.
        // Note: All images within the container will be found by calling `element.querySelectorAll('img')`.
        const gallery = new Viewer(document.getElementById('images'), {});
        $('.galleries').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            // autoplay: true,
            // autoplaySpeed: 2000,
            dots: true,
            prevArrow: true,
            nextArrow: true,
        });
    </script>
@endsection
