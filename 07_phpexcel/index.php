// http://vbnettips.blog.shinobi.jp/php/php%20%E3%82%A8%E3%82%AF%E3%82%BB%E3%83%AB%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E5%87%BA%E5%8A%9B%E3%81%AE%E6%96%B9%E6%B3%95%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6%EF%BC%88phpexcel%EF%BC%89
// https://qiita.com/C_HERO/items/d22cca59d4da03be69cd
// https://github.com/PHPOffice/PHPExcel/blob/1.8/Documentation/markdown/Overview/01-Getting-Started.md

<?php
// ライブラリ読込
require_once './PHPExcel-1.8/Classes/PHPExcel.php';
 
// PHPExcelオブジェクト作成
$objBook = new PHPExcel();
 
// シート設定
$objSheet = $objBook->getActiveSheet();
 
// [A1]セルに文字列設定
$objSheet->setCellValue('A1', 'ABCDEFG');
 
// [A2]セルに数値設定
$objSheet->setCellValue('A2', 123.56);
 
// [A3]セルにBoolean値設定
$objSheet->setCellValue('A3', TRUE);
 
// [A4]セルに書式設定
$objSheet->setCellValue('A4', '=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))');
 
// Excel2007形式で保存する
$objWriter = PHPExcel_IOFactory::createWriter($objBook, "Excel2007");
$objWriter->save('test.xlsx');
exit();
?>
