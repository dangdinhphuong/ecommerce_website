# Commands Translate
### Commands Translate dùng để dịch các file lang/en.app.php


#### Dịch toàn bộ project chạy lệnh :
  
     php artisan shop:translate --translateAll --locale=vi

#### Dịch một file được chỉ định project chạy lệnh :
  
     php artisan shop:translate --translateOnce --locale=vi --path=...Resources/lang/en/app.php     

 # Chú ý: 
             --translateAll  -> Là tham số muốn dịch toàn bộ
             --translateOnce -> Là tham số muốn dịch một file chỉ định
             --locale        -> Là tham số muốn dịch sang loại ngôn ngữ vd (vi, tr, it)
             --path          -> Là tham số đường dẫn file gốc và dịch nội dung từ file đó
