<html>
<head>
<title>Hasil Tokenisasi</title>
</head>
<body>
<?php
 error_reporting(0);
?>
<?php
$string = $_POST['text'];
$banyak = $_POST['banyak'];
$word = str_word_count(strtolower($string ),1);
$jumlah = count($word);
echo "<b><h3>Teks Awal:</h3></b>";
echo $string;
echo "<br>";

echo "<b><h3>Hasil Tokenisasi</h3></b>";
echo "<table border='1'>";
echo "<tr><th>Kata</th></tr>";
foreach ($word as $key=>$val) {
echo "<tr><td>$val</td></tr>";
}
echo "</table>";
echo "<b>Jumlah Kata : " .$jumlah. "</b><br>";
echo "---------------------------------------------";

echo "<br>";
$word_count = array_count_values($word);
arsort($word_count);
$jumlah2 = count($word_count);
echo "<b><h3>Frekuensi Tokenisasi</h3></b>";
echo "<table border='1'>";
echo "<tr><th>Kata</th><th>Frekuensi</th></tr>";
foreach ($word_count as $key=>$val) {
echo "<tr><td>$key</td><td>$val</td></tr>";
mysql_query("INSERT INTO tokenisasi VALUES ('bla','$key','$val')");
}
echo "</table>";
echo "<b>Jumlah Kata : " .$jumlah2. "</b><br>";
echo "---------------------------------------------";
echo "<br>";
echo "<b><h3>Hasil " .$banyak. " Frekuensi Teratas</h3></b>";
echo "<table border='1'>";
echo "<tr><th>Kata</th><th>Frekuensi</th></tr>";
$word_count2 = (array_slice($word_count, 0, $banyak));
foreach ($word_count2 as $key2=>$val2) {
echo "<tr><td>$key2</td><td>$val2</td></tr>";
}
echo "</table>";
echo "---------------------------------------------";
?>
<?php
class Keywords
{
   private $stopwords2 = array("a", "about", "above", "acara", "across", "ada", "adalah", "adanya", "after", "afterwards", "again", "against", "agar", "akan", "akhir", "akhirnya", "akibat", "aku", "all", "almost", "alone", "along", "already", "also", "although", "always", "am", "among", "amongst", "amoungst", "amount", "an", "and", "anda", "another", "antara", "any", "anyhow", "anyone", "anything", "anyway", "anywhere", "apa", "apakah", "apalagi", "are", "around", "as", "asal", "at", "atas", "atau", "awal", "b", "back", "badan", "bagaimana", "bagi", "bagian", "bahkan", "bahwa", "baik", "banyak", "barang", "barat", "baru", "bawah", "be", "beberapa", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "begitu", "behind", "being", "belakang", "below", "belum", "benar", "bentuk", "berada", "berarti", "berat", "berbagai", "berdasarkan", "berjalan", "berlangsung", "bersama", "bertemu", "besar", "beside", "besides", "between", "beyond", "biasa", "biasanya", "bila", "bill", "bisa", "both", "bottom", "bukan", "bulan", "but", "by", "call", "can", "cannot", "cant", "cara", "co", "con", "could", "couldnt", "cry", "cukup", "dalam", "dan", "dapat", "dari", "datang", "de", "dekat", "demikian", "dengan", "depan", "describe", "detail", "di", "dia", "diduga", "digunakan", "dilakukan", "diri", "dirinya", "ditemukan", "do", "done", "down", "dua", "due", "dulu", "during", "each", "eg", "eight", "either", "eleven", "else", "elsewhere", "empat", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "gedung", "get", "give", "go", "had", "hal", "hampir", "hanya", "hari", "harus", "has", "hasil", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "hidup", "him", "himself", "hingga", "his", "how", "however", "hubungan", "hundred", "ia", "ie", "if", "ikut", "in", "inc", "indeed", "ingin", "ini", "interest", "into", "is", "it", "its", "itself", "itu", "jadi", "jalan", "jangan", "jauh", "jelas", "jenis", "jika", "juga", "jumat", "jumlah", "juni", "justru", "juta", "kalau", "kali", "kami", "kamis", "karena", "kata", "katanya", "ke", "kebutuhan", "kecil", "kedua", "keep", "kegiatan", "kehidupan", "kejadian", "keluar", "kembali", "kemudian", "kemungkinan", "kepada", "keputusan", "kerja", "kesempatan", "keterangan", "ketiga", "ketika", "khusus", "kini", "kita", "kondisi", "kurang", "lagi", "lain", "lainnya", "lalu", "lama", "langsung", "lanjut", "last", "latter", "latterly", "least", "lebih", "less", "lewat", "lima", "ltd", "luar", "made", "maka", "mampu", "mana", "mantan", "many", "masa", "masalah", "masih", "masing-masing", "masuk", "mau", "maupun", "may", "me", "meanwhile", "melakukan", "melalui", "melihat", "memang", "membantu", "membawa", "memberi", "memberikan", "membuat", "memiliki", "meminta", "mempunyai", "mencapai", "mencari", "mendapat", "mendapatkan", "menerima", "mengaku", "mengalami", "mengambil", "mengatakan", "mengenai", "mengetahui", "menggunakan", "menghadapi", "meningkatkan", "menjadi", "menjalani", "menjelaskan", "menunjukkan", "menurut", "menyatakan", "menyebabkan", "menyebutkan", "merasa", "mereka", "merupakan", "meski", "might", "milik", "mill", "mine", "minggu", "misalnya", "more", "moreover", "most", "mostly", "move", "much", "mulai", "muncul", "mungkin", "must", "my", "myself", "nama", "name", "namely", "namun", "nanti", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "oleh", "on", "once", "one", "only", "onto", "or", "orang", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own", "pada", "padahal", "pagi", "paling", "panjang", "para", "part", "pasti", "pekan", "penggunaan", "penting", "per", "perhaps", "perlu", "pernah", "persen", "pertama", "pihak", "please", "posisi", "program", "proses", "pula", "pun", "punya", "put", "rabu", "rasa", "rather", "re", "ribu", "ruang", "saat", "sabtu", "saja", "salah", "sama", "same", "sampai", "sangat", "satu", "saya", "sebab", "sebagai", "sebagian", "sebanyak", "sebelum", "sebelumnya", "sebenarnya", "sebesar", "sebuah", "secara", "sedang", "sedangkan", "sedikit", "see", "seem", "seemed", "seeming", "seems", "segera", "sehingga", "sejak", "sejumlah", "sekali", "sekarang", "sekitar", "selain", "selalu", "selama", "selasa", "selatan", "seluruh", "semakin", "sementara", "sempat", "semua", "sendiri", "senin", "seorang", "seperti", "sering", "serious", "serta", "sesuai", "setelah", "setiap", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "suatu", "such", "sudah", "sumber", "system", "tahu", "tahun", "tak", "take", "tampil", "tanggal", "tanpa", "tapi", "telah", "teman", "tempat", "ten", "tengah", "tentang", "tentu", "terakhir", "terhadap", "terjadi", "terkait", "terlalu", "terlihat", "termasuk", "ternyata", "tersebut", "terus", "terutama", "tetapi", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "tidak", "tiga", "tinggal", "tinggi", "tingkat", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "ujar", "umum", "un", "under", "until", "untuk", "up", "upaya", "upon", "us", "usai", "utama", "utara", "very", "via", "waktu", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "wib", "will", "with", "within", "without", "would", "ya", "yaitu", "yakni", "yang", "yet", "you", "your", "yours", "yourself", "yourselves"
   );
   public function getKeywords($string, $nbrwords2 = 5)
   {
      $words2 = str_word_count($string, 1);
      array_walk($words2, array(
         $this,
         'filter'
      ));
      $words2 = array_diff($words2, $this->stopwords2);
      $wordCount = array_count_values($words2);
      arsort($wordCount);
echo "<b><h2>Hasil Tokenisasi Setelah Difilter dengan Stopword</h2></b>";
echo "<b>Stopword bahasa inggris:</b><br>";
echo "'a', 'about', 'above', 'across', 'after', 'afterwards', 'again', 'against', 'all', 'almost', 'alone', 'along', 'already', 'also', 'although', 'always', 'am', 'among', 'amongst', 'amoungst', 'amount', 'an', 'and', 'another', 'any', 'anyhow', 'anyone', 'anything', 'anyway', 'anywhere', 'are', 'around', 'as', 'at', 'back', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand', 'behind', 'being', 'below', 'beside', 'besides', 'between', 'beyond', 'bill', 'both', 'bottom', 'but', 'by', 'call', 'can', 'cannot', 'cant', 'co', 'con', 'could', 'couldnt', 'cry', 'de', 'describe', 'detail', 'do', 'done', 'down', 'due', 'during', 'each', 'eg', 'eight', 'either', 'eleven', 'else', 'elsewhere', 'empty', 'enough', 'etc', 'even', 'ever', 'every', 'everyone', 'everything', 'everywhere', 'except', 'few', 'fifteen', 'fify', 'fill', 'find', 'fire', 'first', 'five', 'for', 'former', 'formerly', 'forty', 'found', 'four', 'from', 'front', 'full', 'further', 'get', 'give', 'go', 'had', 'has', 'hasnt', 'have', 'he', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'hereupon', 'hers', 'herself', 'him', 'himself', 'his', 'how', 'however', 'hundred', 'ie', 'if', 'in', 'inc', 'indeed', 'interest', 'into', 'is', 'it', 'its', 'itself', 'keep', 'last', 'latter', 'latterly', 'least', 'less', 'ltd', 'made', 'many', 'may', 'me', 'meanwhile', 'might', 'mill', 'mine', 'more', 'moreover', 'most', 'mostly', 'move', 'much', 'must', 'my', 'myself', 'name', 'namely', 'neither', 'never', 'nevertheless', 'next', 'nine', 'no', 'nobody', 'none', 'noone', 'nor', 'not', 'nothing', 'now', 'nowhere', 'of', 'off', 'often', 'on', 'once', 'one', 'only', 'onto', 'or', 'other', 'others', 'otherwise', 'our', 'ours', 'ourselves', 'out', 'over', 'own', 'part', 'per', 'perhaps', 'please', 'put', 'rather', 're', 'same', 'see', 'seem', 'seemed', 'seeming', 'seems', 'serious', 'several', 'she', 'should', 'show', 'side', 'since', 'sincere', 'six', 'sixty', 'so', 'some', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhere', 'still', 'such', 'system', 'take', 'ten', 'than', 'that', 'the', 'their', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'therefore', 'therein', 'thereupon', 'these', 'they', 'thickv', 'thin', 'third', 'this', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'to', 'together', 'too', 'top', 'toward', 'towards', 'twelve', 'twenty', 'two', 'un', 'under', 'until', 'up', 'upon', 'us', 'very', 'via', 'was', 'we', 'well', 'were', 'what', 'whatever', 'when', 'whence', 'whenever', 'where', 'whereafter', 'whereas', 'whereby', 'wherein', 'whereupon', 'wherever', 'whether', 'which', 'while', 'whither', 'who', 'whoever', 'whole', 'whom', 'whose', 'why', 'will', 'with', 'within', 'without', 'would', 'yet', 'you', 'your', 'yours', 'yourself', 'yourselves'.<br><br>";
echo "<b>Stopword bahasa indonesia:</b><br>";
echo "'acara', 'ada', 'adalah', 'adanya', 'agar', 'akan', 'akhir', 'akhirnya', 'akibat', 'aku', 'anda', 'antara', 'apa', 'apakah', 'apalagi', 'asal', 'atas', 'atau', 'awal', 'b', 'badan', 'bagaimana', 'bagi', 'bagian', 'bahkan', 'bahwa', 'baik', 'banyak', 'barang', 'barat', 'baru', 'bawah', 'beberapa', 'begitu', 'belakang', 'belum', 'benar', 'bentuk', 'berada', 'berarti', 'berat', 'berbagai', 'berdasarkan', 'berjalan', 'berlangsung', 'bersama', 'bertemu', 'besar', 'biasa', 'biasanya', 'bila', 'bisa', 'bukan', 'bulan', 'cara', 'cukup', 'dalam', 'dan', 'dapat', 'dari', 'datang', 'dekat', 'demikian', 'dengan', 'depan', 'di', 'dia', 'diduga', 'digunakan', 'dilakukan', 'diri', 'dirinya', 'ditemukan', 'dua', 'dulu', 'empat', 'gedung', 'hal', 'hampir', 'hanya', 'hari', 'harus', 'hasil', 'hidup', 'hingga', 'hubungan', 'ia', 'ikut', 'ingin', 'ini', 'itu', 'jadi', 'jalan', 'jangan', 'jauh', 'jelas', 'jenis', 'jika', 'juga', 'jumat', 'jumlah', 'juni', 'justru', 'juta', 'kalau', 'kali', 'kami', 'kamis', 'karena', 'kata', 'katanya', 'ke', 'kebutuhan', 'kecil', 'kedua', 'kegiatan', 'kehidupan', 'kejadian', 'keluar', 'kembali', 'kemudian', 'kemungkinan', 'kepada', 'keputusan', 'kerja', 'kesempatan', 'keterangan', 'ketiga', 'ketika', 'khusus', 'kini', 'kita', 'kondisi', 'kurang', 'lagi', 'lain', 'lainnya', 'lalu', 'lama', 'langsung', 'lanjut', 'lebih', 'lewat', 'lima', 'luar', 'maka', 'mampu', 'mana', 'mantan', 'masa', 'masalah', 'masih', 'masing-masing', 'masuk', 'mau', 'maupun', 'melakukan', 'melalui', 'melihat', 'memang', 'membantu', 'membawa', 'memberi', 'memberikan', 'membuat', 'memiliki', 'meminta', 'mempunyai', 'mencapai', 'mencari', 'mendapat', 'mendapatkan', 'menerima', 'mengaku', 'mengalami', 'mengambil', 'mengatakan', 'mengenai', 'mengetahui', 'menggunakan', 'menghadapi', 'meningkatkan', 'menjadi', 'menjalani', 'menjelaskan', 'menunjukkan', 'menurut', 'menyatakan', 'menyebabkan', 'menyebutkan', 'merasa', 'mereka', 'merupakan', 'meski', 'milik', 'minggu', 'misalnya', 'mulai', 'muncul', 'mungkin', 'nama', 'namun', 'nanti', 'of', 'oleh', 'orang', 'pada', 'padahal', 'pagi', 'paling', 'panjang', 'para', 'pasti', 'pekan', 'penggunaan', 'penting', 'perlu', 'pernah', 'persen', 'pertama', 'pihak', 'posisi', 'program', 'proses', 'pula', 'pun', 'punya', 'rabu', 'rasa', 'ribu', 'ruang', 'saat', 'sabtu', 'saja', 'salah', 'sama', 'sampai', 'sangat', 'satu', 'saya', 'sebab', 'sebagai', 'sebagian', 'sebanyak', 'sebelum', 'sebelumnya', 'sebenarnya', 'sebesar', 'sebuah', 'secara', 'sedang', 'sedangkan', 'sedikit', 'segera', 'sehingga', 'sejak', 'sejumlah', 'sekali', 'sekarang', 'sekitar', 'selain', 'selalu', 'selama', 'selasa', 'selatan', 'seluruh', 'semakin', 'sementara', 'sempat', 'semua', 'sendiri', 'senin', 'seorang', 'seperti', 'sering', 'serta', 'sesuai', 'setelah', 'setiap', 'suatu', 'sudah', 'sumber', 'tahu', 'tahun', 'tak', 'tampil', 'tanggal', 'tanpa', 'tapi', 'telah', 'teman', 'tempat', 'tengah', 'tentang', 'tentu', 'terakhir', 'terhadap', 'terjadi', 'terkait', 'terlalu', 'terlihat', 'termasuk', 'ternyata', 'tersebut', 'terus', 'terutama', 'tetapi', 'the', 'tidak', 'tiga', 'tinggal', 'tinggi', 'tingkat', 'ujar', 'umum', 'untuk', 'upaya', 'usai', 'utama', 'utara', 'waktu', 'wib', 'ya', 'yaitu', 'yakni', 'yang'.<br><br>";
echo "<b><h3>Hasil Tokenisasi</h3></b>";
echo "<table border='1'>";
echo "<tr><th>Kata</th><th>Frekuensi</th></tr>";
$jumlah3 = count($wordCount);
foreach ($wordCount as $key3=>$val3) {
echo "<tr><td>$key3</td><td>$val3</td></tr>";
}
echo "</table>";
echo "<b>Jumlah Kata : " .$jumlah3. "</b><br>";
echo "---------------------------------------------";
      $wordCount = array_slice($wordCount, 0, $nbrwords2);
      return array_keys($wordCount);
   }
   private function filter(&$val3, $key3)
   {
      $val3 = strtolower($val3);
   }
   private function setStopwords2()
   {
      $this->stopwords2 = array();
   }
}
$test = new Keywords();
$keywords2 = $test->getKeywords($string, 9);
echo "<br>";
echo "<b><h3>Hasil " .$banyak. " Frekuensi Teratas</h3></b>";
echo "<table border='1'>";
echo "<tr><th>Kata</th></tr>";
$wordCount2 = (array_slice($keywords2, 0, $banyak));
foreach ($wordCount2 as $key4=>$val4) {
echo "<tr><td>$val4</td></tr>";
}
echo "</table>";
echo "---------------------------------------------";
?>
<?php
 error_reporting(0);
?>
</body>
</html>