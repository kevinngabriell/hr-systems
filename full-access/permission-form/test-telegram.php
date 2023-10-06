<?php

function sendMessage($chatID, $messaggio, $token) {
    echo "sending message to " . $chatID . "\n";

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$id_otp = rand(0,9999999999);
$otp = rand(0000000,999999);
date_default_timezone_set('Asia/Jakarta');
$created_date = date('Y-m-d H:i:s');
$converted_time = date('Y-m-d H:i:s', strtotime('+ 15 minutes', strtotime($created_date)));

echo $id_otp."</br>";
echo $otp."</br>";
echo $created_date."</br>";
echo $converted_time."</br>";

$token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
$chatid = "6275977387";
sendMessage($chatid, "Dear Bapak/Ibu Kevin,

Kode OTP anda adalah $otp. Kode tersebut akan berakhir dalam 15 menit. 

Abaikan pesan ini jika anda tidak melakukan hal apapun yang membutuhkan verifikasi lebih lanjut

Best Regards,
IT Support HR Systems", $token);



// $token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
// $chatid = "6275977387";
// sendMessage($chatid, "Dear Bapak/Ibu Kevin,

// Pengajuan cuti anda telah berhasil saat ini anda perlu menunggu persetujuan dari atasan anda. Anda akan segera mendapatkan notifikasi ketika status pengajuan cuti anda telah berubah.


// Best Regards,
// IT Support HR Systems", $token);


// $chatid_2 = "934092670";
// sendMessage($chatid_2, "Dear Bapak/Ibu Kevin,

// Saat ini bawahan anda memiliki 1 request untuk approval pengajuan cuti. Silahkan membuka dashboard untuk melakukan peninjauan cuti tersebut


// Best Regards,
// IT Support HR Systems", $token);

?>