<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="aws_search.php" method="post">
        <div class="search">
            <input type="text" name="title" id="title">
        </div>
        <input type="submit" value="検索">
    </form> 

<?php

define("ACCESS_KEY_ID"     , 'AKIAIIEEDSJJ2G6IMTGQ');
define("SECRET_ACCESS_KEY" , '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');
define("ASSOCIATE_TAG"     , 'huton338-22');
define("ACCESS_URL"        , 'http://ecs.amazonaws.jp/onca/xml');
 
 
$params = array(); 
$params['Service']        = 'AWSECommerceService';
$params['Version']        = '2011-08-02';
$params['Operation']      = 'ItemSearch';
$params['Keywords']         = $_POST["title"];
$params['SearchIndex']    = 'Books';
$params['AssociateTag']   = ASSOCIATE_TAG;
$params['ResponseGroup']  = 'ItemAttributes,Offers,Images,Reviews';
$params['Timestamp']      = gmdate('Y-m-d\TH:i:s\Z');
 
ksort($params);
 
$canonical_string = 'AWSAccessKeyId='.ACCESS_KEY_ID;
foreach ($params as $k => $v) {
    $canonical_string .= '&'.urlencode_RFC3986($k).'='.urlencode_RFC3986($v);
}
 
function urlencode_RFC3986($str) {
    return str_replace('%7E', '~', rawurlencode($str));
}
 
$parsed_url = parse_url(ACCESS_URL);
$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";
 
$signature = base64_encode(
    hash_hmac('sha256', $string_to_sign, SECRET_ACCESS_KEY, true)
);
 
$url = ACCESS_URL.'?'.$canonical_string.'&Signature='.urlencode_RFC3986($signature);
 
$response = file_get_contents($url); //Amazonへレスポンス
 
$parsed_xml = null;
// レスポンスを配列で取得
if (isset($response)) {
    $parsed_xml = simplexml_load_string($response);
}
 
// Amazonへのレスポンスが正常に行われていたら
if ($response && isset($parsed_xml) && !$parsed_xml->faultstring && !$parsed_xml->Items->Request->Errors) {
    foreach ($parsed_xml->Items->Item as $current) {
        $title          = $current->ItemAttributes->Title; // タイトル
        $author         = $current->ItemAttributes->Author; // 著者
        $manufacturer   = $current->ItemAttributes->Manufacturer; // 出版社
        $imgURL         = $current->LargeImage->URL; // 本の表紙の大サイズのURL(サイズは小中大から選べる)  
        $bookURL        = $current->DetailPageURL; // Amazonの本のページのURL
        $releaseDate    = $current->ItemAttributes->ReleaseDate; // 出版日
 
        $authors = $author[0];
        // 著者が複数いる場合
        if (count($author) > 1) {
            for ($i = 1; $i < count($author); $i++) {
                $authors = $authors. ",". $author[$i];
            }
        }
        ?>
        <form action="aws_insert.php" method="post">
            <div class="book">
                <div class="book-image"><img src="<?php echo $imgURL; ?>"></div>
                <div class="book-data">
                    <p class="book-title">
                        <a href="<?php echo $bookURL; ?>" target="_blank">
                        <?php echo $title; ?>
                        </a>
                    </p>
                    <p class="book-author">著者:<?php echo $authors; ?></p>
                    <p class="book-manufacturer">出版社:<?php echo $manufacturer; ?></p>
                    <p class="book-manufacturer">出版日:<?php echo $releaseDate; ?></p>
                    <input type="hidden" name="imgurl" value="<?php echo $imgURL; ?>">
                    <input type="hidden" name="bookurl" value="<?php echo $bookURL; ?>">
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="authors" value="<?php echo $authors; ?>">
                    <input type="hidden" name="manufacturer" value="<?php echo $manufacturer; ?>">
                    <input type="hidden" name="releasedate" value=":<?php echo $releaseDate; ?>">
                </div>        
            </div>
            <input type="submit" value="お気に入り登録">
        </form>   
        <?php
    }
}

?>


    
</body>
</html>