@props(['withText' => true, 'color' => '#ff3a72'])

<div>
    @if ($withText)
        <h5 id="tr-loader" class="text-center mrg-top-5 mrg-bot-0" style="display: block;">
            <div class="lds-dual-ring"></div><br> Chargement...
        </h5>
    @else
        <span class="lds-dual-ring-2"></span>
    @endif

    <style>
        /* Spinner */
        .lds-dual-ring {
            display: inline-block;
            width: 40px;
            height: 40px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 24px;
            height: 24px;
            margin: 8px;
            border-radius: 50%;
            border: 4px solid #ff3a72;
            border-color: #ff3a72 transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* 2 */
        .lds-dual-ring-2 {
            display: inline-block;
            /* width: 40px;
            height: 40px; */
        }

        .lds-dual-ring-2:after {
            content: " ";
            display: block;
            width: 20px;
            height: 20px;
            margin: 0px;
            margin-bottom: -5px;
            border-radius: 50%;
            border: 4px solid {{ $color }};
            border-color: {{ $color }} transparent {{ $color }} transparent;
            animation: lds-dual-ring-2 1.2s linear infinite;
        }

        @keyframes lds-dual-ring-2 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</div>
