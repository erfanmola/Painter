<?php
$filename = "image.jpg";
$imagesize = getimagesize($filename);

$width = $imagesize['0'];
$height = $imagesize['1'];

$total_pixels = (int) $width * (int) $height;

// For JPG :
$image = imagecreatefromjpeg($filename);
// For PNG :
// $image = imagecreatefromjpeg($filename);

$i = 0;
$j = 0;

$pixels = [];

for ($x = 0; $x < $total_pixels; $x++) {

    $rgb = imagecolorat($image, $i, $j);

    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = ($rgb) & 0xFF;

    $rgb = "rgb($r,$g,$b)";

    $pixels[$j][$i] = $rgb;
    
    if ($i < $width-1) {
        $i++;
    }else{
        $i = 0;
        $j++;
    }

}
?>
<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My lovely Paint</title>

        <style>
            * {
                margin: 0;
                padding: 0;
            }

            section {
                float: right;
                width: <?php echo $width; ?>px;
                height: <?php echo $height; ?>px;
                margin: calc(50vh - <?php echo (int) $height / 2; ?>px) calc(50vw - <?php echo (int) $width / 2; ?>px);
            }

            section div {
                float: left;
                width: 1px;
                height: 1px;
            }
        </style>

    </head>

    <body>
        
        <section>
            <?php
                foreach($pixels as $column) {

                    foreach($column as $color) {
                        ?>
                        <div style="background: <?php echo $color; ?>;"></div>
                        <?php
                    }

                }
            ?>
        </section>

    </body>
</html>