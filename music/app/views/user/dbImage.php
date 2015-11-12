<?php

$img = $this->model('imageModel');
echo $img->getImage(67);
header("Content-type: image/jpeg");
echo $img->getImage(67);

?>