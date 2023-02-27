<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class TestingController extends Controller
{

    public function index()
    {
        /*try {
            $config = ['credentials' => base_path().'/cloud-vision-project.json'];
            $imageAnnotatorClient = new ImageAnnotatorClient($config);
         
            //$image_path = 'https://media-about.lovia.life/v7/about.lovia.life/wp-content/uploads/2020/05/ktp.jpg';
            //$imageContent = file_get_contents($image_path);
            $imageContent = fopen(public_path().'/files/contoh-ktp.jpg', 'r');
            $response = $imageAnnotatorClient->textDetection($imageContent);
            $text = $response->getTextAnnotations();

            //echo $text[0]->getDescription();
            echo '<pre>'; print_r($text[0]->getDescription()); echo '</pre>';

            //Simpan di db biar tidak dipanggil2 terus
            $sql = "INSERT INTO `temp_stored` SET
                    `id` = NULL
                    , `textnya` = ?";
            $query = DB::insert($sql, [ $text[0]->getDescription() ]);

         
            if ($error = $response->getError()) {
                print('API Error: ' . $error->getMessage() . PHP_EOL);
            }
         
            $imageAnnotatorClient->close();
        } catch(Exception $e) {
            echo $e->getMessage();
        }*/

        $sql = "SELECT textnya FROM temp_stored WHERE id = 4";
        $data = DB::select($sql);
        $textnya = $data[0]->textnya;

        $ArrTmp = preg_split("/\r\n|\n|\r/", $textnya);
        //echo '<pre>'; print_r($ArrTmp); exit;

        /*
        KTP => Cek String yg angka semua dan jumlahnya 16 karakter
        Jenis Kelamin => Tinggal cek Laki-Laki or PEREMPUAN
        Tempat Tanggal Lahir => Tinggal cari string yg ada "," nya dan pisahkan terus ambil yg format tanggal dan tempatnya
        Nama => kemungkinan besar adalah entrian sebelum "Tempat Tanggal Lahir"
        agama => tinggal di cocokkan saja dengan agama yg ada di indonesia (islam,kristen,katolik,budha,hindu,khonghucu,konghucu)
        Provinsi => Ambil text yg depannya Provinsi
        Status Nikah => tinggal cek saja kombinasi Belum kawin||Kawin||Cerai hidup||Cerai mati
        Pekerjaan => entry dibawah "Status Nikah" or 1 entry dibawahnya lagi jika kata dibawahnya itu merupakan "reserve word" untuk KTP
        */

        $KTP = $this->ExtractKTP($ArrTmp);
        $Gender = $this->ExtractGender($ArrTmp);
        $TtlData = $this->ExtractTtl($ArrTmp);
        $Ttl = $TtlData['Ttl'];
        $TtlIndex = $TtlData['TtlIndex'];
        //echo '<pre>'; print_r($TtlData); exit;
        $Nama = $this->ExtractNama($ArrTmp,$TtlIndex);
        $Agama = $this->ExtractAgama($ArrTmp);
        $Provinsi = $this->ExtractProvinsi($ArrTmp);
        $StatusNikahData = $this->ExtractStatusNikah($ArrTmp);
        $StatusNikah = $StatusNikahData['StatusNikah'];
        $StatusNikahIndex = $StatusNikahData['StatusNikahIndex'];
        $Pekerjaan = $this->ExtractPekerjaan($ArrTmp,$StatusNikahIndex);

        echo '<pre>'; print_r("KTP: ".$KTP."<br>");
        echo '<pre>'; print_r("Gender: ".$Gender."<br>");
        echo '<pre>'; print_r("Tempat dan Tanggal Lahir: ".$Ttl."<br>");
        echo '<pre>'; print_r("Nama: ".$Nama."<br>");
        echo '<pre>'; print_r("Agama: ".$Agama."<br>");
        echo '<pre>'; print_r("Provinsi: ".$Provinsi."<br>");
        echo '<pre>'; print_r("Status Nikah: ".$StatusNikah."<br>");
        echo '<pre>'; print_r("Pekerjaan: ".$Pekerjaan."<br>");
        exit;
    }

    private function ExtractKTP($ArrTmp) {
        $KTP = null;
        //echo '<pre>'; print_r($ArrTmp); exit;
        
        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));

            //pisahkan string by "spasi"
            $ArrTmp1 = explode(" ", $textproc);
            for ($j=0; $j < count($ArrTmp1); $j++) { 
                //cek string yg 16 karakter
                if(strlen($ArrTmp1[$j]) == 16) {
                    //cek apakah berupa angka semua
                    if (preg_match('/^[0-9]+$/', $ArrTmp1[$j])) {
                        $KTP = $ArrTmp1[$j];
                        break 2;
                    }
                }
            }

        }

        return $KTP;
    }

    private function ExtractGender($ArrTmp) {
        $Gender = null;

        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));

            //cek text yg mengandung 
            // laki-laki
            // laki laki
            // perempuan
            $textproc = strtolower($textproc);

            if (strpos($textproc, 'laki-laki') !== false) {
                $Gender = "Laki-Laki";
            } else if (strpos($textproc, 'laki laki') !== false) {
                $Gender = "Laki-Laki";
            } else if (strpos($textproc, 'perempuan') !== false) {
                $Gender = "Perempuan";
            }

        }

        return $Gender;
    }

    private function ExtractTtl($ArrTmp) {
        $return = array();
        $Ttl = null;
        $TtlIndex = null;

        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));

            if (strpos($textproc, ',') !== false) {
                $ArrTmp1 = explode(",",$textproc);
                $ArrTmp1LastValue = end($ArrTmp1);

                //cek apakah array terakhir adalah format tanggal
                if($this->validateDate($ArrTmp1LastValue) == true) {
                    $Ttl = $textproc;
                    $TtlIndex = $i;    
                }
            } else if(strpos($textproc, '.') !== false) {
                $ArrTmp1 = explode(".",$textproc);
                $ArrTmp1LastValue = end($ArrTmp1);

                //cek apakah array terakhir adalah format tanggal
                if($this->validateDate($ArrTmp1LastValue) == true) {
                    $Ttl = $textproc;
                    $TtlIndex = $i;    
                }
            }
        }

        $return['Ttl'] = $Ttl;
        $return['TtlIndex'] = $TtlIndex;
        return $return;
    }

    private function validateDate($date)
    {
        $tempDate = explode('-', $date);
        if($tempDate[1] > 0 && $tempDate[0] > 0 && $tempDate[2] > 0)
            return checkdate($tempDate[1], $tempDate[0], $tempDate[2]);
        else
            return false;
    }

    private function ExtractNama($ArrTmp,$TtlIndex) {
        $Nama = null;

        if($TtlIndex >= 0) {
            $Nama = $ArrTmp[$TtlIndex-1];
            $Nama = trim(str_replace(":","", $Nama));
        }

        return $Nama;
    }

    private function ExtractAgama($ArrTmp) {
        $Agama = null;

        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));
            $textproc = strtolower($textproc);

            //pisahkan string by "spasi"
            $ArrTmp1 = explode(" ", $textproc);
            for ($j=0; $j < count($ArrTmp1); $j++) { 
                if(strpos($ArrTmp1[$j], 'islam') !== false) {
                    $Agama = "ISLAM";
                } else if(strpos($ArrTmp1[$j], 'kristen') !== false) {
                    $Agama = "KRISTEN";
                } else if(strpos($ArrTmp1[$j], 'katolik') !== false) {
                    $Agama = "KATOLIK";
                } else if(strpos($ArrTmp1[$j], 'budha') !== false) {
                    $Agama = "BUDHA";
                } else if(strpos($ArrTmp1[$j], 'hindu') !== false) {
                    $Agama = "HINDU";
                } else if(strpos($ArrTmp1[$j], 'khonghucu') !== false) {
                    $Agama = "KHONGHUCU";
                } else if(strpos($ArrTmp1[$j], 'konghucu') !== false) {
                    $Agama = "KHONGHUCU";
                }
            }
        }        

        return $Agama;
    }

    private function ExtractProvinsi($ArrTmp) {
        $Provinsi = null;

        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));
            $textproc = strtolower($textproc);

            if(strpos($textproc, 'provinsi') !== false) {
                $Provinsi = strtoupper($textproc);
            }
        }

        return $Provinsi;
    }

    private function ExtractStatusNikah($ArrTmp) {
        $return = array();
        $StatusNikah = null;
        $StatusNikahIndex = null;

        for ($i=0; $i < count($ArrTmp); $i++) { 
            //hilangkan :
            $textproc = trim(str_replace(":","", $ArrTmp[$i]));
            $textproc = strtolower($textproc);

            if(strpos($textproc, 'status perkawinan') === false) {
                if (strpos($textproc, 'belum kawin') !== false) {
                    $StatusNikah = "BELUM KAWIN";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc, 'kawin') !== false) {
                    $StatusNikah = "KAWIN";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc, 'cerai hidup') !== false) {
                    $StatusNikah = "CERAI HIDUP";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc, 'cerai mati') !== false) {
                    $StatusNikah = "CERAI MATI";
                    $StatusNikahIndex = $i;
                    break;
                }
            } else {
                //cek jika dia merupakan satu baris, example "Status Perkawinan KAWIN"
                $textproc1 = trim(str_replace("status perkawinan","",$textproc));

                if (strpos($textproc1, 'belum kawin') !== false) {
                    $StatusNikah = "BELUM KAWIN";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc1, 'kawin') !== false) {
                    $StatusNikah = "KAWIN";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc1, 'cerai hidup') !== false) {
                    $StatusNikah = "CERAI HIDUP";
                    $StatusNikahIndex = $i;
                    break;
                } else if(strpos($textproc1, 'cerai mati') !== false) {
                    $StatusNikah = "CERAI MATI";
                    $StatusNikahIndex = $i;
                    break;
                }
            }
            
        }

        $return['StatusNikah'] = $StatusNikah;
        $return['StatusNikahIndex'] = $StatusNikahIndex;
        return $return;
    }

    private function ExtractPekerjaan($ArrTmp,$StatusNikahIndex) {
        $Pekerjaan = null;

        if($StatusNikahIndex >= 0) {
            $Pekerjaan = $ArrTmp[$StatusNikahIndex+1];
            $Pekerjaan = trim(str_replace(":","", $Pekerjaan));
        }

        return $Pekerjaan;        
    }

}
?>