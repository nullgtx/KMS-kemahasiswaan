<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="author" content="StarInstaFX" />
</head>
<style type="text/css"> 
        body{
            background:#575757;
            font-family:arial;
            font-size:12px;
        }
        #wraffer{
            padding:0 auto;
            margin:0 auto;
            width:655px;
            background:white;
        }
        hr{
            border: 0;
            width: 100%;
            color: #f00;
            background-color: #f00;
            height: 2px;
        }
</style>
<body>
    <div id="wraffer">
        <table style="padding:10px 10px 0px 10px;">
            <tbody>
                <tr>
                    <td>
                    <img src="{{ asset('img/logo-dark.png') }}">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;font:12px Arial,serif;color:#f00; padding-top:-5px;">Ini adalah layanan email otomatis, mohon untuk tidak membalas email ini</td>
                </tr>
                <tr>
                    <td style="padding:0px 10px">
                            Terima kasih telah bergabung bersama kami.<br>
                        <table border="0" cellpadding="5px" cellspacing="0px" style="margin-left: 30px;">
                            <tbody>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ $member->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $member->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>:</td>
                                    <td>{{ $member->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $member->nim }}</td>
                                </tr>                                
                            </tbody>
                        </table>
                    <br>Selamat Anda telah menjadi bagian dari KMS kemahasiswaan IT Telkom.
                    Semoga informasi ini bermanfaat.<br><br>Hormat Kami,<br>Admin KMS kemahasiswaan IT Telkom</td>
                </tr>
                <tr>
                    <td>
                    <hr />  
                    <table style="padding:0px 0px 20px 0px;font:12px Arial,sans-serif;color:#757679;text-align:left;width:540px" cellpadding="0px" cellspacing="0px">
                        <tbody>
                            <tr>
                                <td valign="top" width="65%" style="padding-left:10px"> <br /> Jika Anda memiliki pertanyaan atau komentar, jangan ragu <br /> 
                                untuk menggunakan fitur forum diskusi. <br /> 
                                
                                <br>                    
                                
                                </td>
                                
                                <td width="50%" valign="top">
                                    <p>
                                        <b>Contact Information:</b><br />
                                        alamat : Jl. DI Panjaitan No.128, Karangreja, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53147<br>
                                        Web: <a href="kms.andhikaprasetyo.my.id" style="color:#ff0000;text-decoration:underline" target="_blank">KMS Kemahasiswaan IT Telkom Purwokerto</a> <br />
                                        E-Mail  : kms@ittelkom-pwt.ac.id <br />
                                       
                                    </p>
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</body>
</html>