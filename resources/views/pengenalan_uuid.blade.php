@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('pengenalan_uuid') }}">Pengenalan UUID</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Lewat artikel ini saya ingin berbagi sedikit dan menjelaskan soal <strong>UUID (<i>Universally unique identifier</i>)</strong>. UUID ini di design dan dibuat untuk solved masalah <i>unique id</i> yang sebelumnya kebanyakan menggunakan integer (<i>autoincrement</i>). Namun untuk bisa mempunyai sifat unik itu sendiri juga merupakan <i>challenge</i>, karena di satu sisi kita harus memastikan bahwa id yg tergenerate harus ada sifat <i>uniqueness</i> tetapi di sisi yang tidak kalah pentingnya juga bahwa tidak ada korelasi antara id - id yang tergenerate tersebut.</p>
                <p>Namun pada implementasinya kita diharuskan untuk hanya bisa memilih satu karakteristik / sifat saja untuk UUID ini, apakah kita mau mengedepankan sisi <i>uniqueness</i> nya or lebih mengedepankan tidak ada korelasi antara id - id yg tergenerate.</p>

                <p>UUID adalah data sebesar 128 bit yg diformat berupa 32 hexadecimal digit. contohnya sepertini ini "9889f810-7d5e-11ed-9797-db77d614444f". UUID terbagi menjadi 3 varian or 3 versi yaitu UUID v1, UUID v4 dan UUID v5.</p>

                <br>

                <h3>UUID v1</h3>
                <p>UUID versi ini di generate berdasarkan MAC address dari komputer host / komputer server dan timestamp saat itu, dan ditambahkan beberapa random bit. Sehingga bisa dikatakan UUID v1 ini akan bersifat <i>unique</i>. Hal yg bisa menyebabkan tergenerate UUID yg sama adalah hanya jika UUID ini di generate oleh komputer yg sama dan diwaktu yg sama persis. Itupun kemungkinannya akan sangat kecil karena random bit tadi.</p>
                <p>Karena UUID ini digenerate berdasarkan host MAC address dan timestamp tadi, maka otomatis UUID yg tergenerate akan terlihat pola yg sama atau berelasi di setiap UUID nya.</p>

                <p>
                    Contoh UUID v1
                    <ul style="margin-top:-14px;">
                        <li>5f15e726-7d61-11ed-a1eb-0242ac120002</li>
                        <li>5f15eadc-7d61-11ed-a1eb-0242ac120002</li>
                        <li>5f15f022-7d61-11ed-a1eb-0242ac120002</li>
                    </ul>
                </p>

                <br>

                <h3>UUID v4</h3>
                <p>Untuk UUID v4 ini lebih simpel konsep nya, semua bit yang digunakan untuk menggenerate uid versi ini semuanya menggunakan random bit tanpa ada pola tertentu. Karena digenerate menggunakan konsep seperti itu, maka bisa dikatakan hampir tidak mungkin untuk bisa mengambil informasi dari uid yg tergenerate.</p>
                <p>Karena di generate secara random bits semua, apakah bisa ada kemungkinan duplikat ? Jawabannya adalah sangat kecil kemungkinan untuk bisa menghasilkan nilai duplikate dari UUID v4 ini, kemungkinannya hampir 99% tidak mungkin, kecuali jika anda menggenerate hampir milliaran uuid di setiap detiknya selama puluhan tahun. Tetapi jika anda menggunakan uuid ini untuk sesuatu yang benar2 vital dan krusial sifatnya seperti nomor transaksi untuk pembayaran atau transaksi bank, sebaiknya ditambahkan pengecekan duplikat constraint pada level database misalnya</p>
                <p>
                    Contoh UUID v4
                    <ul style="margin-top:-14px;">
                        <li>74cc53b8-446c-45c7-b946-9b3787e931af</li>
                        <li>a05bd5a0-3118-4559-9455-360beb8d0a79</li>
                        <li>252b10e1-fd4f-4171-9525-21d11108fb2e</li>
                    </ul>
                </p>

                <br>

                <h3>UUID v5</h3>
                <p>
                    UUID v5 ini adalah uid yang tidak bersifat random, atau lebih simpel nya bisa dikatakan sebagai metode menghash string yang bersifat satu arah. uid versi ini di generate dengan menggunakan 2 buah komponen, misalnya seperti contoh dibawah ini

                    <ol style="list-style: none;">
                        <li><strong>uid acuan</strong>: 3ea3e63c-4192-4ed2-a5c0-917654af5e65</li>
                        <li><strong>string yang mau di hash</strong>: nikolius</li>
                        <li><strong>hasil UUID v5 nya</strong>: 24519a6a-87af-575f-954b-215dd875f126</li>
                    </ol>

                    UUID v5 ini cocok untuk digunakan jika aplikasi anda memerlukan suatu string yang di harus hash/acak dan nantinya perlu di cocokan kembali setelah itu. Tetapi catatan penting jangan pernah menggunakan UUID v5 itu sebagai metode authentikasi untuk password karena tidak aman dan akan ada resiko untuk kena brute force attack nantinya jika misalnya uid acuannya bocor atau diketahui orang

                </p>
                <br>

                <p>Jadi pilih lah UUID yang tepat sesuai dengan kebutuhan aplikasi yang lagi anda develop. Semoga artikel ini bisa membantu dan menambah pengetahuan anda.</p>

        	</div>

        </div>
    </section>
</div>