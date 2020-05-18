@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/auth.css')}}"> 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adatkezelési tájékoztató</div>

                <div class="card-body">
                    <h4 class="title is-4">1. Adatkezelő neve, elérhetőségei</h4>
                            <p>Név: Józsefvárosi Evangélikus Egyházközség
                            <br>Cím: 1086 Budapest, Karácsony Sándor u. 31-33.
                            <br>Telefonszám: +36 20 213 0157
                            <br>E-mail: jozsefvarosi.evangelikus@gmail.com
                            <br>Honlap: <a href="https://jozsefvaros.lutheran.hu/" target="_blank">jozsefvaros.lutheran.hu</a></p>

                            <h4 class="title is-4">2. Sütik</h4>
                            <h6 class="title is-6">2.1 A sütik használatlának célja</h6>
                            <p>Az Adatkezelő a weblap látogatása során úgy nevezett cookie-kat (sütiket) használ. A cookie
                                betűkből és számokból álló információcsomag, amit honlapunk küld el a felhasználó böngészőjének
                                azzal a céllal, hogy segítse a weblap használatában a felhasználót, elmentse bizonyos adatait és releváns statisztikai adatokat gyűjtsön róla.</p>
                            <h6 class="title is-6">2.2 Google Analytics</h6>
                            <p>Az Adatkezelő a Google Analytics programot elsősorban statisztikái előállításához használja. A program   használatával az Adatkezelő főként arról szerez információt, hogy hány látogató kereste fel Weboldalát,   ők milyen eszközt és böngészőt használtak, és mennyi időt töltöttek a weboldalon. A program felismeri   a látogató IP címét, ezért tudja követni, hogy a látogató visszatérő vagy új látogató-e, továbbá          követhető, hogy a látogató milyen utat tett meg a weboldalon és hova lépett be. Ezeknek az adatoknak a célja, hogy szükséges esetekben javítsuk a weblap horizontális bejárhatóságát, illetve információt      szerezzünk arról, hogy milyen eszközök és böngészők kompatibilitásának megoldása élvez prioritást.</p>
                            <h6 class="title is-6">2.3 A sütik letiltása</h6>
                            <p>Ha a cookie beállításait szeretné kezelni, vagy letiltani a funkcióról, azt a saját felhasználói
                                számítógépéről megteheti böngészőjében. Ez az opció a böngésző eszköztárától függően
                                található meg a cookie-k/sütik/követési funkciók elhelyezései menüpontban, általában
                                azonban az Eszközök > Beállítások > Adatvédelem beállításai alatt állíthatja be, milyen
                                követési funkciókat engedélyez/tilt le a számítógépén.
                                Azok a Felhasználók, akik nem szeretnék, hogy a Google Analytics jelentést készítsen a
                                látogatásukról, telepíthetik a Google Analytics letiltó böngészőbővítményt. Ez a kiegészítő
                                arra utasítja a Google Analytics JavaScript-szkriptjeit (ga.js, analytics.js, and dc.js), hogy ne
                                küldjenek látogatási információt a Google számára. Emellett azok a látogatók, akik
                                telepítették a letiltó böngészőbővítményt, a tartalmi kísérletekben sem vesznek részt.
                                Ha le szeretné tiltani az Analytics webes tevékenységét, keresse fel a Google Analytics letiltó
                                oldalát, és telepítse a bővítményt böngészőjéhez. A bővítmény telepítéséről és
                                eltávolításáról további tájékoztatásért tekintse meg az adott böngészőhöz tartozó súgót.</p>

                            <h4 class="title is-4">3. Személyes adatok kezelése</h4>
                            <h6 class="title is-6">3.1 Milyen adatokat tárolunk?</h6>
                            <p>Határozatlan ideig tároljuk az adatait azoknak a felhasználóknak, akik regisztrálnak az oldalra. Azokat a személyes adatokat tároljuk, amiket a felhasználó a regisztáció során megadott (név, e-mail cím). Ha a felhasználó új mosást vagy vendégéjszakát visz fel a rendszerbe, továbbá ha fájlt tölt fel a felületre, ezeknek az eseményeknek a metaadát is határozatlan ideig tároljuk.
                            <h6 class="title is-6">3.2 Kivel osztjuk meg ezeket az adatokat?</h6>
                            <p>Az adatokat senkivel nem osztjuk meg.</p>
                            <h6 class="title is-6">3.3 Ki férhet hozzá ezekhez az adatokhoz?</h6>
                            <p>Az Adatkezelőn kívül a weblap adminisztrátorai férhetnek hozzá ezekhez az adatokhoz.</p>
                            <h6 class="title is-6">3.4 Honnan tudhatom, milyen adatokat tárol rólam az Adatkezelő?</h6>
                            <p>A felhasználó az adatkezelés időtartamán belül tájékoztatást kérhet az Adatkezelőtől a személyes
                                adatai kezeléséről. Az Adatkezelő a kérelem benyújtásától számított legrövidebb idő alatt,
                                legfeljebb azonban 30 napon belül írásban, közérthető formában tájékoztatja a felhasználót a kezelt
                                adatokról.</p>
                            <h6 class="title is-6">3.5 Hogyan törölhetem a személyes adataimat?</h6>
                            <p>Az adatok törléséről az oldal tetején található "Fiók megszüntetése és adatok törlése" szekció ad bő megfelelő iránymutatást.</p>

                            <h4 class="title is-4">4. Az adatkezelési tájékoztató módosítása</h4>
                            <p>Az Adatkezelő fenntartja a jogot, hogy jelen adatkezelési tájékoztatót módosítsa. A honlap
                                a módosítás hatálybalépését követő használatával elfogadja a módosított adatkezelési
                                tájékoztatót.
                                Jelen Adatkezelési Tájékoztatóra a magyar jog az irányadó.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts-body')
    <script>
        $(document).ready( function() {
            var random = Math.floor((Math.random() * 9) + 1);
            $('body').css("background-image", "url('../images/backgrounds/bg" + random + ".jpg')");
        });
    </script>
@endsection