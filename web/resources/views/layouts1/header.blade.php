{{-- header web --}}
<style>
    @font-face {
        font-family: VeraSeBd;
        src: url({{ asset('fonts/VeraSeBd.ttf') }});
    }
    header div {
        background-image: url({{ asset('images/blue-gradient-horizontal.jpg') }});
        background-size: 100% 100%;
    }
    p.header {
        font-family: VeraSeBd;
        font-variant: small-caps;
        font-size: 2.3em;
        color: #fff;
        margin-left: 10%;
        padding: 20px 0px;
        text-shadow: 2px 2px 4px black;
        letter-spacing: 2px;
    }
</style>
<div class="container-fluid">
    <p class="header">Project Monitoring App</p>
</div>
