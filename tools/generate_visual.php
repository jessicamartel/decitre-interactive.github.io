<?php

require_once  __DIR__ . '/vendor/autoload.php';

if (count($argv) !== 3) {
    echo "Usage ${argv[0]} 'fichier' 'taille_max' \n";

    exit(1);
}

$image = $argv[1];

if (!file_exists($image)) {
    echo "L'image $image n'existe pas \n";
}


$imageInfo = pathinfo($image);
$basename = $imageInfo['filename'];
$extension = $imageInfo['extension'];
$dirname = $imageInfo['dirname'];

$imagesByRatio = [];
$ratios = [1,2];
$command = 'convert $inputFile -quality 100 -resize $size jpeg:- | jpegoptim --stdin --strip-all --all-progressive --max=$quality --force --stdout > $outputFile';
foreach ($ratios as $ratio) {
    $destinationFile = sprintf('%s/%s-%d.%s', $dirname, $basename, $ratio, $extension);
    $size = $argv[2] * $ratio;


    $process = new \Symfony\Component\Process\Process($command);
    $process->run(null, [
        'inputFile' => $image,
        'size' => $size,
        'outputFile' => $destinationFile,
        'quality' => 95,
    ]);

    $imagesByRatio[$ratio] = $destinationFile;
}


$command = 'convert $inputFile -quality 100 -resize $size jpeg:- | jpegoptim --stdin --strip-all --all-progressive --max=$quality --force --stdout | base64 --wrap=0';
$process = new \Symfony\Component\Process\Process($command);
$process->run(null, [
    'inputFile' => $image,
    'size' => 20,
    'outputFile' => $destinationFile,
    'quality' => 20,
]);
$imageLight = $process->getOutput();

list($outputWidth, $outputHeight) = getimagesize($imagesByRatio[1]);


$outputImage = <<<HTML

<!--- code à copier dans le blog post -->
<figure>
    <img 
        class="lozad" 
        width="%width%" height="%height%"
        src="data:image;base64,%base64_light%"
        data-src="{{ '/%ratio_1%' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/%ratio_1%' | prepend: site.baseurl  }} 1x, {{ '/%ratio_2%' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/%ratio_1%' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Légende à remplir</figcaption>
</figure>
<!--- fin -->

HTML;

echo strtr($outputImage, [
    '%ratio_1%' => $imagesByRatio[1],
    '%ratio_2%' => $imagesByRatio[2],
    '%width%' => $outputWidth,
    '%height%' => $outputHeight,
    '%base64_light%' => $imageLight,
]);
