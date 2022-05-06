<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();

        DB::table('articles')->insert($this->articles());

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function articles(): array
    {
        return [
            [
                'title' => 'Aubameyang Mandul di Laga Benfica vs Arsenal, Mikel Arteta Pasang Badan',
                'slug' => 'aubameyang-mandul-di-laga-benfica-vs-arsenal-mikel-arteta-pasang-badan',
                'excerpt' => 'Aubameyang tampil kurang baik tanpa mencetak gol dalam laga Benfica vs Arsenal',
                'content' => '<p style="text-align: justify;"><strong>Roma - </strong>Hasil kurang maksimal harus didapatkan <strong>Arsenal</strong>&nbsp;ketika menjalani leg pertama babak 32 Besar <strong>Liga Eropa</strong>&nbsp;musim 2020-2021. Menghadapi Benfica, skuad The Gunners &ndash;julukan Arsenal&ndash; harus puas bermain imbang 1-1.</p>
                <p style="text-align: justify;">Dalam pertandingan yang digelar di Stadio Olimpico, Roma, dini hari tadi WIB, Arsenal sebenarnya tampil mendominasi sejak menit awal. Bahkan beberapa kali kesempatan didapatkan Arsenal untuk bisa membuka keunggulan atas Benfica.</p>
                <p style="text-align: justify;">Bahkan Arsenal hampir membuka skor di pertengahan babak pertama melalui peluang yang didapatkan oleh Pierre-Emerick Aubameyang. Namun sontekan Aubameyang yang meneruskan umpan dari Hector Bellerin masih gagal tepat sasaran.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 1-1.jpg" /></p>
                <p style="text-align: justify;">Alih-alih mampu membuka mencetak gol, Arsenal justru harus melihat gawang mereka kebobolan lebih dahulu. Adalah Pizzi yang berhasil membawa Benfica menyumbangkan golnya untuk Benfica melalui eksekusi penalti di menit ke-55.</p>
                <p style="text-align: justify;">Tersentak oleh gol Benfica, Arsenal pun kian gencar memberikan tekanan ke kubu lawan. Alhasil Arsenal berhasil menyamakan kedudukan ketika pertandingan berjalan 57 menit melalui sontekan dari Bukayo Saka.</p>
                <p><!-- pagebreak --></p>
                <p style="text-align: justify;">Pada saat ketika kembali seimbang, Arsenal sendiri sempat beberapa kali mendapatkan kans melalui aksi Aubameyang. Namun sejumlah peluang emas yang didapatkan oleh penyerang berkebangsaan Gabon tersebut masih gagal jadi gol. Hingga laga usai skor 1-1 pun tetap bertahan.</p>
                <p style="text-align: justify;">Seusai laga, banyak komentar negatif yang menyerang performa Aubameyang. Ya, Aubameyang dinilai terlalu banyak menyianyiakan kesempatan untuk mencetak gol. Pelatih Arsenal, Mikel Arteta, pun memberikan pembelaan terhadap performa Aubameyang di laga kontra Benfica.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 1-2.jpg" /></p>
                <p style="text-align: justify;">&ldquo;Ya, hal seperti itu memang bisa terjadi. Dia (Aubameyang) mendapakan salah satu peluang terbesar kami di pertandingan tadi (melawan Benfica),&rdquo; jelas Arteta, sebagaimana dilaporkan oleh Football London, Jumat (19/2/2021).</p>
                <p style="text-align: justify;">&ldquo;Dia benar-benar jadi ancaman untuk lawan dan karena itulah kami memainkan dia kembali hari ini menghadapi lawan yang memasang garis pertahanan demikian. Dia hanya tidak beruntung gagal mencetak dua atau tiga gol, sebab pada situasi normal itulah yang akan terjadi,&rdquo; tutupnya.</p>',
                'thumbnail' => asset('images/seeder/Banner 1.jpg'),
                'user_id' => 1,
                'created_at' => Carbon::create('2021-02-22 10:00:00'),
            ],
            [
                'title' => 'Motivasi Bos Manchester United untuk Bruno Fernandes Cs: Jangan Kasih Kendor, Setan Merah!',
                'slug' => 'motivasi-bos-manchester-united-untuk-bruno-fernandes-cs-jangan-kasih-kendor-setan-merah',
                'excerpt' => 'Mancehster United sedang mengalami trend positif dengan meraih kemenangan atas Newscastle United pada pekan ke 25 Liga Inggris',
                'content' => '<p style="text-align: justify;">Kemenangan Mancehster United atas Newscastle United membuat tim yang berjuluk Setan Merah itu kembali ke jalur kemenangan. Pada pertandingan lanjutan Liga Inggris pekan 25, Mancehster United sukses menenggalamkan Newscastle United lewat skor 3-1, Senin (22/2/2021) dini hari WIB. Kemenangan Setan Merah berhasil dibukukan berkat gol dari Marcus Rashford, Daniel James, dan Bruno Fernandes.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 2-1.jpg" width="700" height="393" /></p>
                <p style="text-align: justify;">Newcastle United sebetulnya sempat mengimbangi tuan rumah di babak pertama lewat gol Allan Saint-Maximin. Namun sayang, pada paruh kedua banyak membuang kesempatan. Kemenangan yang ditorehkan anak asuh Ole Gunnar Solskjaer itu membuat mereka kembali ke track kemenangan.</p>
                <p style="text-align: justify;">Sebelumnya dalam dua laga terakhir Mancehster United di Liga Inggris hanya mampu meraih ahsil imbang, yakni melawan Everton dan West Ham United. Solskjaer selaku pelatih Mancehster United memberikan motivasi yang ditujukan kepada Bruno Fernandes dkk. Ia meminta timnya untuk terus semagat dan jangan aksih kendor dalam perburuan gelar Liga Inggris musim ini.</p>
                <p><!-- pagebreak --></p>
                <p>Setan Merah kini duduk di tangga kedua klasemen Liga Inggris lewat koleksi 49 poin. Mereka berselisih 10 angka dengan sang pemauncak klasemen, Manchester City.</p>
                <p>"Teruslah maju, Anda tidak bsia berhenti saat ini. Musim ini tergolong istimewa, tetap Anda harus terus majju dan membangkitkan kepercayaan diri," terang Solskjaer, dikutip dari <em>laman resmi klub</em>.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 2-2.jpg" width="700" height="350" /></p>
                <p>"Kami harus pulih dengan baik dan saya yakin mereka akan melakukannya karena ketika Anda memenangkan pertandingan, Anda mendapatkan energi," tambah juru taktik asal Norwegia itu. Disinggung mengenai jalannya pertandingan melawan The Magpies, Solskjaer menyoroti anak asuhnya tampil lebaih meyakinkan di babak kedua.</p>
                <p>"Babak pertama, meskipun kami memiliki sebagian besar penguasaan bola, kami tidak cukup membahayakan. Kami meningkatkannya dan kami melakukannya di babak kedua," sambungnya. Di sisi lain, Solskjaer juga menyinggung soal sejumlah aspek yang perlu dibenahi dari timnya, teramsuk dalam kecepatan permainan.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 2-3.jpg" width="700" height="393" /></p>
                <p>"Kami harus meningkatkan tempo permainan lebih cepat lagi, meskipun kali ini berhasil, saya rasa masih banyak yang harus kami perbaiki," jelas Ole Gunnar Solskjaer, dikutip dari laman resmi klub. Menurutnya, Mancehster United&nbsp;memiliki pekerjaan rumah yang paling penting ialah soal finisihing touch.</p>
                <p><!-- pagebreak --></p>
                <p>Selama ini Mancehster United mampu mengusai jalannya pertandingan, namun kelemahan yang dimiliki Setan Merah ialah mereka gagal memanfaatkan peluang untuk dikreasikan menjadi gol. "Kami memiliki cukup banyak pertandingan musim ini, jadi butuh waktu hingga paruh waktu, meskipun kami mendominasi penguasaan bola dan kami memiliki banyak bola. Kami tidak dapat menciptakan terlalu banyak peluang besar," pungkasnya.</p>',
                'thumbnail' => asset('images/seeder/Banner 2.jpg'),
                'user_id' => 1,
                'created_at' => Carbon::create('2021-02-22 10:00:00'),
            ],
            [
                'title' => 'Jadwal Liga Champions Pekan Ini: Ada Chelsea, Man City hingga Real Madrid',
                'slug' => 'jadwal-liga-champions-pekan-ini-ada-chelsea-man-city-hingga-real-madrid',
                'excerpt' => 'Real Madrid akan bertandang ke markas Atalanta di ajang Liga Champions',
                'content' => '<p style="text-align: justify;">Jadwal Liga Champions pekan ini masih menggulirkan leg I babak 16 besar. Setelah mementaskan empat pertandingan pekan lalu, minggu ini juga empat laga yang bergulir, melibatkan tim-tim mapan seperti Bayern Munich, Chelsea, Manchester City hingga Real Madrid.</p>
                <p style="text-align: justify;">Liga Champions pekan ini dimulai pada Rabu 24 Februari 2021 pukul 03.00 WIB. Sebanyak dua laga digelar, mempertemukan Atletico Madrid vs Chelsea dan Lazio vs Bayern Munich.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 3-1.jpg" /></p>
                <p style="text-align: justify;"><strong>(Chelsea hadapi Atletico Madrid di tempat netral)</strong></p>
                <div id="lastread" style="text-align: justify;"></div>
                <p style="text-align: justify;">Chelsea diuntungkan dalam laga leg I ini. Sebab, pertandingan akan digelar di tempat netral, tepatnya di Arena Nationala, Bucharest, Rumania. Laga digelar di tempat netral karena Spanyol selaku negara Atletico Madrid, melarang penerbangan dari Inggris masuk ke wilayah mereka.</p>
                <p style="text-align: justify;">Karena itu, Federasi Sepakbola Eropa (UEFA) tidak kehabisan akal. Ketimbang menunda pertandingan, UEFA menggeser pertandingan ke tempat netral. Bermain di tempat netral praktis menguntungkan Chelsea.</p>
                <p style="text-align: justify;">Kemudian di jam yangbsama digelar laga Lazio vs Bayern Munich. Laga digelar di markas Lazio, Stadion Olimpico. Menarik menanti, sanggupkah Lazio selaku tim tamu mampu menahan ketangguhan Bayern Munich?</p>
                <p style="text-align: justify;">Bayern Munich yang berstatus jawara Liga Champions musim lalu, hampir dua tahun tidak merasakan kekalahan di ajang ini. Die Roten &ndash;julukan Bayern&ndash; terakhir kali kalah pada leg II babak 16 besar Liga Champions 2018-2019. Saat itu, mereka kalah 1-3 di kandang sendiri dari Liverpool.</p>
                <p><!-- pagebreak --></p>
                <p style="text-align: justify;">Kemudian pada Kamis 25 Februari 2021 pukul 03.00 WIB, juga dua laga yang digelar. Sebanyak dua laga itu mempertemukan Atalanta vs Real Madrid dan Borussia Monchengladbach kontra Manchester City.</p>
                <p style="text-align: center;"><img src="../../images/seeder/Content 3-2.webp" /></p>
                <p style="text-align: justify;"><strong>(Madrid pantang anggap remeh Atalanta)</strong></p>
                <p style="text-align: justify;"><em>Los Blancos</em>&nbsp;&ndash;julukan Madrid&ndash; yang berstatus tim tersukses di&nbsp;<a href="https://bola.okezone.com/ligachampion" target="_blank" rel="noopener">Liga Champions</a>, tak bisa memandang Atalanta sebelah mata. Selain lolos ke perempatfinal musim lalu, Atalanta berpengalaman mengalahkan tim kuat macam Liverpool di fase grup.</p>
                <div id="lastread" style="text-align: justify;"></div>
                <p style="text-align: justify;">Karena itu, pantang bagi Real Madrid meremehkan Atalanta. Terlebih kepercayaan diri&nbsp;<em>La Dea&nbsp;</em>&ndash;julukan Atalanta&ndash; sedang meninggi setelah semalam mereka menang 4-2 atas Napoli di pekan ke-23 Liga Italia 2020-2021.</p>
                <p style="text-align: justify;">Kemudian, Monchengladbach berupaya menjegal langkah Man City yang sangat dominan di Liga Inggris. Sekadar informasi, dalam 13 laga terkini di Liga Inggris 2020-2021, Man City selalu menang.</p>
                <p style="text-align: justify;"><strong>Berikut jadwal Liga Champions pekan ini:</strong></p>
                <p style="text-align: justify;">&nbsp;</p>
                <p style="text-align: justify;"><strong>Rabu, 24 Februari 2021 pukul 03.00 WIB</strong></p>
                <p style="text-align: justify;">Atletico Madrid vs Chelsea</p>
                <p style="text-align: justify;">Lazio vs Bayern Munich</p>
                <p style="text-align: justify;"><strong>Kamis, 25 Februari 2021 pukul 03.00 WIB</strong></p>
                <p style="text-align: justify;">Atalanta vs Real Madrid</p>
                <p style="text-align: justify;">Borussia Monchengladbach vs Manchester City</p>',
                'thumbnail' => asset('images/seeder/Banner 3.jpg'),
                'user_id' => 1,
                'created_at' => Carbon::create('2021-02-22 10:00:00'),
            ],
        ];
    }
}
