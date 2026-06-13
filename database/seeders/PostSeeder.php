<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Author;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $authorIds = Author::pluck('id')->toArray();

        $posts = collect([
            [
                'title' => 'Arsenal Parade Juara, Declan Rice: Yang Lain Iri',
                'slug' => 'arsenal-parade-juara-declan-rice-yang-lain-iri',
                'excerpt' => 'Gelandang andalan Arsenal, Declan Rice, melontarkan komentar psywar yang menyebut klub-klub rival merasa iri melihat antusiasme ratusan ribu fans dalam parade juara Premier League The Gunners di London Utara.',
                'body' => 'Arsenal merayakan parade juara Liga Inggris 2025/26 pada Minggu (31/5), tepat sehari setelah mereka kalah tragis dari PSG via adu penalti di final Liga Champions. Selepas Arsenal gagal memenangi Liga Champions, klub-klub Inggris lainnya langsung memberikan sindiran tajam. Chelsea misalnya, langsung memposting foto trofi Liga Champions mereka di Stamford Bridge, sementara Nottingham Forest memposting foto kejayaan mereka saat memenangi Liga Champions pada era 1980-an. Serangan-serangan tersebut langsung dibalas oleh penyerang sayap Arsenal, Noni Madueke, yang memposting foto dirinya sedang mengangkat trofi Premier League dengan takarir, "Juara! Sementara yang lain nge-tweet dan posting." Tak lama kemudian, Declan Rice ikut memberikan serangan balik pedas di kolom komentar unggahan Madueke tersebut dengan menuliskan, "Yang lain pada iri," lengkap dengan emoji tertawa.',
                'image_path' => 'images/parade.png',
                'category_slug' => 'first-team',
                'is_featured' => true,
                'created_at' => now()->subHours(1)->subMinutes(10),
            ],
            [
                'title' => 'Statistik Pahit di Balik Kegagalan Arsenal Juara Liga Champions, Rekor Buruk Kembali Menghantui',
                'slug' => 'statistik-pahit-di-balik-kegagalan-arsenal-juara-liga-champions',
                'excerpt' => 'Di balik kegagalan menyakitkan di partai final melawan PSG, beberapa catatan statistik krusial memperlihatkan kelemahan Arsenal dalam mengantisipasi skenario tekanan tinggi di menit-menit akhir pertandingan.',
                'body' => 'Arsenal harus menelan kekecewaan mendalam setelah gagal meraih gelar Liga Champions pertama dalam sejarah klub. Harapan besar The Gunners untuk mengakhiri penantian panjang di kompetisi elite Eropa pupus usai kalah adu penalti dari PSG pada final yang berlangsung di Budapest. Laga puncak berlangsung ketat dan berakhir imbang 1-1 hingga waktu normal. Arsenal sempat unggul cepat melalui gol Kai Havertz pada menit kelima, namun PSG berhasil menyamakan kedudukan lewat penalti Ousmane Dembele di babak kedua. Karena tidak ada tambahan gol hingga perpanjangan waktu berakhir, pertandingan harus ditentukan melalui adu penalti. PSG akhirnya keluar sebagai pemenang dengan skor 4-3 setelah bek Arsenal, Gabriel Magalhaes, gagal menjalankan tugasnya sebagai eksekutor.',
                'image_path' => 'images/arteta.png',
                'category_slug' => 'match-review',
                'is_featured' => true,
                'created_at' => now()->subHour(),
            ],
            [
                'title' => 'Morgan Rogers Tertarik Gabung Arsenal, tapi Julian Alvarez Tetap Jadi Target Impian',
                'slug' => 'morgan-rogers-tertarik-gabung-arsenal-julian-alvarez-target-impian',
                'excerpt' => 'Bintang muda Aston Villa, Morgan Rogers, dilaporkan tertarik untuk merapat ke Emirates Stadium, meski manajemen Arsenal tetap menjadikan penyerang Atletico Madrid, Julian Alvarez, sebagai target buruan nomor satu mereka.',
                'body' => 'Morgan Rogers menjadi salah satu nama yang masuk dalam rencana transfer Arsenal setelah keberhasilan mereka menjuarai Premier League. Pemain Aston Villa tersebut disebut sebagai target serius untuk memperkuat lini serang tim asuhan Mikel Arteta. Arsenal kini mulai mengalihkan fokus ke bursa transfer setelah sukses di kompetisi domestik. Manajemen ingin memastikan keberhasilan musim lalu tidak hanya menjadi pencapaian sesaat. Kebutuhan menambah kualitas di sektor serangan menjadi salah satu prioritas utama klub. Karena itu, sejumlah nama mulai dikaitkan dengan kepindahan ke Emirates Stadium. Menurut laporan BBC, Rogers menjadi salah satu pemain yang mendapat perhatian besar dari Arsenal. Pemain berusia 23 tahun itu juga dikabarkan terbuka untuk pindah pada musim panas ini.',
                'image_path' => 'images/rogers.png',
                'category_slug' => 'transfer-rumours',
                'is_featured' => true,
                'created_at' => now()->subMinutes(50),
            ],
            [
                'title' => 'PR Arsenal Usai Gagal Juara Liga Champions: Wajib Perkuat Lini Depan dengan Rekrut Winger Baru',
                'slug' => 'pr-arsenal-usai-gagal-juara-liga-champions-wajib-perkuat-lini-depan',
                'excerpt' => 'Mimpi Arsenal untuk mengangkat trofi Liga Champions musim ini harus berakhir dengan cara yang menyakitkan. Kekalahan dari PSG meninggalkan pekerjaan rumah besar bagi manajer Mikel Arteta untuk mengevaluasi lini serang yang kurang mematikan.',
                'body' => 'Mimpi Arsenal untuk mengangkat trofi Liga Champions musim ini harus berakhir dengan cara yang menyakitkan. Setelah tampil penuh perjuangan, The Gunners tumbang dari PSG melalui adu penalti di partai final yang digelar di Puskas Arena, Budapest. Kekalahan tersebut meninggalkan pekerjaan rumah (PR) besar bagi manajer Mikel Arteta. Meski sukses mengantarkan Arsenal meraih gelar Liga Inggris dan nyaris menaklukkan Eropa, sang pelatih diyakini akan mengevaluasi sejumlah aspek penting dalam skuadnya selama bursa transfer musim panas. Secara keseluruhan, musim Arsenal sebenarnya bisa dikategorikan sukses. Mereka berhasil mengakhiri penantian panjang gelar Premier League sekaligus mencapai final Liga Champions. Namun, laga melawan PSG memperlihatkan satu kelemahan yang masih menghambat Arsenal untuk benar-benar menjadi tim terbaik di Eropa: lini serang yang belum cukup mematikan. Statistik dalam pertandingan final tersebut memberikan gambaran yang cukup kontras mengenai gaya bermain Arsenal. Mereka tercatat hanya menguasai bola sebesar 24,7 persen, angka terendah di final Liga Champions sejak dua dekade terakhir. Data ini menunjukkan betapa Arsenal sangat tertekan dan lebih banyak menghabiskan waktu untuk bertahan. Seluruh pemain Meriam London bahkan hanya mengumpulkan total 196 operan sukses sepanjang laga berlangsung. Bandingkan dengan gelandang andalan PSG, Vitinha, yang secara luar biasa mampu mencatatkan 141 operan seorang diri. Dominasi tersebut membuktikan betapa sulitnya Arsenal keluar dari tekanan lawan yang sangat dominan. Mikel Arteta pun secara jujur mengakui bahwa kualitas skuad Luis Enrique sangat menyulitkan timnya. Menurutnya, PSG saat ini merupakan salah satu tim terbaik di dunia dalam hal penguasaan bola dan kreativitas individu.',
                'image_path' => 'images/evaluasi.png',
                'category_slug' => 'match-review',
                'is_featured' => false,
                'created_at' => now()->subMinutes(40),
            ],
            [
                'title' => 'Guyonan Ben White di Parade Juara Arsenal: Nyanyikan Chant Kocak untuk Piero Hincapie yang Celananya Melorot',
                'slug' => 'guyonan-ben-white-parade-juara-arsenal-hincapie-celana-melorot',
                'excerpt' => 'Euforia perayaan gelar Premier League Arsenal diwarnai momen kocak. Ben White melontarkan chant jenaka yang mengejek insiden celana melorot rekan setimnya, Piero Hincapie.',
                'body' => 'Perayaan gelar juara Premier League yang digelar Arsenal di jalanan London tidak hanya dipenuhi oleh lautan manusia, tetapi juga diwarnai aksi jenaka para pemain di atas bus terbuka. Salah satu momen yang mencuri perhatian adalah ketika bek sayap Ben White melontarkan candaan spontan kepada rekan setimnya, Piero Hincapie, di hadapan ribuan pendukung The Gunners. Parade yang berlangsung pada Minggu (31/5/2026) waktu setempat ini menjadi pelipur lara bagi skuat asuhan Mikel Arteta setelah kegagalan mereka di final Liga Champions beberapa hari sebelumnya. Meski tampak kelelahan, para pemain tetap antusias menyapa suporter yang memadati rute parade di ibu kota Inggris tersebut. Suasana di atas bus semakin meriah ketika mikrofon berpindah tangan dari Declan Rice ke Ben White. Tanpa ragu, White langsung memimpin sebuah nyanyian singkat yang ditujukan khusus untuk Hincapie. Aksi ini langsung memicu gelak tawa dari pemain lain seperti Viktor Gyokeres dan Rice sendiri. Bek berusia 28 tahun itu berulang kali meneriakkan kalimat yang merujuk pada bagian tubuh Hincapie. White dengan lantang menyanyikan chant: "Hincapie, get your bum out!" (Hincapie, keluarkan bokongmu!). Mendengar ejekan tersebut, Hincapie hanya bisa tersenyum canggung. Pemain asal Ekuador itu tampak tidak memberikan balasan verbal dan memilih untuk tetap tenang di tengah sorak-sorai rekan-rekannya yang terhibur dengan guyonan tersebut. Guyonan Ben White tersebut sebenarnya bukan tanpa alasan. Candaan itu merujuk pada kejadian memalukan yang dialami Hincapie dalam laga Premier League melawan Burnley pada pertengahan Mei lalu. Saat itu, Hincapie terlibat duel fisik dengan Axel Tuanzebe yang membuatnya terjatuh tersungkur. Dalam proses jatuh tersebut, celana Hincapie secara tidak sengaja melorot hingga mengekspos bagian belakang tubuhnya di depan kamera dan ribuan penonton.',
                'image_path' => 'images/guyonan.png',
                'category_slug' => 'first-team',
                'is_featured' => false,
                'created_at' => now()->subMinutes(30),
            ],
            [
                'title' => 'Era Baru Manajer Liga Inggris: Baru Arteta Pemenang Trofi',
                'slug' => 'era-baru-manajer-liga-inggris-arteta-pemenang-trofi',
                'excerpt' => 'Pep Guardiola dan Arne Slot pergi. Liga Inggris memasuki era manajer baru untuk musim 2026/27, menempatkan Mikel Arteta sebagai satu-satunya manajer aktif yang pernah memenangkan gelar juara!',
                'body' => 'Pep Guardiola dan Arne Slot pergi. Liga Inggris masuki era manajer baru, dengan Mikel Arteta sebagai satu-satunya yang baru menangi gelar juara! Pep Guardiola berpisah dengan Manchester City setelah satu dekade mengabdi. Enam titel Liga Inggris diraihnya. Arne Slot hanya bertahan dua musim di Liverpool. Musim debutnya bisa menangi trofi Liga Inggris, musim berikutnya gagal. Itu artinya dari 20 tim di Liga Inggris pada musim 2026/27 nanti, baru Mikel Arteta manajernya Arsenal yang pernah menangi trofi! Arteta tentu bakal hadapi tantangan baru, mempertahankan gelar juara. Arsenal pun kabarnya mau menambah amunisi skuad di bursa transfer. Arteta sukses bawa Meriam London menangi gelar juara setelah puasa 22 tahun lamanya. Sebelumnya di tiga edisi terakhir, mereka selalu finis runner up. Menariknya, Arteta juga jadi orang kedua dengan status eks pemain Liga Inggris yang jadi manajer dan sukses menangi trofi. Arteta pernah main di Everton dan Arsenal. Sebelumnya, Roberto Mancini yang melakukannya dengan main di Leicester City dan kemudian menang bersama Man City.',
                'image_path' => 'images/arteta_trofi.png',
                'category_slug' => 'first-team',
                'is_featured' => false,
                'created_at' => now()->subMinutes(20),
            ],
            [
                'title' => 'Vlahovic Akan Tinggalkan Juventus, Arsenal Masih Mau?',
                'slug' => 'vlahovic-tinggalkan-juventus-arsenal-masih-mau',
                'excerpt' => 'Dusan Vlahovic dikabarkan akan meninggalkan Juventus akhir Juni ini dengan status agen bebas setelah kontrak baru tak tercapai. Apakah Arsenal akan kembali mengejar striker Serbia ini?',
                'body' => 'Dusan Vlahovic dikabarkan akan meninggalkan Juventus akhir Juni ini. Arsenal masih minat dengan striker asal Serbia tersebut? Pihak Juventus dan Vlahovic menjalani pertemuan pada Rabu (3/6/2026) waktu setempat. Menurut beberapa sumber, termasuk Sky Sport Italia dan Romeo Agresti, kesepakatan kontrak baru tak tercapai. Hal itu membuat Vlahovic akan hengkang dari Juventus pada akhir Juni dengan status agen bebas. Pemain berusia 26 tahun itu berpotensi tidak sepi peminat. Sejak beberapa musim lalu, Arsenal selalu dikaitkan ingin mendapatkan Vlahovic. Namun, Arsenal tidak kunjung melangkah dan pada musim panas tahun lalu memilih Viktor Gyokeres. Arsenal mungkin bisa bergerak lagi di musim panas tahun ini. Hal itu bisa saja terjadi kalau Gabriel Jesus hengkang dari Arsenal, yang dalam beberapa pekan terakhir disebut-sebut diinginkan AC Milan. Vlahovic mencetak 10 gol dalam 23 penampilan untuk Juventus musim 2025/2026. Dia sempat hilang selama empat bulan karena cedera otot serius dan membuat Juventus kekurangan daya gedor.',
                'image_path' => 'images/vlahovic_transfer.png',
                'category_slug' => 'transfer-rumours',
                'is_featured' => false,
                'created_at' => now()->subMinutes(10),
            ],
            [
                'title' => 'Arsenal Berminat, MU Bakal Lepas Marcus Rashford ke London Utara?',
                'slug' => 'arsenal-berminat-mu-lepas-marcus-rashford-ke-london-utara',
                'excerpt' => 'Manchester United kabarnya enggan menjual Marcus Rashford ke Arsenal di bursa transfer musim panas nanti meski sang penyerang tidak masuk dalam rencana masa depan Setan Merah.',
                'body' => 'Manchester United nampaknya sudah mengambil sikap terkait masa depan Marcus Rashford. Setan Merah dilaporkan tidak berminat untuk menjual sang pemain ke Arsenal di musim panas nanti. Seperti yang sudah diketahui, Rashford kemungkinan besar akan kembali ke Manchester United di musim panas ini. Barcelona, klub yang meminjamnya dikabarkan tidak akan mengaktifkan klausul pembelian permanen sang winger di musim panas nanti. MU sendiri dikabarkan tidak berminat menampung Rashford kembali di musim panas nanti. Alhasil mereka akan menjual lagi sang pemain ke klub lain di musim panas ini. Arsenal dilaporkan tertarik untuk mengamankan jasa Rashford di musim panas nanti. Namun rencana The Gunners itu kemungkinan besar akan berakhir kegagalan karena MU tidak merestui transfer itu terjadi. Menurut laporan Manchester Evening News, Arsenal sangat tertarik dengan prospek merekrut Rashford di musim panas ini. Mereka menilai sang penyerang bisa meningkatkan performa tim mereka. Ini disebabkan Rashford punya catatan yang apik selama dipinjamkan ke Barcelona di musim 2025/2026 kemarin. Di sisi lain, ia juga sudah teruji di Premier League bersama Manchester United. Kehadiran sang pemuda diyakini bisa membuat sisi kiri lini serang Arsenal kian berbahaya. Namun rencana Arsenal untuk merekrut Rashford itu kemungkinan menemui kegagalan karena Manchester United menolak menjual sang pemain ke Arsenal. MU melihat Arsenal sebagai salah satu rival mereka di musim depan. Meski tidak terpakai, mereka enggan memperkuat rival dengan pemain mereka sendiri. Itulah mengapa MU dikabarkan lebih fokus untuk menjual Rashford ke luar Inggris alih-alih memperkuat tim-tim rival Setan Merah di musim depan.',
                'image_path' => 'images/rashford_transfer.png',
                'category_slug' => 'transfer-rumours',
                'is_featured' => false,
                'created_at' => now(),
            ],
        ]);

        $posts->each(fn (array $item) => Post::create([
            'title' => $item['title'],
            'slug' => $item['slug'],
            'excerpt' => $item['excerpt'],
            'body' => $item['body'],
            'category_id' => $categories[$item['category_slug']],
            'author_id' => $authorIds[array_rand($authorIds)],
            'is_featured' => $item['is_featured'],
            'image_path' => $item['image_path'],
            'created_at' => $item['created_at'],
            'updated_at' => $item['created_at'],
        ]));
    }
}
